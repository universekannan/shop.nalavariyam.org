
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{!! asset('plugins/jquery/jquery.min.js') !!}"></script>
<!-- Bootstrap -->
<script src="{!! asset('plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- overlayScrollbars -->
<script src="{!! asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! asset('dist/js/adminlte.js') !!}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{!! asset('plugins/jquery-mousewheel/jquery.mousewheel.js') !!}"></script>
<script src="{!! asset('plugins/raphael/raphael.min.js') !!}"></script>
<script src="{!! asset('plugins/jquery-mapael/jquery.mapael.min.js') !!}"></script>
<script src="{!! asset('plugins/jquery-mapael/maps/usa_states.min.js') !!}"></script>
<!-- ChartJS -->

<script src="{!! asset('plugins/datatables/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
<script src="{!! asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}"></script>
<script src="{!! asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}"></script>
<script src="{!! asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') !!}"></script>
<script src="{!! asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') !!}"></script>
<script src="{!! asset('plugins/jszip/jszip.min.js') !!}"></script>
<script src="{!! asset('plugins/pdfmake/pdfmake.min.js') !!}"></script>
<script src="{!! asset('plugins/pdfmake/vfs_fonts.js') !!}"></script>
<script src="{!! asset('plugins/datatables-buttons/js/buttons.html5.min.js') !!}"></script>
<script src="{!! asset('plugins/datatables-buttons/js/buttons.print.min.js') !!}"></script>
<script src="{!! asset('plugins/datatables-buttons/js/buttons.colVis.min.js') !!}"></script>
<script src="{!! asset('plugins/moment/moment.min.js') !!}"></script>
<script src="{!! asset('plugins/inputmask/jquery.inputmask.min.js') !!}"></script>
<script src="{!! asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') !!}"></script>
<!-- fullCalendar 2.2.5 -->
<script src="{!! asset('plugins/moment/moment.min.js') !!}"></script>
<script src="{!! asset('plugins/fullcalendar/main.js') !!}"></script>
<script src="{!! asset('plugins/jquery-ui/jquery-ui.min.js') !!}"></script>
<!-- date-range-picker -->
<script src="{!! asset('plugins/daterangepicker/daterangepicker.js') !!}"></script>
<!-- Ekko Lightbox -->
<script src="{!! asset('plugins/ekko-lightbox/ekko-lightbox.min.js') !!}"></script>
<!-- Select2 -->
<script src="{!! asset('plugins/select2/js/select2.full.min.js') !!}"></script>

<script src="{!! asset('dist/js/typeahead.js') !!}"></script>

<script>
  $(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({
      alwaysShowClose: true
    });
  });
</script>
<script>

 function show_purchase_modal(product_id,name,min_stock,avl_stock){
  $("#product_id").val(product_id);
  $("#product_name").html(name);
  $("#min_stock").html(min_stock);
  $("#avl_stock").html(avl_stock);
  $('#purchasemodal').modal('show');
}  

function load_billdetails(){
  var billdetails = "{{ url('billdetails') }}";
  var from = $("#from").val();
  var to = $("#to").val();
  var url =  billdetails + "/" + from + "/" +to; 
  window.location.href = url;
} 

function show_approve_modal(product_id,name,min_stock,avl_stock,pqty,pur_id){
  $("#product_id").val(product_id);
  $("#purchase_id").val(pur_id);
  $("#product_name").html(name);
  $("#min_stock").html(min_stock);
  $("#avl_stock").html(avl_stock);
  $("#pqty").val(pqty);
  $('#purchasemodal').modal('show');
}   

function cancel_purchase(item_id,pur_id){
  var CSRF_TOKEN = $("input[name=_token]").val();
  var url =  "{{ url('cancel_purchase') }}";
  $.ajax({
   type: 'POST',
   url: url,
   data: {
     pur_id: pur_id,
     _token: CSRF_TOKEN
   },
   success: function (data) {
    $("#purchasetd_"+item_id).html("");
  },
  error : function(error){
   alert(JSON.stringify(error));
 }
});

}

function approve_purchase(){
  var CSRF_TOKEN = $("input[name=_token]").val();
  var item_id = $("#product_id").val(); 
  var pur_id = $("#purchase_id").val(); 
  var pqty = $("#pqty").val(); 
  if(pqty == ""){
    alert("Enter Purchase Quantity");
    $("#pqty").focus();
    return;
  }
  var url =  "{{ url('approve_purchase') }}";
  $.ajax({
   type: 'POST',
   url: url,
   data: {
     item_id: item_id,
     pqty: pqty,
     pur_id: pur_id,
     _token: CSRF_TOKEN
   },
   success: function (data) {
    $('#purchasemodal').modal('toggle');
    $("#pqty").val("");
    $("#purchasetd_"+item_id).closest('tr').html("");
  },
  error : function(error){
   alert(JSON.stringify(error));
   $('#purchasemodal').modal('toggle');
 }
});
} 

