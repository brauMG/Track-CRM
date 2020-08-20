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
    El contacto {{ $contact->first_name . " " . $contact->last_name }} ha sido actualizado a {{ $contact->getStatus->name }} puedes verificarlo aquí <a href="{{ url('admin/contacts/' . $contact->id) }}"> {{ url('admin/contacts/' . $contact->id) }} </a>
</p>
</body>
</html>
