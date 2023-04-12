@extends('layout')
@section('content')
<div class="content-wrapper">
   <section class="content">
      <div class="card card-primary card-outline card-outline-tabs">
         <div class="card-header p-0 border-bottom-0">
            <ul  class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" 
                  aria-selected="true">Bill Details</a>
               </li>

               <div class="col-sm-8">
                <form class="row col-sm-7" action="" onsubmit="" method="post" >
                  <div class="col-sm-5" style="padding-top: calc(.1rem + 0px);">
                     <input type="date" id="from" value="{{ $from }}" class="form-control" name="from" >
                  </div>
                  <div class="col-sm-5" style="padding-top: calc(.1rem + 0px);">
                     <input type="date" id="to" value="{{ $to }}" class="form-control" name="to" >
                  </div>
                  <div class="col-sm-2" style="padding-top: calc(.2rem + 0px);">
                     <input onclick="load_billdetails()" type="button"  value="Apply" class="form-control text-center btn btn-block btn-outline-info btn-sm" />
                  </div>
               </form>
            </div> 

         </ul>

      </div>
      <table id="example2" class="table table-bordered table-hover">
         <thead>
            <tr>
               <th>#</th>
               <th>Bill#</th>
               <th>View</th>
               <th>Date</th>
               <th>Total</th>
               <th>Mobile</th>
               <th>Customer</th>
            </tr>
         </thead>
         <tbody>
            @foreach($bill as $key=>$b)
            <tr>
               <td>{{ $key + 1 }}</td>
               <td>{{ $b->billnum }}</td>
               <td><a href="#" onclick="view_bill({{ $b->id }})" class="fa fa-eye" ></a></td>
               <td>{{ $b->bill_date }}</td>
               <td>{{ $b->total }}</td>
               <td>{{ $b->mobile }}</td>
               <td>{{ $b->cust_name }}</td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</section>
</div>
@endsection

