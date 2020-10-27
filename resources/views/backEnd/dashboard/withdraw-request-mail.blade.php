

@if($payment_type=='Transfer to Trading Account')
<h3>New Internal Transfer From Partner</h3>
@else
<h3>New withdraw request arrived</h3>
@endif
<table>
	<tr>
		<th>Name: </th>
		<td>{{$name}}</td>
	</tr>
	<tr>
		<th>Refernce no: </th>
		<td>{{$reference}}</td>
	</tr>
	
	<tr>
		<th>Email: </th>
		<td>{{$email}}</td>
	</tr>
	<tr>
		<th>Verification Code: </th>
		<td>{{$verification_code}}</td>
	</tr>
	<tr>
	<tr>
		<th>Amount: </th>
		<td>$ {{$amount}}</td>
	</tr>
	<tr>
		<th>Transaction method: </th>
		<td>{{$payment_type}}</td>
	</tr>
	@if($payment_type=='Neteller' )
	<tr>
		<th>Account no: </th>
		<td>{{$account}}</td>
	</tr>
	@endif
	@if($payment_type=='Neteller' || $payment_type=='Skrill')
	<tr>
		<th>Transaction Email: </th>
		<td>{{$payment_email}}</td>
	</tr>
	@endif
	@if($payment_type=='Bank Wire Transfer')
	<tr>
		<th>Bank Name: </th>
		<td>{{$bank_name}}</td>
	</tr>
	<tr>
		<th>Bank Country Name: </th>
		<td>{{$bank_country}}</td>
	</tr>
	<tr>
		<th>Bank Account Name: </th>
		<td>{{$bank_acc_name}}</td>
	</tr>
	<tr>
		<th>IBAN Number: </th>
		<td>{{$iban_num}}</td>
	</tr>
	<tr>
		<th>Bank Swift Code: </th>
		<td>{{$swift_num}}</td>
	</tr>
	<tr>
		<th>Bank Address: </th>
		<td>{{$bank_address}}</td>
	</tr>
	<tr>
		<th>Correspondent Bank Name: </th>
		<td>{{$correspondent_bank}}</td>
	</tr>
	@endif
	@if($payment_type=='Transfer to Trading Account')
		<tr>
		<th>Trading Account: </th>
		<td>{{$trading_account}}</td>
	</tr>
	
	@endif
</table>



