<!-- custom password reset link -->

Dear {{ $admin->first_name }} {{ $admin->last_name }};

<br>Please Click the following link to reset your Password:<br>

<a href="{{ $link = url('/admin/password/reset', $admin->token).'?email='.urlencode($admin->email) }}">

	Click me for Resetting Password

</a>
<br>
<strong>This link will expire soon</strong>
