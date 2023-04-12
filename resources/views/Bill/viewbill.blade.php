<center>
<table>
   <thead>
      <tr><td style="text-align: center" colspan="5">Nalavariam</td></tr>
      <tr><td colspan="5">&nbsp;</td></tr>
      <tr><td colspan="2" style="text-align: left">Name : {{ $cust_name }}</td><td colspan="2" style="text-align: right">Mobile : {{ $mobile }}</td></tr>
      <tr><td colspan="2" style="text-align: left">Bill No : {{ $billnum }}</td><td colspan="2" style="text-align: right">Date : {{ $bill_date }}</td></tr>
      <tr><td colspan="5">&nbsp;</td></tr>
      <tr>
         <th style="text-align: left">Item</th>
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
      <th colspan="5" style="text-align: right;font-weight: bold">Total {{ $total }}</th>
   </tbody>
</table>
</center>


