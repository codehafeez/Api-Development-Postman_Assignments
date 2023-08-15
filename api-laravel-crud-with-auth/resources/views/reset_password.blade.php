<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Reset Password</title>
    </head>
    <body>
        <h1>Reset Password</h1>
        <p>Hello {{ $user->name }},</p>
        <p>Please click the following link to reset your password:</p>
        <a href="{{ url('/reset-password/'.$token) }}">Reset Password</a>
    </body>
</html>