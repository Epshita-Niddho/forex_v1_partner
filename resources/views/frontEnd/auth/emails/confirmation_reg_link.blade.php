<!-- custom confirmation link -->


Dear {{ $first_name." ".$last_name }};

<br>Please Click the following link to Confirm your Registration:<br>

<a href="{{ $link = url('/member/confirm-registration', $token).'?email='.urlencode($email) }}">

	Click me for Confirmation

</a>
<br>
<strong>This link will expire after one hour</strong>
