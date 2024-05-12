<!DOCTYPE html>
<html>
<head>
    <title>Lista de Rotas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #343a40;
            color: #fff;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 10px;
            background-color: #212529;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #17a2b8;
        }
        .list-group-item {
            background-color: #212529;
            border: none;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
            padding: 20px;
        }
        .list-group-item strong {
            color: #ffc107;
        }
        .list-group-item em {
            color: #6c757d;
        }
        .list-group-item span {
            color: #adb5bd;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Lista de Rotas</h1>

    <ul class="list-group">
        @foreach ($routes as $route)
            <li class="list-group-item">
                <strong>{{ $route->getName() }}</strong>
                <em>{{ $route->uri() }}</em>
                <span>{{ $route->getActionName() }}</span>
            </li>
        @endforeach
    </ul>
</div>
</body>
</html>
