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
use Carbon\Carbon;
use DateTime;
use Carbon\CarbonPeriod;
use PDF;
use DateInterval;


class DashboardController extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function dashboard(){
        $user_types_id =  Auth::user()->user_types_id;
    	$shop_id = Auth::user()->shop_id;
    	$products=0;
    	$bill=0;
    	$purchase=0;
    	$stock=0;
    	$today=date("Y-m-d");
    	if($user_types_id==1){
			$sql="select count(*) as no_of_items from oc_product where quantity <>0";
			$result = DB::select(DB::raw($sql));
			if(count($result) > 0){
			  $products = $result[0]->no_of_items;
			}
		}else{
			$sql="select count(*) as no_of_items from stock where shop_id = $shop_id";
			$result = DB::select(DB::raw($sql));
			if(count($result) > 0){
			  $products = $result[0]->no_of_items;
			}
		}
		$sql="select count(*) as no_of_items from shop_billing where bill_date = '$today'";
		if($user_types_id != 1) $sql=$sql." and shop_id=$shop_id";
		$result = DB::select(DB::raw($sql));
		if(count($result) > 0){
		  $bill = $result[0]->no_of_items;
		}
		$sql="select count(*) as no_of_items from purchase where created_at = '$today' and status=0";
		if($user_types_id != 1) $sql=$sql." and shop_id=$shop_id";
		$result = DB::select(DB::raw($sql));
		if(count($result) > 0){
		  $purchase = $result[0]->no_of_items;
		}
		$sql="select count(*) as no_of_items from purchase where created_at = '$today' and status=1";
		if($user_types_id != 1) $sql=$sql." and shop_id=$shop_id";
		$result = DB::select(DB::raw($sql));
		if(count($result) > 0){
		  $stock = $result[0]->no_of_items;
		}

		return view("dashboard",compact('products','bill','purchase','stock'));
	}
}
