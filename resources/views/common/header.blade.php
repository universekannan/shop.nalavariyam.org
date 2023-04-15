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
@if(Auth::user()->user_types_id == 1)
<li class="nav-item d-none d-sm-inline-block col-md-1">
        <img src="{!! asset('dist/img/icon/shop.png') !!}" style="width:50px"></br>
@endif
@if(Auth::user()->user_types_id == 2)
<li class="nav-item d-none d-sm-inline-block col-md-1">
        <img src="{!! asset('dist/img/icon/user.png') !!}" style="width:50px"></br>
@endif
<div class="dropdown">
@if(Auth::user()->user_types_id == 1 || Auth::user()->user_types_id == 2)
  @if(Auth::user()->user_types_id == 1)
  <a class="dropbtn"><label>Shop</label></a>
  @endif
  @if(Auth::user()->user_types_id == 2)
  <a class="dropbtn"><label>Users</label></a>
  @endif
  <div class="dropdown-content">
  @if(Auth::user()->user_types_id == 1)
  <a href="{{url('/users')}}">Shop List</a>
  @endif
  @if(Auth::user()->user_types_id == 2)
  <a href="{{url('/users')}}">Users</a>
  @endif
  <!-- <a href="{{url('/users/permissions')}}">Permissions</a> -->
  </div>
@endif
</div>
</li>

@if(Auth::user()->user_types_id == 2)
<li class="nav-item d-none d-sm-inline-block col-md-1">
     <a href="{{url('/products')}}">
      <img src="{!! asset('dist/img/icon/product.png') !!}" style="width:50px"></br>
      <label>Products</label>
    </a>
</li>
@endif

@if(Auth::user()->user_types_id == 1)
<li class="nav-item d-none d-sm-inline-block col-md-1">
     <a href="{{url('/barcode')}}">
      <img src="{!! asset('dist/img/icon/barcode.png') !!}" style="width:50px"></br>
      <label>Bar Code</label>
    </a>
</li>
@endif

@if(Auth::user()->user_types_id == 2)
<li class="nav-item d-none d-sm-inline-block col-md-1">
     <a href="{{url('/minimum')}}">
      <img src="{!! asset('dist/img/icon/purchase.png') !!}" style="width:50px"></br>
      <label>Purchase</label>
    </a>
</li>
@endif

@if(Auth::user()->user_types_id == 2)
<li class="nav-item d-none d-sm-inline-block col-md-1">
     <a href="{{url('/pending')}}">
      <img src="{!! asset('dist/img/icon/print.png') !!}" style="width:50px"></br>
      <label>Print</label>
    </a>
</li>
@endif

@if(Auth::user()->user_types_id == 2)
<li class="nav-item d-none d-sm-inline-block col-md-1">
     <a href="{{url('/approve')}}">
      <img src="{!! asset('dist/img/icon/stock.png') !!}" style="width:50px"></br>
      <label>Stock</label>
    </a>
</li>
@endif
@if(Auth::user()->user_types_id != 1)
<li class="nav-item d-none d-sm-inline-block col-md-1">
     <a href="{{url('/newbill')}}">
      <img src="{!! asset('dist/img/icon/billing.png') !!}" style="width:50px"></br>
      <label>Billing</label>
    </a>
</li>
@endif

@if(Auth::user()->user_types_id != 1)
<li class="nav-item d-none d-sm-inline-block col-md-1">
     <a href="{{url('/billdetails')}}/{{ date('Y-m-d') }}/{{date('Y-m-d')}}">
      <img src="{!! asset('dist/img/icon/billdet.png') !!}" style="width:50px"></br>
      <label>Bill Details</label>
    </a>
</li>
@endif    

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