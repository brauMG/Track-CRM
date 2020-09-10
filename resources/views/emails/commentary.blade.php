<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $subject }}</title>
</head>
<body>
<p>
    Hola {{ $username }}.
</p>

<p>
    <a>El contacto con el nombre: {{$my_name}} y el correo, <strong style="color: #0b3e6f">{{$my_email}}</strong>, ha realizado el siguiente comentario acerca de la promoción del catálogo {{$catalogue}}:</a>
    <br>
    <a><strong><i>{{$commentary}}</i></strong></a>
    <br>
    <a>Asegúrate de contactarlo.</a>
</p>
</body>
</html>
