


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
		<th>ID Proof(front): </th>
		<td>
		@if($id_front)
		<a href="{{$url}}/documents/{{$id_front}}">Document Link</a>

		@endif
		</td>
	</tr>
	<tr>
		<th>ID Proof(back): </th>
		<td>
		@if($id_back)
		<a href="{{$url}}/documents/{{$id_back}}">Document Link</a>

		@endif
		</td>
	</tr>
	

	

</table>



