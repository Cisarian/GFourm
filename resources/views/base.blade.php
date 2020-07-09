<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>
    @auth
    Current user: {{ Auth::user()-> name}}
    @else
    <a href={{ route('login') }} > Login </a>
    @endauth
    </p>
    

    @yield ('content')
</body>
</html>