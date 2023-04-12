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

  public function itemsearch($query){
    $query = trim($query);
    $shop_id = Auth::user()->shop_id;
    $sql = "select a.product_id,a.name,c.price,b.stock from oc_product_description a,stock b,oc_product c where a.product_id=c.product_id and a.product_id=b.item_id and b.shop_id=$shop_id and a.name like '%$query%' and b.stock > 0";
    $sql= $sql ." order by name LIMIT 20";
    $result = DB::select(DB::raw($sql));
    $array = array();
    foreach ($result as $key => $res) {
      $price = number_format($res->price,2);
      $array[] = array('value' => $res->name,'id' => $res->product_id,'price' => $res->price,'stock' => $res->stock);
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
    if(count($result) > 0){
      $billnum = $result[0]->billnum;
      $bill_date = $result[0]->bill_date;
      $mobile = $result[0]->mobile;
      $cust_name = $result[0]->cust_name;
      $total = $result[0]->total;
    }
    $bill_date = date("d-m-Y",strtotime($bill_date));
    $sql = "select a.*,b.name from shop_bill_items a,oc_product_description b where a.item_id=b.product_id and shop_id=$shop_id and bill_id=$id";
    $bill = DB::select(DB::raw($sql));
    return view("Bill.viewbill",compact('total','billnum','bill_date','mobile','cust_name','bill'));
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
    $sql = "insert into shop_billing (shop_id,billnum,bill_date,total,mobile,cust_name,bar_code) values ($shop_id,$billnum,'$bill_date',$amount,'$mobile','$cust_name','$bar_code')";
    DB::insert($sql);
    $bill_id = DB::getPdo()->lastInsertId();
    foreach($sales_array as $sal){
      $item_id = $sal["item_id"];
      $quantity = $sal["item_quantity"];
      $rate = $sal["item_rate"];
      $amount = $sal["item_amount"];
      $sql = "insert into shop_bill_items (shop_id,bill_id,item_id,quantity,item_rate,amount) values ($shop_id,$bill_id,$item_id,$quantity,$rate,$amount)";
      DB::insert($sql);
    }
    echo $billnum;
  }

}
