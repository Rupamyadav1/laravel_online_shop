<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Hello {{$user->name}}</p>
    <h1>you have requested to change password</h1>
    <p >please click the link below to change password</p>
    <a href="{{ route('front.restPassword',$token) }}">click here</a>
    <p>Thanks</p>

</body>
</html>