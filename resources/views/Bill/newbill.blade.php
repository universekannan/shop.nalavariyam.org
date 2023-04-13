@extends('layout')
@section('content')
<style>
  .tt-hint,
  .product_id2 {
    border: 1px solid blue !important;
    font-size: 18px;
    height: 35px;
    line-height: 30px;
    outline: medium none;
    padding: 8px 12px;
  }
  .tt-dropdown-menu {
    margin-top: 5px;
    padding: 8px 12px;
    background-color: #fff;
    border: 1px solid #ccc;
    border: 1px solid rgba(0, 0, 0, 0.2);
    color: #111;
    background-color: #F1F1F1;
    text-align: left;
  }
  .tt-is-under-cursor {
    background-color: #2caab3;
    color: white !important;
  }

</style>
<div class="content-wrapper">
 <section class="content">
  <section class="content">
    <div class="container-fluid">
     <div class="row">
      <div class="col-md-3">
        <div class="card card-info">
          <div class="card-body">
           <div class="form-group row">
             <input maxlength="15" type="text" class="form-control number" name="mobile" id="mobile" placeholder="Mobile">
           </div>
           <div class="form-group row">
             <input maxlength="30" type="text" class="form-control" name="cust_name" id="cust_name" placeholder="Customer Name">
           </div>
           <div class="form-group row" id="barcode_div">
             <input maxlength="13" type="text" class="form-control number" name="bar_code" id="bar_code"  placeholder="Bar Code">
           </div>
           <div class="form-group row" id="product_div">
            <input tabindex="0" onkeypress="return runScript1(event)" placeholder="" autofocus autocomplete="off" maxlength="100" class="form-control product_id2" id="product_id2" name="product_id2" />
            <input type="hidden" name="PID" id="PID" value="">
            <input type="hidden" name="product_id3" id="product_id3" value="">
          </div>
          <div class="form-group row">
           <input  required="required" type="text" class="form-control rate"
           name="product_code" id="rate" disabled  maxlength="50" 
           placeholder="Price">
         </div>
         <div class="form-group row">
           <input maxlength="2" onkeypress="return runScript2(event)" onkeyup="calculate_amount()"  required="required" type="text" class="form-control number"  name="product_code" id="quantity" placeholder="Quantity">
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
                        Rate
                      </th>
                      <th class="text-center">
                        Amount
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


