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
         aria-selected="true">Pending Purchase</a>
      </li>

      <!-- <div class="col-sm-8">
         <input type="text" class="form-control" id="myInput"  placeholder="Enter Product Name">
      </div> -->

   </ul>
</div>
<div class="card-body">
   <div class="tab-content" id="custom-tabs-four-tabContent">
      <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
         <table id="example1" class="table table-bordered table-hover">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Code</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
               </tr>
            </thead>
            <tbody>
               @foreach($manageproduct as $key=>$prod)
               <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $prod->product_id }}</td>
                  <td>{{ $prod->name }}</td>
                  <td>{{ $prod->pqty }}</td>
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
@endsection

