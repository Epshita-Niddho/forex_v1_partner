


<h3>New profile verification request arrived</h3>

<table>
	<tr>
		<th>Name: </th>
		<td>{{$name}}</td>
	</tr>
	
	
	<tr>
		<th>Email: </th>
		<td>{{$email}}</td>
	</tr>
	
	<tr>
		<th>Address Proof: </th>
		<td>@if($addressImageName)
		<a href="{{$url}}/documents/{{$addressImageName}}">Document Link</a>
		@endif</td>
	</tr>

	

</table>



