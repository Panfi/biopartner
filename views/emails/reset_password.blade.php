<html>
<head>
    <title>Reset your password</title>
</head>

<body>
<h3> Password change notification</h3>
<br/>
<p>You are receiving this email because we received a password reset request for your account.</p>
<a href="{{ url('password/reset', $input['token'] )}}" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;border-radius:3px;color:#fff;display:inline-block;text-decoration:none;background-color:#3097d1;border-top:10px solid #3097d1;border-right:18px solid #3097d1;border-bottom:10px solid #3097d1;border-left:18px solid #3097d1">Reset Password</a>
<br/><br/>
<strong>If you did not request a password reset, no further action is required.</strong> <br>
</body>
</html>
