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

<h1>All the checksplans <a href="{{ URL::to('checksplans/export') }}">export</a></h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
        </tr>
    </thead>
    <tbody>
    @foreach($checksplans as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->object_id }}</td>
            <td>{{ $value->control_id }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'checksplans/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this Nerd', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}

                <!-- show the nerd (uses the show method found at GET /photos/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('checksplans/' . $value->id) }}">Show this Nerd</a>

                <!-- edit this nerd (uses the edit method found at GET /photos/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('checksplans/' . $value->id . '/edit') }}">Edit this Nerd</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
</body>
</html>