@extends('layout')
@section('content')
<style>
   table {
   font-family: arial, sans-serif;
   border-collapse: collapse;
   width: 100%;
   }
   td, th {
   border: 1px solid #dddddd;
   text-align: left;
   padding: 4px;
   }
   tr:nth-child(even) {
   background-color:aqua;
   }
   .form-popup {
   display: none;
   position: fixed;
   bottom: 0;
   right: 15px;
   border: 3px solid #f1f1f1;
   z-index: 9;
   }
</style>
<div class="content-wrapper">
   <section class="content">
      <div class="card card-primary card-outline card-outline-tabs">
         <div class="card-header p-0 border-bottom-0">
            <ul  class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" 
                     aria-selected="true">Product</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-profile-tab" 
                     data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" 
                     aria-selected="false">Low Stock</a>
               </li> 
               <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-order-tab" 
                     data-toggle="pill" href="#custom-tabs-four-order" role="tab" aria-controls="custom-tabs-four-order" 
                     aria-selected="false">order</a>
               </li>
               <div class="col-sm-8">
                  <input type="text" class="form-control" id="myInput" 
                     onkeyup="myFunction()" placeholder="Enter Product Name">
               </div>
               <div class="col-sm-1">
                  <td>
                     <button type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#addproduct"><i 
                        class="fa fa-plus"></i> Add</button>
                  </td>
               </div>
            </ul>
         </div>
         <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
               <div class="tab-pane fade show active" id="custom-tabs-four-home" 
			   role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                  <table id="example2" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>#</th>
						         <th>Code</th>
                           <th>Model Name</th>
                           <th>Product Name</th>
                           <th>Quantity</th>
                           <th>MOQ</th>
                           <th>Price</th>
                           <th>Option</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($manageproduct as $key=>$manageproductslist)
                        <tr id="arrayorder_<?php echo $manageproductslist->product_id?>">
                           <td>{{ $key + 1 }}</td>
						         <td>{{ $manageproductslist->product_id }}</td>
                           <td>{{ $manageproductslist->model }}</td>
                           <td>{{ $manageproductslist->name }}</td>
                           <td>{{ $manageproductslist->quantity }}</td>
                           <td>{{ $manageproductslist->minimum }}</td>
                           <td>{{ $manageproductslist->price }}</td>
                           <td>
                              
                                 <a type="button" data-toggle="modal" 
								 data-target="#edit{{ $manageproductslist->product_id }}">
                                 <i class="fa fa-edit"></i></a> 
                           </td>
                        </tr>
						
        <div class="modal fade" id="edit{{ $manageproductslist->product_id }}">
        <form action="{{url('/pharmacy/edit_product')}}" method="post">
                              {{ csrf_field() }}
                              <div class="modal-dialog modal-xl">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h4  class="modal-title">Edit Product</h4>
                                       <button type="button" class="close" data-dismiss="modal"
                                          aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <input type="hidden" class="form-control" name="id" 
                                          value="{{ $manageproductslist->product_id }}"/>
                                       <div class="row">
                                          <div class="col-md-6">
                                             <div class="form-group row">
                                                <label for="product_code" class="col-sm-4 col-form-label">
                                                <span style="color:red"></span>Product Code</label>
                                                <div class="col-sm-8">
                                                   <input  value="{{ $manageproductslist->product_id }}" required="required" 
                                                      type="text" class="form-control"
                                                      name="product_code" id="product_code" maxlength="50" 
                                                      placeholder="product_Code">
                                                </div>
                                             </div>
											 
                                             <div class="form-group row">
                                                <label for="product_name" class="col-sm-4 col-form-label">
                                                <span style="color:red"></span>Product Name</label>
                                                <div class="col-sm-8">
                                                   <input  value="{{ $manageproductslist->product_id }}" required="required" 
                                                      type="text" class="form-control" 
                                                      name="product_name" id="product_name" maxlength="50" 
                                                      placeholder="Product_Name">
                                                </div>
                                             </div>
                                             <div class="form-group row">
                                                <label for="category_id" class="col-sm-4 col-form-label"><span 
                                                   style="color:red"></span>Category</label>

                                                <p>
                                                   <button 
                 onclick="window.open('{{url('/pharmacy/category')}}','MY Window','height=600,width=500,top=200,centeralign=200,right=300')"
                          type="button" 
                          class="btn btn-default btn-sm">
                                                   <span class="fa fa-plus"style="font-size:22px"></span>
                                                   </button>
                                                </p>
                                                <div class="col-sm-1">
                                                </div>
                                             </div>
                                             <div class="form-group row">
                                                <label for="generic_id" class="col-sm-4 col-form-label"><span 
                                                   style="color:red"></span>Generic Name</label>
                                                
                                                <p>
                                               <button 
                         onclick="window.open('{{url('/pharmacy/generics')}}','MY Window','height=600,width=500,top=200,centeralign=200,right=300')"
                         type="button" 
                        class="btn btn-default btn-sm">
                                                   <span class="fa fa-plus"style="font-size:22px"></span>
                                                   </button>
                                                </p>
                                                <div class="col-sm-1">
                                                </div>
                                             </div>
                                            
                                           
										   
                                             <div class="form-group row">
                                                <label for="packing_id" class="col-sm-4 col-form-label"><span 
                                                   style="color:red"></span>Packing Qty</label>
                                                <div class="col-sm-8">
                                                   <select class="form-control select2bs4" name="packing_id"
												   id="packing_id
                                                   style="width: 100%;" required="required">
                                                   <option value="">Select</option>
                                                   <option value="10">10</option>
                                                   <option value="20">20</option>
                                                   <option value="30">30</option>
                                                   <option value="40">40</option>
                                                   <option value="50">50</option>
                                                   </select>
                                                </div>
                                             </div>
											 
                                             <div class="form-group row">
                                                <label for="max_dosage" class="col-sm-4 col-form-label"><span 
                                                   style="color:red"></span>Max Dosage</label>
                                                <div class="col-sm-6">
                                                   <input value="{{ $manageproductslist->product_id }}" required="required" 
                                                      type="text" class="form-control"
                                                      name="max_dosage" id="max_dosage"
                                                      maxlength="50" placeholder="Max_Dosage">
                                                </div>
                                  <label for="(Mg)" class="col-sm-2 col-form-label"><span style="color:red"></span>(Mg)</label>
                                             </div>
											 
                                             <div class="form-group row">
                                                <label for="dosage_per_kg" class="col-sm-4 col-form-label">
                                                <span style="color:red"></span>Dosage Per Kg</label>
                                                <div class="col-sm-6">
                                                   <input value="{{ $manageproductslist->product_id }}" required="required" 
                                                      type="text" class="form-control"
                                                      name="dosage_per kg" id="dosage_per_kg"
                                                      maxlength="50" placeholder="Number">
                                                </div>
                                                <label for="(Mg)" class="col-sm-2 col-form-label"><span 
                                                   style="color:red"></span>(Mg)</label>
                                             </div>
                                          </div>
										  
                                          <div class="col-md-6">
                                             <div class="form-group row">
                                                <label for="food_interaction" class="col-sm-4 col-form-label"><span 
                                                   style="color:red"></span>Food Interaction</label>
                                                <div class="col-sm-8">
                                                   <select class="form-control select2bs4" name="food_interaction"
                                                      id="food_interaction" style="width: 100%;" required="required">
                                      <option value="">Select Food</option>
                                      <option value="Idli">Idli</option>
                                                      <option value="cofe">cofe</option>
                                                      <option value="juice">juice</option>
                                                      <option value="Dosa">Dosa</option>
                                                      <option value="Tea">Tea</option>
                                                      <option value="Tifan">Tifan</option>
                                                   </select>
                                                </div>
                                             </div>
											 
                                             <div class="form-group row">
                                                <label for="company_id" class="col-sm-4 col-form-label"><span 
                                                   style="color:red"></span>Company</label>
                                                <p>
                                                   <button 
                      onclick="window.open('{{url('/pharmacy/company')}}','MY Window','height=600,width=500,top=200,centeralign=200,right=300')"
                                                      type="button" 
                                                      class="btn btn-default btn-sm">
                                                   <span class="fa fa-plus"style="font-size:22px"></span>
                                                   </button>
                                                </p>
                                                <div class="col-sm-1">
                                                </div>
                                                </div>
												
					<div class="form-group row">
					<label for="supplier_id" class="col-sm-4 col-form-label"><span 
					style="color:red"></span>Supplier</label>
			
						<p>
						   <button 
              onclick="window.open('{{url('/pharmacy/supplier')}}','MY Window','height=600,width=500,top=200,centeralign=200,right=300')"
							  type="button" 
							  class="btn btn-default btn-sm">
						   <span class="fa fa-plus"style="font-size:22px"></span>
						   </button>
						</p>
						<div class="col-sm-1">			
						</div>
					 </div>
																			 
						<div class="form-group row">
						<label for="location_id" class="col-sm-4 col-form-label"><span 
					style="color:red"></span>Location</label>
						<p>
						   <button 
                            onclick="window.open('{{url('/pharmacy/locations')}}','MY Window','height=600,width=500,top=200,centeralign=200,right=300')"
							  type="button" 
							  class="btn btn-default btn-sm">
						   <span class="fa fa-plus"style="font-size:22px"></span>
						   </button>
						</p>
						<div class="col-sm-1">			
						</div>
					 </div>
											 
                                             <div class="form-group row">
                                                <label for="mini_order_qty" class="col-sm-4 col-form-label">
                                                <span style="color:red"></span>Mini Order Qty</label>
                                                <div class="col-sm-8">
                                                   <input value="{{ $manageproductslist->product_id }}" required="required" 
                                                      type="text" class="form-control" 
                                                      name="mini_order_qty" id="mini_order_qty" maxlength="50" 
                                                      placeholder="Mini_Order_Qty">
                                                </div>
                                             </div>
                                             
                                             <div class="form-group row">
                                                <label for="sgst(%)" class="col-sm-4 col-form-label">
                                                <span style="color:red"></span>SGST(%)</label>
                                                <div class="col-sm-8">
                                                   <input value="{{ $manageproductslist->product_id }}" required="required"
                                                      type="text" class="form-control" 
                                                      name="sgst" id="sgst" maxlength="50" 
                                                      placeholder="SGST">
                                                </div>
                                             </div>
                                             <div class="form-group row">
                                                <label for="cgst(%)" class="col-sm-4 col-form-label">
                                                <span style="color:red"></span>CGST(%)</label>
                                                <div class="col-sm-8">
                                                   <input value="{{ $manageproductslist->product_id }}" required="required" 
                                                      type="text" class="form-control" 
                                                      name="cgst" id="cgst" maxlength="50" 
                                                      placeholder="CGST">
                                                </div>
                                             </div>
                                             <div class="form-group row">
                                                <label for="hsn_code" class="col-sm-4 col-form-label">
                                                <span style="color:red"></span>Hsn Code</label>
                                                <div class="col-sm-8">
                                                   <input value="{{ $manageproductslist->product_id }}" required="required" 
                                                      type="text" class="form-control" 
                                                      name="hsn_code" id="hsn_code" maxlength="50" 
                                                      placeholder="Code">
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                       <button type="button" class="btn btn-default" 
                                          data-dismiss="modal">Next</button>					
                                       <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                        @endforeach	
                     </tbody>
                  </table>
               </div>
			   
               <div class="tab-pane fade" id="custom-tabs-four-profile" 
                  role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                  <table id="example4" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>#</th>
						          <th>Code</th>
                           <th>Product Name</th>
                           <th>Model</th>
                           <th>Quantity</th>
                           <th>MOQ</th>
                           <th>Action</th>
                        </tr>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($manageminimumstocks as $key=>$manageminimumstock)
                        <tr id="arrayorder_<?php echo $manageminimumstock->product_id?>">
                           <td>{{ $key + 1 }}</td>  
                           <td>{{ $manageminimumstock->product_id }}</td>  
                           <td>{{ $manageminimumstock->name }}</td>
                           <td>{{ $manageminimumstock->model }}</td>
                           <td>{{ $manageminimumstock->quantity }}</td>
                           <td>{{ $manageminimumstock->minimum}}</td>
                           <td>   
                              <a type="button" data-toggle="modal" data-target="#orrder{{ $manageminimumstock->product_id }}">
                              <i class="fa fa-eye"></i></a>           				
                           </td>
                        </tr>
     <!-- Edit foam 2-->
                        <!-- Order start -->		
                        <div class="modal fade"id="orrder{{ $manageminimumstock->product_id }}">
                           <form action="{{url('order')}}" method="post">
                              {{ csrf_field() }}
                              <div class="modal-dialog">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h4  class="modal-title">Order</h4>
                                       <button type="button" class="close" data-dismiss="modal"
                                          aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <input type="hidden" class="form-control" name="product_id" 
                                          value="{{ $manageminimumstock->product_id }}"/>
                                       <div class="form-group row">
                                          <label for="product name" class="col-sm-4 col-form-label">
                                          <span style="color:red"></span>Product Name</label>
                                          <div class="col-sm-8">
                                             <input  value="{{ $manageminimumstock->name }}" required="required" 
                                                type="text" class="form-control" 
                                                name="product_name" id="product_name" maxlength="50" readonly>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label for="mini order qty" class="col-sm-4 col-form-label">
                                          <span style="color:red"></span>Mini Order Qty</label>
                                          <div class="col-sm-8">
                                             <input value="{{ $manageminimumstock->minimum  }}" required="required" 
                                                type="text" class="form-control" 
                                                name="mini_order_qty" id="mini_order_qty" maxlength="50" readonly>
                                          </div>
                                       </div>
                                       
                                       <div class="form-group row">
                                          <label for="order qty" class="col-sm-4 col-form-label">
                                          <span style="color:red"></span>Order Qty</label>
                                          <div class="col-sm-8">
                                             <input required="required" 
                                                type="text" class="form-control" 
                                                name="order_qty" id="order qty" maxlength="50" 
                                                placeholder="order_qty">
                                          </div>
                                       </div>

                                      
                                       <div class="modal-footer justify-content-between">
                                          <button type="button" 
                                             class="btn btn-default" 
                                             data-dismiss="modal">Next</button>					
                                          <button type="submit" 
                                             class="btn btn-primary">Submit</button>
                                       </div>
                                    </form>
                                    </div>
                                 </div>
                              </div>
                        </div>
                        @endforeach	
                     </tbody>
                  </table>
               </div>


                 <div class="tab-pane fade" id="custom-tabs-four-order" 
                  role="tabpanel" aria-labelledby="custom-tabs-four-order-tab">
                  <table id="example3" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>#</th>
                            <th>Code</th>
                           <th>MIN Order QTY</th>
                           <th>Ordered Quantity</th>
                           <th>Order Date</th>
                           <th>Order Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                   
                  </table>
               </div>
            </div>
         </div>
      </div>
      <!-- /.card -->
