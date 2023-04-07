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
.dataTables_wrapper .dataTables_filter {
  width:100%;
  text-align:center;
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

      <div class="col-sm-8">
         <input type="text" class="form-control" id="myInput"  placeholder="Enter Product Name">
      </div>

   </ul>
</div>
<div class="card-body">
   <div class="tab-content" id="custom-tabs-four-tabContent">
      <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
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
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @foreach($manageproduct as $key=>$prod)
               <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $prod->product_id }}</td>
                  <td>{{ $prod->model }}</td>
                  <td>{{ $prod->name }}</td>
                  <td>{{ $prod->quantity }}</td>
                  <td>{{ $prod->minimum }}</td>
                  <td>{{ $prod->price }}</td>
                  <td><a onclick="show_purchase_modal('{{ $prod->product_id }}','{{ $prod->name }}','{{ $prod->minimum }}','{{ $prod->quantity }}')" href="#" class="btn btn-xs btn-success">Purchase</a></td>
               </tr>
               @endforeach 
            </tbody>
         </table>
      </div>
   </div>
</div>
</div>
</section>
</div>
<div class="modal fade" id="purchasemodal">
{{ csrf_field() }}
<div class="modal-dialog modal-xl">
<div class="modal-content">
<div class="modal-header">
   <h4  class="modal-title" id="product_name">Purchase</h4>
   <button type="button" class="close" data-dismiss="modal"
   aria-label="Close">
   <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="post">
   <input type="hidden" class="form-control" name="product_id"  />
   <div class="row">
      <div class="col-md-4">Minimum Stock</div>
      <div class="col-md-8"><p id="min_stock"></p></div>
   </div>  
   <div class="row">
      <div class="col-md-4">Available Stock</div>
      <div class="col-md-8"><p id="avl_stock"></p></div>
   </div> 
   <div class="row">
      <div class="col-md-4">Purchase Quantity</div>
      <div class="col-md-2"><input class="form-control" type="text" size="4" name="pqty" maxlength="4"></div>
   </div>      
   </form>
</div>
<div class="modal-footer" >
   <button type="submit" class="btn btn-primary">Save</button>
   <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
@endsection

