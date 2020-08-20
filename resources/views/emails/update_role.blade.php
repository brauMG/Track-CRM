<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $subject }}</title>
</head>
<body>
<p>
    Hola {{ $user->name }},
</p>

<p>
    Has sido asignador a un rol de usuario "{{ $user->roles[0]->name }}"
</p>
</body>
</html>
