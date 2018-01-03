<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<p>Dear {{$user->firstname}},</p>
		<h1>Account Confirmation</h1>
		<div>
			<h2>Please access the link below to confirm your account</h2>
			<a href="{{url('/').'/user/confirm/'.$user->confirmation_code}}">{{url('/').'/user/confirm/'.$user->confirmation_code}}</a>
		</div>
	</body>
</html>

