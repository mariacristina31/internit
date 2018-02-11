<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>InternIT</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
<body style="background: url(images/bg.jpg); margin: 0; padding: 0; background-size: cover; font-family: sans-serif;">
    <div class="login-box">
    <img src="{{ asset('images/icon2.png') }}" class="avatar">
        <h1>Login</h1>
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <p>Username</p>
            <input type="text" name="username" placeholder="Enter Username">
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password">
            <input type="submit" name="submit" value="Login">
        </form>
</div>


</body>

</head>

</html>
