<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $subject }}</title>
</head>
<body>
<p>
    Hello {{ $user->name }},
</p>

@if($user->is_active == 1)
    <p>
        Tu cuenta ha sido activada para acceder al sistema Track <a href="{{ url('admin') }}"> {{ url('admin') }} </a>
    </p>
@else
    <p>
        Tu cuenta ha sido desactivada del sistema Cloud <a href="{{ url('admin') }}"> {{ url('admin') }} </a>
    </p>
@endif
</body>
</html>
