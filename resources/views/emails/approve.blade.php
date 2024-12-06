<!DOCTYPE html>
<html>
<head>
    <title>AABU Talk Registration Request</title>
</head>

<body>
    <h1>Hello, {{ $data['name'] }}</h1>
    <p>Welcome to AABU Talk! Your request has been approved</p>
    <p>You may now <a href="{{ url('en/login/non-student') }}">Login</a> to the application.</p>
    <p>After that you must verify your email.</p>
    <p>AABU Talk</p>
</body>

</html>
