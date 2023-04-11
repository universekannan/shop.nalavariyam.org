<style>
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 7px 7px;
  text-decoration: none;
  text-align: left;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

legend {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 0px;
    width: 100%;
    border: 1px solid #c5cbfc;
    border-radius: 5px;
    padding: 5px 5px 5px 10px;
    background-color: #ebf5fa;
}

legend {
    border: 0;
    padding: 0;
</style>

<?php
      $permission = DB::table('user_permission')->where('user_id',auth()->user()->id)->first();
 ?>
<div class="preloader flex-column justify-content-center align-items-center">
</div>
 <center>
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <!-- Left navbar links -->
<legend class="scheduler-border">
    <ul class="navbar-nav">
 <div>  <div class="row">
<a href="#" class="navbar-toggler order-1">
</a>

   <li class="navbar-toggler order-1">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
   </li>
</div>
  </div>
 <li class="nav-item d-none d-sm-inline-block col-md-1">
     <a href="{{url('/dashboard')}}">
      <img src="{!! asset('dist/img/icon/opd.png') !!}" style="width:50px"></br>
      <label>Dashboard</label>
    </a>
</li>
<li class="nav-item d-none d-sm-inline-block col-md-1">
        <img src="{!! asset('dist/img/icon/user.png') !!}" style="width:50px"></br>
<div class="dropdown">
@if(Auth::user()->user_types_id == 1 || Auth::user()->user_types_id == 2)
  <a class="dropbtn"><label>Users</label></a>
  <div class="dropdown-content">
  <a href="{{url('/users')}}">Users</a>
  <a href="{{url('/users/permissions')}}">Permissions</a>
  </div>
@endif
</div>
</li>
<li class="nav-item d-none d-sm-inline-block col-md-1">
        <img src="{!! asset('dist/img/icon/product.png') !!}" style="width:50px"></br>
<div class="dropdown">
@if(Auth::user()->user_types_id == 1 || Auth::user()->user_types_id == 2)
  <a class="dropbtn"><label>Products</label></a>
  <div class="dropdown-content">
  <a href="{{url('/products')}}">All Products</a>
  <a href="{{url('/minimum')}}">Purchase</a>
  <a href="{{url('/pending')}}">Purchase Print</a>
  <a href="{{url('/approve')}}">Stock</a>
  </div>
@endif
</div>
</li>

<li class="nav-item d-none d-sm-inline-block col-md-1">
     <a href="{{url('/newbill')}}">
      <img src="{!! asset('dist/img/icon/billing.png') !!}" style="width:50px"></br>
      <label>Billing</label>
    </a>
</li>

<li class="nav-item d-none d-sm-inline-block col-md-1">
     <a href="{{url('/billdetails')}}/{{ date('Y-m-d') }}/{{date('Y-m-d')}}">
      <img src="{!! asset('dist/img/icon/billdet.png') !!}" style="width:50px"></br>
      <label>Bill Details</label>
    </a>
</li>
    

<li class="nav-item d-none d-sm-inline-block col-md-1">
       <img src="{!! asset('dist/img/icon/logout.png') !!}" style="width:50px"></br>
      <div class="dropdown">
        <a class="dropbtn"><label>Log Out</label></a>
        <div class="dropdown-content">
        <a href=""> User Details</a>
        <a href="">Backup</a>
        <a href="">Change Password</a>
        <a href="{{url('/logout')}}">Log Out</a>
        </div>
      </div>
    </li>  
    </ul>
  </nav>
  
 </center>