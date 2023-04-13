@extends('layout')
@section('content')
<div class="content-wrapper">
   <section class="content">
      <div class="card card-primary card-outline card-outline-tabs">
         <div class="card-header p-0 border-bottom-0">
            <ul  class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" 
                  aria-selected="true">Bar Code</a>
               </li>
            </ul>
         </div>
         <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
               <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                  <form action="{{url('/save_barcode')}}" method="post">
                     {{ csrf_field() }}
                     <table id="example4" class="table table-bordered table-hover">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Code</th>
                              <th>Product Name</th>
                              <th>Bar Code</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($products as $key=>$prod)
                           <tr>
                              <td>{{ $key + 1 }}</td>
                              <td>{{ $prod->product_id }}</td>
                              <td>{{ $prod->name }}</td>
                              <td>
                                 <input type="hidden" name="product_id[]" value="{{ $prod->product_id }}" />
                                 <input type="text" name="bar_code[]" value="{{ $prod->bar_code }}" class="form-control mb-3 number" maxlength="13" />
                              </td>
                           </tr>
                           @endforeach 
                        </tbody>
                     </table>
                     <div class="form-group row">
                        <div class="col-md-12 text-center">
                           <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                     </form>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
</div>
@endsection

