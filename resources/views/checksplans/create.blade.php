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
        <a class="navbar-brand" href="{{ URL::to('checksplans') }}">Nerd Alert</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('checksplans') }}">View All photos</a></li>
        <li><a href="{{ URL::to('checksplans/create') }}">Create a Nerd</a>
    </ul>
</nav>

<h1>Create a Nerd</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'checksplans')) }}

    <div class="form-group">
        {{ Form::label('object_id', 'object_id') }}
        {{ Form::text('object_id', Input::old('object_id'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('control_id', 'control_id') }}
        {{ Form::text('control_id', Input::old('control_id'), array('class' => 'form-control')) }}
    </div>
	
	<div class="form-group">
        {{ Form::label('checks_from', 'checks_from') }}
        {{ Form::text('checks_from', Input::old('checks_from'), array('class' => 'form-control')) }}
    </div>
	
	<div class="form-group">
        {{ Form::label('checks_to', 'checks_to') }}
        {{ Form::text('checks_to', Input::old('checks_to'), array('class' => 'form-control')) }}
    </div>


    {{ Form::submit('Create the Nerd!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>