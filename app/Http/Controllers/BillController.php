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
        $sql = "insert into shop_billing (shop_id,billnum,bill_date,total) values ($shop_id,$billnum,'$bill_date',$amount)";
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
