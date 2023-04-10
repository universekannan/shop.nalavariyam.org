@extends('layout')
@section('content')
<div class="content-wrapper">
   <section class="content">
    <section class="content">
        <div class="container-fluid">
           <div class="row">
              <div class="col-md-3">
                  <div class="card card-info">
                    <div class="card-body">

                        <div class="form-group row">
                          <select class="form-control select2bs4 product" style="width: 100%;" name="PID" id="PID" onchange="show_vbm()">
                            <option>select Product</option>
                            @foreach($manageproducts as $key=>$manageproduct)
                            <option value="{{ $manageproduct->product_id }}~{{ $manageproduct->name }}" data-rate="{{$manageproduct->price }}">
                             {{ $manageproduct->name }}</option>
                             @endforeach
                         </select>
                     </div>
                     <div class="form-group row">
                       <input  required="required" type="text" class="form-control rate"
                       name="product_code" id="rate" disabled  maxlength="50" 
                       placeholder="Price">
                   </div>
                   <div class="form-group row">
                       <input onkeyup="calculate_amount()"  required="required" type="number" class="form-control"
                       name="product_code" id="quantity"
                       placeholder="Quantity">
                   </div>
                   <div class="form-group row">
                       <input  required="required" disabled type="text" class="form-control"
                       name="total" id="total" 
                       placeholder="Total">
                   </div>
                   <div class="form-group row">
                    <div class="col-md-12 text-center">
                        <a onclick="return add_row()" required="required" class="btn btn-success"
                        type="button"
                        name="add">ADD</a>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="col-md-9">
      <div class="card card-info">
        <div class="card-body">
            <div class="login-panel panel panel-default">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tab_logic">
                                <thead>
                                    <tr >
                                        <th class="text-center">
                                            S No
                                        </th>
                                        <th class="text-center">
                                            Product Name
                                        </th>

                                        <th class="text-center">
                                            Quantity
                                        </th>
                                        <th class="text-center">
                                            MRP
                                        </th>
                                        <th class="text-center">
                                            Rate
                                        </th>

                                        <th class="text-center">
                                          <a class="btn btn-danger btn-sm" href="#"><i class="fa fa-times"></i></a>
                                      </th>

                                  </tr>

                              </thead>
                              <tbody>
                                <tr id='addr0'></tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 col-md-8"></div>
                <label class="control-label col-md-1">Total</label>

                <div class="col-md-3 pull-right form-inline">

                    <input readonly type="text" name="total_amount" id="total_amount" class="form-control Number">

                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 col-md-4"></div>
                <label class="control-label col-md-1"></label>

                <div class="col-md-3 pull-right form-inline">

                    <form class="form-inline" name="cust_form" role="form" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="b"> 
                                <div  style="float:right">
                                    <a onclick="submit_data()" required="required" class="btn btn-success"
                                    type="button"
                                    name="save"/>SAVE</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

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
</section>
<!-- /.content -->
</div>
@endsection
<script src="{!! asset('plugins/jquery/jquery.min.js') !!}"></script>
<script src="{!! asset('dist/js/pages/dashboard2.js') !!}"></script>
<script src="{!! asset('plugins/select2/js/select2.full.min.js') !!}"></script>
<script>
   $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
  })
});

</script>