</div>
<!-- /.card -->
</section>
</form>
<!--Order end-->		
<!-- add product start-->	  
<div class="modal fade" id="addproduct">
   <form action="{{url('/pharmacy/add_product')}}" method="post">
      {{ csrf_field() }}
      <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-header">
               <h4  class="modal-title">Product Details</h4>
               <button type="button" class="close" data-dismiss="modal"
                  aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
   <form action="" method="post" enctype="multipart/form-data" 
      class="form-horizontal">
   <div class="row">
   <div class="col-md-6">   
   <div class="form-group row">
   <label for="product_code" class="col-sm-4 col-form-label">
   <span style="color:red"></span>Product Code</label>
   <div class="col-sm-8">
   <input  required="required" type="text" class="form-control"
      name="product_code" id="product_code" maxlength="50" 
      placeholder="product_Code">
   </div>
   </div>
   <div class="form-group row">
   <label for="product_name" class="col-sm-4 col-form-label">
   <span style="color:red"></span>Product Name</label>
   <div class="col-sm-8">
   <input  required="required" type="text" class="form-control" 
      name="product_name" id="product_name" maxlength="50" 
      placeholder="Product_Name">
   </div>
   </div>
   <div class="form-group row">
   <label for="category_id" class="col-sm-4 col-form-label"><span 
      style="color:red"></span>Category</label>
   
   <p>
   <button 
      onclick="window.open('{{url('/pharmacy/category')}}','MY Window','height=600,width=500,top=200,centeralign=200,right=300')"
      type="button" 
      class="btn btn-default btn-sm">
   <span class="fa fa-plus"style="font-size:22px"></span>
   </button>
   </p>	
   </div>
   <div class="form-group row">
   <label for="generic_id" class="col-sm-4 col-form-label"><span 
      style="color:red"></span>Generic Name</label>
   <div class="col-sm-7">
  
   <p>
   <button 
      onclick="window.open('{{url('/pharmacy/generics')}}','MY Window','height=600,width=500,top=200,centeralign=200,right=300')"
      type="button" 
      class="btn btn-default btn-sm">
   <span class="fa fa-plus"style="font-size:22px"></span>
   </button>
   </p>	
   <div class="col-sm-1">
   </div>
   </div>

   
   <div class="form-group row">
   <label for="packing_qty" class="col-sm-4 col-form-label"><span 
      style="color:red"></span>Packing Qty</label>
   <div class="col-sm-8">
   <select class="form-control select2bs4" name="packing_qty" 
      id="packing_qty" 
      style="width: 100%;" required="required">
   <option value="">Select</option>
   <option value="10">10</option>
   <option value="20">20</option>
   <option value="30">30</option>
   <option value="40">40</option>
   <option value="50">50</option>
   </select>
   </div>
   </div>
   
   <div class="form-group row">
   <label for="max_dosage" class="col-sm-4 col-form-label"><span 
      style="color:red"></span>Max Dosage</label>
   <div class="col-sm-6">
   <input required="required" type="text" class="form-control"
      name="max_dosage" id="max_dosage"
      maxlength="50" placeholder="max_dosage">
   </div>
   <label for="(mg)" class="col-sm-2 col-form-label"><span style="color:red"></span>(Mg)</label>
   </div>
   <div class="form-group row">
   <label for="dosage_per_kg" class="col-sm-4 col-form-label">
   <span style="color:red"></span>Dosage Per Kg</label>
   <div class="col-sm-6">
   <input required="required" type="text" class="form-control"
      name="dosage_per kg" id="dosage_per_kg"
      maxlength="50" placeholder="Number">
   </div>
   <label for="(Mg)" class="col-sm-2 col-form-label"><span 
      style="color:red"></span>(Mg)</label>
   </div>
   </div>
   
   <div class="col-md-6">
   <div class="form-group row">
   <label for="food_interaction" class="col-sm-4 col-form-label"><span 
      style="color:red"></span>Food Interaction</label>
   <div class="col-sm-8">
   <select class="form-control select2bs4" name="food_interaction"
      id="food_interaction" style="width: 100%;" required="required">
   <option value="">Select</option>
   <option value="idli">Idli</option>
   <option value="cofe">Coffe</option>
   <option value="juice">Juice</option>
   <option value="dosa">Dosa</option>
   <option value="tea">Tea</optioN>
   <option value="tifan">Tifan</option>
   </select>
   </div>
   </div>
   
   <div class="form-group row">
   <label for="company_id" class="col-sm-4 col-form-label"><span 
      style="color:red"></span>Company</label>
   <p>
   <button 
      onclick="window.open('{{url('/pharmacy/company')}}','MY Window','height=600,width=500,top=200,centeralign=200,right=300')"
      type="button" 
      class="btn btn-default btn-sm">
   <span class="fa fa-plus"style="font-size:22px"></span>
   </button>
   </p>	
   <div class="col-sm-1">
   </div>
   </div>
   
              <div class="form-group row">
             <label for="supplier_id" class="col-sm-4 col-form-label"><span 
             style="color:red"></span>Supplier</label>
               <p>
               <button 
               onclick="window.open('{{url('/pharmacy/supplier')}}','MY Window','height=600,width=500,top=200,centeralign=200,right=300')"
               type="button" 
               class="btn btn-default btn-sm">
               <span class="fa fa-plus"style="font-size:22px"></span>
               </button>
               </p>	
               <div class="col-sm-1">
               </div>
               </div>
			  
           <div class="form-group row">
           <label for="location_id" class="col-sm-4 col-form-label"><span 
           style="color:red"></span>Location</label>

           <p>
           <button 
      onclick="window.open('{{url('/pharmacy/locations')}}','MY Window','height=600,width=500,top=200,centeralign=200,right=300')"
      type="button" 
      class="btn btn-default btn-sm">
   <span class="fa fa-plus"style="font-size:22px"></span>
   </button>
   </p>	
   <div class="col-sm-1">
   </div>
   </div>

   <div class="form-group row">
   <label for="mini_order_qty" class="col-sm-4 col-form-label">
   <span style="color:red"></span>Mini Order Qty</label>
   <div class="col-sm-8">
   <input  required="required" type="text" class="form-control" 
      name="mini_order_qty" id="mini_order_qty" maxlength="50" 
      placeholder="Mini_Order_Qty">
   </div>
   </div>
   
   <div class="form-group row">
   <label for="sgst(%)" class="col-sm-4 col-form-label">
   <span style="color:red"></span>SGST(%)</label>
   <div class="col-sm-8">
   <input  required="required" type="text" class="form-control" 
      name="sgst" id="sgst" maxlength="50" 
      placeholder="SGST">
   </div>
   </div>
   <div class="form-group row">
   <label for="cgst(%)" class="col-sm-4 col-form-label">
   <span style="color:red"></span>CGST(%)</label>
   <div class="col-sm-8">
   <input  required="required" type="text" class="form-control" 
      name="cgst" id="cgst" maxlength="50" 
      placeholder="CGST">
   </div>
   </div>
   <div class="form-group row">
   <label for="hsn_code" class="col-sm-4 col-form-label">
   <span style="color:red"></span>Hsn Code</label>
   <div class="col-sm-8">
   <input  required="required" type="text" class="form-control" 
      name="hsn_code" id="hsn_code" maxlength="50" 
      placeholder="Code">
   </div>
   </div>
   </div>		
   </div>
   </div> 
   </form>    
   <div class="modal-footer justify-content-between">
   <button type="button" class="btn btn-default" 
      data-dismiss="modal">Next</button>					
   <button type="submit" class="btn btn-primary">Submit</button>
   </div>	
   </div>
   </div>
   </form>
</div>
</div>
</div>
</section>
</div>
<!-- add product ending-->
@endsection
@push('page_scripts')
<script src="{!! asset('plugins/jquery/jquery.min.js') !!}"></script>
<script src="{!! asset('dist/js/pages/dashboard2.js') !!}"></script>

<script>
   function myFunction() {
     const input = document.getElementById("myInput");
     const inputStr = input.value.toUpperCase();
     document.querySelectorAll('#example1 tr:not(.header)').forEach((tr) => {
       const anyMatch = [...tr.children]
         .some(td => td.textContent.toUpperCase().includes(inputStr));
       if (anyMatch) tr.style.removeProperty('display');
       else tr.style.display = 'none';
     });
   }
   JavaScript
   function openWindow() {
     var win = window.open
     ("", "Title", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=780,height=200, top="+(screen.height-400)+", left="+(screen.width-840));
     win.document.body.innerHTML = "Product Details";
   }
</script>



@endpush
