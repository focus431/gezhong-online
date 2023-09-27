<!DOCTYPE html>
<html>
<head>
    <title>Account Activation</title>
</head>
<body>

<h1>Activate Your Account</h1>
<p>Click the link below to activate your account:</p>
<a href="{{ url('activate/' . $activationCode) }}">Activate Account</a>

</body>
</html>