function view_bill(id){
  var url =  "{{ url('viewbill') }}";
  url = url + "/" + id;
  w=500;h=600;
  var left = (screen.width/2)-(w/2);
  var top = 0;
  window.open(url, "Bill", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

function save_purchase(){
  var CSRF_TOKEN = $("input[name=_token]").val();
  var item_id = $("#product_id").val(); 
  var pqty = $("#pqty").val(); 
  if(pqty == ""){
    alert("Enter Purchase Quantity");
    $("#pqty").focus();
    return;
  }
  var url =  "{{ url('save_purchase') }}";
  var product_url =  "{{ url('products') }}";
  $.ajax({
   type: 'POST',
   url: url,
   data: {
     item_id: item_id,
     pqty: pqty,
     _token: CSRF_TOKEN
   },
   success: function (data) {
    $('#purchasemodal').modal('toggle');
      //window.location.href = product_url;
      $("#pqty").val("");
      $("#purchasetd_"+item_id).html("Pending");
    },
    error : function(error){
         //alert(error);
         $('#purchasemodal').modal('toggle');
       }
     });
}

$(document).ready(function () {
    //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    
    if($('#barcode_div').length) $("#bar_code").focus();
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('#example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('#example4').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>

  $("#bar_code").keyup(function (){
    if ($(this).val().length  < 13) {
      return;
    }
    var barcode = $(this).val();
    var url = "{{ url('/getitembybarcode') }}/"+barcode;
    $.get(url, function(data, status){
      data = JSON.parse(data);
      if(data["product_id"] != "0"){
        $('#PID').val(data["product_id"].id);
        $('#product_id2').val(data["name"]);
        $('#product_id3').val(data["name"]);
        $('#rate').val(data["price"]);
        $('#GST').val(data["gst"]);
        $('#tax_name').val(data["tax_name"]);
        $('#quantity').focus();
      }
    })
  });

  function myFunction() {
    const input = document.getElementById("myInput");
    const inputStr = input.value.toUpperCase();
    document.querySelectorAll('#example2 tr:not(.header)').forEach((tr) => {
      const anyMatch = [...tr.children]
      .some(td => td.textContent.toUpperCase().includes(inputStr));
      if (anyMatch) tr.style.removeProperty('display');
      else tr.style.display = 'none';
    });
  }
</script>


<script>
  $(document).ready(function(){
    $("#custom").click(function(){
      $("#showCustom").toggle(500);
    });

    $('.number').keypress(function (event) {
      var keycode = event.which;
      if (!(event.shiftKey == false && (keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
      }
    });
  });
</script>

<script>
  function calculate_amount() {
    var rate = $('#rate').val();
    var quantity = $('#quantity').val();
    var gst = $('#GST').val();
    if(quantity!="" && rate!=""){
      var amount=rate*quantity;
      var gst_amount = (amount*gst)/100;
      $('#total').val(amount);
      $('#gst_amount').val(gst_amount);
    }else{
      $('#total').val("");
    }
  }

  $('input.product_id2').typeahead(
  {
    name: 'value',
    valueKey: 'value',
    remote: 'itemsearch/%QUERY'
  }
  ).on('typeahead:selected', function (obj, datum) {
    $('#PID').val(datum.id);
    $('#GST').val(datum.gst);
    $('#tax_name').val(datum.tax_name);
    $('#product_id3').val(datum.value);
    $('#rate').val(datum.price);
    $('#quantity').focus();
  });

  function runScript1(e) {
    if (e.keyCode == 13) {
      var PID = $('#PID').val();
      if(PID != ""){
        $('#quantity').focus();
      }
    }
  }

  function runScript2(e) {
    if (e.keyCode == 13) {
      var quantity = ~~parseInt($('#quantity').val());
      var item_rate= ~~parseInt($('#rate').val());
      var amount=quantity*item_rate;
      if(amount>0){
        add_row();
      }
    }
  }

  function show_vbm(){
    var VBMArray = $("#PID").val().split("~");
    var name = VBMArray[1];
    $("#name").html(name)
  }


  var i = 0;
  var product_id=0;
  var product_name="";
  function add_row() 
  {
   var quantity = $('#quantity').val().trim();
   if(quantity == ""){
    alert("Please enter Quantity");
    $('#quantity').focus();
    return false;
  }

  var product_id = $("#PID").val();
  var amount=$('#total').val();
  var gst_amount=$('#gst_amount').val();
  if(amount!="")
  {
    var product_id = $('#PID').val();
    var name = $('#product_id3').val();
    var item_rate = $('#rate').val();
    var item_quantity = $('#quantity').val();
    var rate = parseFloat($('#total').val()).toFixed(2);
    $('#addr'+i).html("<td class='serial_num'>"+ (i+1) +"</td>"
      +"<td><input readonly value='"+name+"'  name='item_name[]' type='text'  class='form-control'><input readonly value='"+product_id+"' name='product_id[]' type='hidden'  class='form-control'><input readonly value='"+gst_amount+"' name='gst_amount2[]' type='hidden'  class='form-control'></td>"

      +"<td><input readonly value="+item_quantity+" name='item_quantity[]' type='text'  class='form-control'></td>"

      +"<td><input readonly value="+item_rate+" name='item_rate[]' type='text'  class='form-control'></td>"+"<td><input readonly value="+rate+" name='total[]' type='text'  class='form-control'><input readonly value="+rate+" name='total_amount[]' type='hidden'  class='form-control'></td>"

      +"<td><a href='#' class='btn btn-danger btn-sm text-center' onclick='delete_row("+i+")'><i class='fa fa-trash'></i></a></td>");
    $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
    i++;
    $('#rate').val("");
    $('#quantity').val("");
    $('#amount').val("");
    var total_amount=0;
    var gst_amount3=0;
    var net_amount=0;
    var item_amount = $('input[name="total[]"]');
    var gst_amount4 = $('input[name="gst_amount2[]"]');
    for(var j=0;j<i;j++){
      total_amount=total_amount+parseInt(item_amount.eq(j).val());
      gst_amount3=gst_amount3+parseInt(gst_amount4.eq(j).val());
    }
    $('#total_amount').val(total_amount.toFixed(2));
    $('#gat_amount5').val(gst_amount3.toFixed(2));
    net_amount = total_amount + gst_amount3;
    $('#net_amount').val(net_amount.toFixed(2));
    $('#total').val('');
    $('#total').val('');
    $('#PID').val("");
    $('#GST').val("0");
    $('#product_id2').val('');
    $('#product_id3').val('');
    $('#bar_code').val('');
    //$('#product_id2').typeahead('val',''); 
    $('#bar_code').focus();
  }
}


</script>
<script>

 function delete_row(row){
  $("#addr"+(row)).html('');
  i--;
  var total_amount=0;
  var gst_amount3=0;
  var net_amount=0;
  var item_amount = $('input[name="total_amount[]"]');
  var gst_amount4 = $('input[name="gst_amount2[]"]');
  for(var j=0;j<i;j++){
    total_amount=total_amount+parseInt(item_amount.eq(j).val());
    gst_amount3=gst_amount3+parseInt(gst_amount4.eq(j).val());
  }
  $('#total_amount').val(total_amount);
  $('#gat_amount5').val(gst_amount3.toFixed(2));
  net_amount = total_amount + gst_amount3;
  $('#net_amount').val(net_amount.toFixed(2));
}
</script>

<script>

  function submit_data()
  {
    var CSRF_TOKEN = $("input[name=_token]").val();
    var total_amount = ~~parseInt($('#total_amount').val());
    var gst_amount = ~~parseInt($('#gat_amount5').val());
    var net_amount = ~~parseInt($('#net_amount').val());
    if(total_amount<=0)
    {
      alert("Amount should be greater than zero");
      return;
    }
    var mobile = $('#mobile').val();
    var cust_name = $('#cust_name').val();
    var bar_code = $('#bar_code').val();

    var item_id = $('input[name="product_id[]"]');
    var item_quantity = $('input[name="item_quantity[]"]');
    var item_rate = $('input[name="item_rate[]"]');
    var item_amount = $('input[name="total[]"]');
    var tot_amount = $('input[name="total_amount[]"]');
    var sales = new Array();
    for(var j=0;j<i;j++)
    {
      var record = {'item_id':item_id.eq(j).val(),'item_quantity':item_quantity.eq(j).val(),'item_rate':item_rate.eq(j).val(),'item_amount':item_amount.eq(j).val(),'tot_amount':tot_amount.eq(j).val()};
      sales.push(record);
    }
    var sales_data = JSON.stringify(sales);
    console.log(sales_data);
    $.ajax({
      url: "{{ url('/savebill') }}",
      type: "POST",
      data: {
        sales: sales_data,
        amount:total_amount,
        gst_amount:gst_amount,
        net_amount:net_amount,
        mobile:mobile,
        cust_name:cust_name,
        bar_code:bar_code,
        _token: CSRF_TOKEN
      },
      success: function (sales_id) 
      {
        $("#total_amount").val('');
        $("#gat_amount5").val('');
        $("#net_amount").val('');
        for(var j=0;j<i;j++){
          $("#addr"+(j)).html('');
        }
        i = 0;
        //window.open('Bill.newbill' '_blank');
        alert("Bill #: "+sales_id);
      }
    });
  }

  function payproceed(e){
    var quantity = $('#quantity').val().trim();
    if(quantity == ""){
      e.preventDefault();
      alert("Please enter Quantity");
      $('#quantity').focus();
      return false;
    }
  }
</script>

