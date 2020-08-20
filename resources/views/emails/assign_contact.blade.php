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
    Se te ha asignado un contacto, puedes verificarlo aquí: <a href="{{ url('admin/contacts/' . $contact->id) }}"> {{ url('admin/contacts/' . $contact->id) }} </a>
</p>
</body>
</html>
