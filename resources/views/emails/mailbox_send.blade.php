<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $mailbox->subject }}</title>
</head>
<body>
<p>
    Hola {{ $user->name }},
</p>

<p>
    {!! $mailbox->body !!}
</p>
</body>
</html>
