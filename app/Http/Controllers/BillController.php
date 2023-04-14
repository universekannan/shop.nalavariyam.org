<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;


use App\Models\Core\Setting;
use App\Models\Admin\Admin;
use App\Models\Core\Order;
use App\Models\Core\Customers;
use App\Models\Core\Drivers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Exception;
use App\Models\Core\Images;
use Validator;
use Hash;
use Auth;
use ZipArchive;
use File;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class BillController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function getitembybarcode($barcode){
    $shop_id = Auth::user()->shop_id;
    $sql = "select a.product_id,a.name,c.price,c.tax_class_id,b.stock from oc_product_description a,stock b,oc_product c where a.product_id=c.product_id and a.product_id=b.item_id and b.shop_id=$shop_id and a.bar_code = '$barcode' and b.stock > 0";
    $result = DB::select(DB::raw($sql));
    $response = array();
    $response["product_id"] = 0;
    if(count($result) > 0){
      $response["product_id"] = $result[0]->product_id;
      $response["name"] = $result[0]->name;
      $response["price"] = number_format($result[0]->price,2);
      $response["stock"] = $result[0]->stock;
      $tax_class_id = $result[0]->tax_class_id;
      $sql2 = "select rate,name from oc_tax_rule a,oc_tax_rate b where a.tax_rate_id=b.tax_rate_id and a.tax_class_id=$tax_class_id";
      $result2 = DB::select(DB::raw($sql2));
      $gst = 0;
      $tax_name = "";
      if(count($result2) > 0){
        $gst = round($result2[0]->rate,0);
        $tax_name = $result2[0]->name;
      }
      $response["gst"] = $gst;
      $response["tax_name"] = $tax_name;
    }
    echo json_encode($response);
  }

  public function itemsearch($query){
    $query = trim($query);
    $shop_id = Auth::user()->shop_id;
    $sql = "select a.product_id,a.name,c.price,c.tax_class_id,b.stock from oc_product_description a,stock b,oc_product c where a.product_id=c.product_id and a.product_id=b.item_id and b.shop_id=$shop_id and a.name like '%$query%' and b.stock > 0";
    $sql= $sql ." order by name LIMIT 20";
    $result = DB::select(DB::raw($sql));
    $array = array();
    foreach ($result as $key => $res) {
      $price = number_format($res->price,2);
      $tax_class_id = $res->tax_class_id;
      $sql2 = "select rate,name from oc_tax_rule a,oc_tax_rate b where a.tax_rate_id=b.tax_rate_id and a.tax_class_id=$tax_class_id";
      $result2 = DB::select(DB::raw($sql2));
      $gst = 0;
      $tax_name = "";
      if(count($result2) > 0){
        $gst = round($result2[0]->rate,0);
        $tax_name = $result2[0]->name;
      }
      $array[] = array('value' => $res->name,'id' => $res->product_id,'price' => $price,'stock' => $res->stock,'gst' => $gst,'tax_name' => $tax_name);
    }
    echo json_encode($array);
  }

  public function viewbill($id){
    $shop_id = Auth::user()->shop_id;
    $sql = "select * from shop_billing where shop_id=$shop_id and id=$id";
    $result = DB::select(DB::raw($sql));
    $billnum = "";
    $bill_date = "";
    $mobile = "";
    $cust_name = "";
    $total = "";
    $gst_amount = "";
    $net_amount = "";
    if(count($result) > 0){
      $billnum = $result[0]->billnum;
      $bill_date = $result[0]->bill_date;
      $mobile = $result[0]->mobile;
      $cust_name = $result[0]->cust_name;
      $total = $result[0]->total;
      $gst_amount = $result[0]->gst_amount;
      $net_amount = $result[0]->net_amount;
    }
    $bill_date = date("d-m-Y",strtotime($bill_date));
    $sql = "select a.*,b.name from shop_bill_items a,oc_product_description b where a.item_id=b.product_id and shop_id=$shop_id and bill_id=$id";
    $bill = DB::select(DB::raw($sql));
    return view("Bill.viewbill",compact('total','billnum','bill_date','mobile','cust_name','bill','gst_amount','net_amount'));
  }

  public function billdetails($from,$to)
  {
    $shop_id = Auth::user()->shop_id;
    $sql = "select * from shop_billing where shop_id=$shop_id and bill_date>='$from' and bill_date<='$to' order by billnum desc";
    $bill = DB::select(DB::raw($sql));
    return view("Bill.billdetails",compact('from','to','bill'));
  }

  public function manageBill()
  {
    $manageproducts = DB::table('oc_product')->select('oc_product.*','oc_product_description.name','oc_product_description.product_id','oc_product.product_id as pID')
    ->Join('oc_product_description', 'oc_product.product_id', '=', 'oc_product_description.product_id')
    ->orderBy('oc_product.product_id','Asc')->get();

    return view("Bill.newbill")->with('manageproducts',$manageproducts);
  }

  public function savebill(Request $request)
  {
    $shop_id = Auth::user()->shop_id;
    $sales = $request->get('sales');
    $amount = $request->get('amount');
    $gst_amount = $request->get('gst_amount');
    $net_amount = $request->get('net_amount');
    $mobile = $request->get('mobile');
    $cust_name = $request->get('cust_name');
    $bar_code = $request->get('bar_code');
    $sales_array = json_decode($sales,true);
    $bill_date = date("Y-m-d");
    $billnum = 0;
    $sql="select max(billnum) bilnum from shop_billing where shop_id=$shop_id";
    $result = DB::select(DB::raw($sql));
    if(count($result) > 0){
      $billnum = $result[0]->bilnum;
      $billnum = $billnum + 1;
    }else{
      $billnum = 1;
    }
    $sql = "insert into shop_billing (shop_id,billnum,bill_date,total,mobile,cust_name,bar_code,gst_amount,net_amount) values ($shop_id,$billnum,'$bill_date',$amount,'$mobile','$cust_name','$bar_code',$gst_amount,$net_amount)";
    DB::insert($sql);
    $bill_id = DB::getPdo()->lastInsertId();
    foreach($sales_array as $sal){
      $item_id = $sal["item_id"];
      $quantity = $sal["item_quantity"];
      $rate = $sal["item_rate"];
      $amount = $sal["item_amount"];
      $sql = "insert into shop_bill_items (shop_id,bill_id,item_id,quantity,item_rate,amount) values ($shop_id,$bill_id,$item_id,$quantity,$rate,$amount)";
      DB::insert($sql);
      $sql="update stock set stock = stock - $quantity where shop_id=$shop_id and item_id=$item_id";
      DB::update($sql);
      $sql="update oc_product set quantity = quantity - $quantity where  product_id=$item_id";
      DB::update($sql);
    }
    echo $billnum;
  }

}
