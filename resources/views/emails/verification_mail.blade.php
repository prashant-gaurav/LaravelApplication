<!DOCTYPE html>
<html>
<head>
    <title>Activation Email</title>
</head>
<body>
<h2>Hi, {{$user['first_name']}} {{$user['last_name']}} </h2>
<br/>
Your Account hase been created<br>
Name      :{{$user['first_name']}} {{$user['last_name']}}<br>
Email-id  :{{$user['email']}}<br>
Mobile-no :{{$user['phone']}}<br>
Please click on the below link to verify your account.
<br/>
<br/>
<center class="btn-read-online" style="text-align: center; background-color: #4DB24C; padding: 10px 15px; border-radius: 5px; width: 200px!important;"><a href="{{url('user/verify', $user->verifyUser->token)}}" style="color: #fff; font-size: 18px; letter-spacing: 1px; text-decoration: none; text-shadow: 0px 2px 2px #4db24c;">Verify Account</a></center>

<br/><br/>
Regard's<br/>
Prashant Gaurav
</body>
</html>
