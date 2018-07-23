<html>
<head>
    <title>Meeting Request</title>
</head>
<body>
    <h2>Meeting Request</h2>
    <br/>
    <p>Organizer: {{ $input['organizer'] }}</p>
    <p>Subject: {{ $input['title'] }}</p>
    <p>Start Time: {{ date('F d, Y H:i', strtotime($input['start_at'])) }}</p>
    <p>End Time: {{ date('F d, Y H:i', strtotime($input['end_at'])) }}</p>
    <p>
        <a href="{{ url('user/meeting/confirm/' . $input['invite_id'] . '/1' )}}" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;border-radius:3px;color:#fff;display:inline-block;text-decoration:none;background-color:#3097d1;border-top:10px solid #3097d1;border-right:18px solid #3097d1;border-bottom:10px solid #3097d1;border-left:18px solid #3097d1">Accept Meeting</a>
        <a href="{{ url('user/meeting/confirm/' . $input['invite_id'] . '/0' )}}" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;border-radius:3px;color:#fff;display:inline-block;text-decoration:none;background-color:#3097d1;border-top:10px solid #3097d1;border-right:18px solid #3097d1;border-bottom:10px solid #3097d1;border-left:18px solid #3097d1">Decline Meeting</a>
    </p>
</body>
</html>