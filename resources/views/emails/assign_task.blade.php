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
    Se te ha asignado una tarea, puedes verificarla aquí: <a href="{{ url('admin/tasks/' . $task->id) }}"> {{ url('admin/tasks/' . $task->id) }} </a>
</p>
</body>
</html>
