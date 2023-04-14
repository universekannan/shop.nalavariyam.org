<center>
<table>
   <thead>
      <tr><td style="text-align: center" colspan="4">Nalavariam</td></tr>
      <tr><td colspan="4">&nbsp;</td></tr>
      <tr><td colspan="2" style="text-align: left">Name : {{ $cust_name }}</td><td colspan="2" style="text-align: right">Mobile : {{ $mobile }}</td></tr>
      <tr><td colspan="2" style="text-align: left">Bill No : {{ $billnum }}</td><td colspan="2" style="text-align: right">Date : {{ $bill_date }}</td></tr>
      <tr><td colspan="4">&nbsp;</td></tr>
      <tr>
         <th style="text-align: left;">Item</th>
         <th style="text-align: right">Rate</th>
         <th style="text-align: right">Qty</th>
         <th style="text-align: right">Amount</th>
      </tr>
   </thead>
   <tbody>
      @foreach($bill as $key=>$b)
      <tr>
         <td style="text-align: left">{{ $b->name }}</td>
         <td style="text-align: right">{{ $b->item_rate }}</td>
         <td style="text-align: right">{{ $b->quantity }}</td>
         <td style="text-align: right">{{ $b->amount }}</td>
      </tr>
      @endforeach
      <tr style="text-align: right;font-weight: bold"><td colspan="4">Total : {{ $total }}</tr>
      <tr style="text-align: right;font-weight: bold"><td colspan="4">GST : {{ $gst_amount }}</td></tr>
      <tr style="text-align: right;font-weight: bold"><td colspan="4">Net Total : {{ $net_amount }}</td></tr>
   </tbody>
</table>
</center>


