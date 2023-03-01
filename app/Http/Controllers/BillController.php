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
          $manageproducts = DB::table('product')->select('product.*','product_description.name','product_description.product_id','product.product_id as pID')
                ->Join('product_description', 'product.product_id', '=', 'product_description.product_id')
                ->orderBy('product.product_id','Asc')->get();
           
            return view("Bill.newbill")->with('manageproducts',$manageproducts);
        }

        public function getdata(Request $request)
        {
           $sales = $request->get('sales');
           $amount = $request->get('amount');
           $sales_array = json_decode($sales,true);

           foreach($sales_array as $sal){
            $item_id = $sal["item_id"];
            $item_quantity = $sal["item_quantity"];
            $item_rate = $sal["item_rate"];
            $item_amount = $sal["item_amount"];
           }

       }

}
