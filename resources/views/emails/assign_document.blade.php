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
    Te han asignado un documento, puedes mirarlos aquí <a href="{{ url('admin/documents/' . $document->id) }}"> {{ url('admin/documents/' . $document->id) }} </a>
</p>
</body>
</html>
