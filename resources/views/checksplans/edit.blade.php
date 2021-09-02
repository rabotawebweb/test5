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
        <a class="navbar-brand" href="{{ URL::to('checksplans') }}">photo Alert</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('checksplans') }}">View All photos</a></li>
        <li><a href="{{ URL::to('checksplans/create') }}">Create a photo</a>
    </ul>
</nav>

<h1>Edit</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($checksplan, array('route' => array('checksplans.update', $checksplan->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('object_id', 'object_id') }}
        {{ Form::text('object_id', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('control_id', 'control_id') }}
        {{ Form::text('control_id', null, array('class' => 'form-control')) }}
    </div>


    {{ Form::submit('Edit the photo!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>