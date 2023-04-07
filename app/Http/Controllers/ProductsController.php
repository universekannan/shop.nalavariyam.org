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


class ProductsController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  /******   Manage ph_products Start ******/

      /* public function manageph_prods(){
			$manageph_prods = DB::table('ph_products')->select('ph_products.*','product_groups.*','product.id as productID')
                ->Join('product_groups', 'product_groups.id', '=', 'ph_products.role_id')
                ->where('ph_products.role_id', '=','2')->orderBy('ph_products.id','Asc')->get();
	        return view("ph_products.index")->with('manageph_prods', $manageph_prods);

        }*/
        /****** Manage ph_products End ******/

        public function managesupplier(){
          $managesupplier = DB::table('ph_supplier')->orderBy('id','Asc')->get();
          return view("pharmacy/products.supplier")->with('managesupplier',$managesupplier);
        }

        public function save_purchase(Request $request){
          $shop_id = Auth::user()->shop_id;
          $created_at = date("Y-m-d H:i:s");
          $item_id = $request->item_id;
          $pqty = $request->pqty;
          $sql = "insert into purchase (shop_id,item_id,pqty,created_at) values ($shop_id,$item_id,$pqty,'$created_at')";
          DB::insert($sql);
        }

        public function manageProducts(){
         $manageproduct = DB::table('oc_product')->select('oc_product.*','oc_product_description.*')->Join('oc_product_description', 'oc_product.product_id', '=', 'oc_product_description.product_id')

         ->orderBy('oc_product.product_id','Asc')->get();


         $sql = "SELECT a.*,b.name FROM oc_product a,oc_product_description b WHERE a.product_id=b.product_id";
         $manageminimumstocks = DB::select(DB::raw($sql));


          //$manageorder = DB::table('oc_order')->select('oc_order.*','oc_product.*')->orderBy('oc_order.id','Asc')->get();





         return view("products.index")->with('manageproduct', $manageproduct)->with('manageminimumstocks', $manageminimumstocks);
       }

       /******   Add ph_prods  Start ******/

       public function addProduct(Request $request){

         $addproduct = DB::table('ph_products')->insert([
          'product_code'	        =>   $request->product_code,
          'product_name'	        =>   $request->product_name,
          'category_id'	            =>   $request->category_id,
          'generic_id'	            =>   $request->generic_id,
          'company_id'              =>   $request->company_id,
          'supplier_id'             =>   $request->supplier_id,
          'mini_order_qty'          =>   $request->mini_order_qty,
          'location_id'             =>   $request->location_id,	
          'packing_id'	            =>   $request->packing_id,
          'packing_qty'	            =>   $request->packing_qty,
          'max_dosage'	            =>   $request->max_dosage,
          'dosage_per_kg'	        =>   $request->dosage_per_kg,
          'food_interaction'		=>   $request->food_interaction, 
          'sgst'                    =>   $request->sgst,
          'cgst'                    =>   $request->cgst,
          'hsn_code'                =>   $request->hsn_code,
          'created_at'	            =>	 date('Y-m-d H:i:s'),
        ]);
                       //Print_r($addproduct);die();

         return redirect()->back(); 
       }

       /****** Add Product End ******/

       /****** Edit Product Start ******/

       public function editProduct(Request $request){

         $editProduct = DB::table('ph_products')->where('id',$request->id)->update([

          'product_code'	        =>   $request->product_code,
          'product_name'	        =>   $request->product_name,
          'category_id'	            =>   $request->category_id,
          'generic_id'	            =>   $request->generic_id,
          'company_id'              =>   $request->company_id,
          'supplier_id'             =>   $request->supplier_id,
          'mini_order_qty'          =>   $request->mini_order_qty,
          'location_id'             =>   $request->location_id,	
          'packing_id'	            =>   $request->packing_id,
          'packing_qty'	            =>   $request->packing_qty,
          'max_dosage'	            =>   $request->max_dosage,
          'dosage_per_kg'	        =>   $request->dosage_per_kg,
          'food_interaction'		=>   $request->food_interaction, 
          'sgst'                    =>   $request->sgst,
          'cgst'                    =>   $request->cgst,
          'hsn_code'                =>   $request->hsn_code,
          'created_at'	            =>	 date('Y-m-d H:i:s'),
        ]);
         return redirect()->back(); 
       }

       /******   Edit Product End ******/

       /******   Edit Order Start ******/

       public function Order(Request $request){

        $Order = DB::table('order')->insert([
          'product_id'	        =>   $request->product_id,
          'mini_order_qty'        =>   $request->mini_order_qty,
          'max_order_qty'         =>   $request->max_order_qty,
          'order_qty'             =>   $request->order_qty,
          'status'                =>   "ordered",
          'order_date'            =>   date('Y-m-d H:i:s'),
        ]);
        return redirect()->back(); 
      } 

      public function Stock(Request $request){


        $qty = $request->input('qty');
        $reac = $request->input('reac');

        $calculated = $qty + $reac;    
                 //dd($calculated);

        $Stock = DB::table('order')->where('product_id',$request->product_id)->update([
          'status'                =>   "received",
        ]);

        $product = DB::table('oc_product')->where('product_id',$request->product_id)->update([
          'quantity'                =>  $calculated,
        ]);

        return redirect()->back(); 
      }

      /******   Edit Order End ******/

      public function addSupplier(Request $request){

        $addSupplier = DB::table('supplier')->insert([
          'supplier_name'	         =>   $request->supplier_name,
          'contact'                =>   $request->contact,
          'address'                =>   $request->address,
        ]);
        return redirect()->back(); 
      }

      public function editSupplier(Request $request){

        $editSupplier = DB::table('supplier')->where('id',$request->id)->update([

          'supplier_name'	        =>   $request->supplier_name,
          'contact'	            =>   $request->contact,
          'address'	            =>   $request->address,
        ]);
        return redirect()->back(); 
      }

      /******    Delete Users  Start ******/

      public function deleteUser(Request $request){

        $deluser = DB::table('users')->where('id',$request->id)->delete();
        return redirect()->back(); 

      }

      /******   Delete Users  End ******/

      /******   Delete Patients  Start ******/
      public function managePatients(){
       $managepatients = DB::table('users')
       ->Join('patient_disease', 'patient_disease.id', '=', 'users.disease_id')
       ->where('users.role_id', '=','2')->get();
       return view("patients.index")->with('managepatients', $managepatients);

     }
     /******   Delete Patients  End ******/
     /******    Sorting Users  Start ******/

     public function planSorting(Request $request)
     {
      $array  = $request->arrayorder;
            //Print_r($array);die();
      if($request->update == "update")
      {
        $count = 1;

        foreach ($array as $idval)
        {
                    //$data=array('sort_order'=> $count);
          $sortPlan = DB::table('manage_plan')->where('id',$idval)->update(['sort_order' =>   $count]);
          $count ++;
        }
      }

      echo 'Manage Plan Order Change Successfully....!';
    }

    /******    Sorting Users  End ******/
    public function manageNewSales(Request $request)
    {
    }

  }
