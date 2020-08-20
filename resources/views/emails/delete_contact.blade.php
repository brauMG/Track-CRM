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
    El contacto {{ $contact->first_name . " " . $contact->last_name }} ha sido eliminado.
</p>
</body>
</html>
