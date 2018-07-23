<html>
<head>
    <title>User Verificaion</title>
</head>
<body>
    <h2>User Verificaion</h2>
    <br/>
    To complete the registration please verify your email by clicking <a href="{{ url('user/verify', $input->verifyUser->token )}}" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;border-radius:3px;color:#fff;display:inline-block;text-decoration:none;background-color:#3097d1;border-top:10px solid #3097d1;border-right:18px solid #3097d1;border-bottom:10px solid #3097d1;border-left:18px solid #3097d1">here</a>
</body>
</html>