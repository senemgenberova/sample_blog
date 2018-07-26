<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Account verification</title>
</head>
<body>
	<h1>Dear {{$user->name}}, please click for verification</h1>

	<a href="{{route('verify_user', $user->verificiation->token)}}">Verify Account</a>

</body>
</html>