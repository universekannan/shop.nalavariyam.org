<center>
<table>
   <thead>
      <tr><td style="text-align: center" colspan="5">Nalavariam</td></tr>
      <tr><td colspan="5">&nbsp;</td></tr>
      <tr><td style="text-align: right">Bill# {{ $billnum }}</td><td></td><td>{{ $cust_name }}</td><td>{{ $mobile }}</td><td style="text-align: right">{{ $bill_date }}</td></tr>
      <tr><td colspan="5">&nbsp;</td></tr>
      <tr>
         <th style="text-align: left">#</th>
         <th style="text-align: left">Item</th>
         <th style="text-align: right">Rate</th>
         <th style="text-align: right">Qty</th>
         <th style="text-align: right">Amount</th>
      </tr>
   </thead>
   <tbody>
      @foreach($bill as $key=>$b)
      <tr>
         <td style="text-align: left">{{ $key + 1 }}</td>
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


