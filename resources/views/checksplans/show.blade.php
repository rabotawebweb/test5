<!DOCTYPE html>
<html>
<head>
    <title>Look! I'm CRUDding</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('checksplans') }}">checksplans Alert</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('checksplans') }}">View All checksplans</a></li>
        <li><a href="{{ URL::to('checksplans/create') }}">Create a checksplans</a>
    </ul>
</nav>

<h1>Showing</h1>

    <div class="jumbotron text-center">
        <h2>{{ $checksplan->id }}</h2>
        <p>
            <strong>author:</strong> {{ $checksplan->object_id }}<br>
            <strong>body:</strong> {{ $checksplan->control_id }}
        </p>
    </div>

</div>
</body>
</html>