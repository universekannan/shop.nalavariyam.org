@extends('layout')
@section('content')
<div class="content-wrapper">
   <section class="content">
      <div class="col-12">
<section class="content">
<div class="container-fluid">

<div class="row">
<div class="col-lg-3 col-6">

<div class="small-box bg-info">
<div class="inner">
<h3>{{ $products }}</h3>
<p>Total Products</p>
</div>
<div class="icon">
<i class="ion ion-bag"></i>
</div>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-success">
<div class="inner">
<h3>{{ $bill }}</h3>
<p>No of Bills</p>
</div>
<div class="icon">
<i class="ion ion-stats-bars"></i>
</div>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-warning">
<div class="inner">
<h3>{{ $purchase }}</h3>
<p>Purchase</p>
</div>
<div class="icon">
<i class="ion ion-person-add"></i>
</div>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-danger">
<div class="inner">
<h3>{{ $stock }}</h3>
<p>Stock</p>
</div>
<div class="icon">
<i class="ion ion-pie-graph"></i>
</div>
</div>
</div>
</div>



</div>

</section>



      </div>
</div>
</div>
</div>
</div>
</section>
<!-- /.content -->
</div>
@endsection
<script src="{!! asset('plugins/jquery/jquery.min.js') !!}"></script>

