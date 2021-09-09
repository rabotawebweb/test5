<!DOCTYPE html>
<html>
<head>
    <title>Редактирование проверки</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
	<script>
		$(document).ready(function() {
			$('.js-select2').select2();
		});
	</script>
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('checksplans') }}">проверки</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('checksplans') }}">Все проверки</a></li>
        <li><a href="{{ URL::to('checksplans/create') }}">Добавить проверку</a>
    </ul>
</nav>

<h1>Редактирование проверки</h1>

{{ HTML::ul($errors->all()) }}

{{ Form::model($checksplan, array('route' => array('checksplans.update', $checksplan->id), 'method' => 'PUT')) }}
	
	<div class="form-group">
        {{ Form::label('object_id', 'Выберите СМП') }}
        {{ Form::select('object_id', $object_list, null, ['id' => 'object_id', 'class' => 'form-control js-select2', 'dropdown-menu']) }}
    </div>
	
    <div class="form-group">
        {{ Form::label('control_id', 'Контролирующий орган') }}
        {{ Form::select('control_id', $control_list, null, ['id' => 'control_id', 'class' => 'form-control js-select2', 'dropdown-menu']) }}
    </div>
	
	<div class="form-group">
        {{ Form::label('checks_from', 'Период проверки с') }}
        {{ Form::date('checks_from', Input::old('checks_from'), array('class' => 'form-control')) }}
    </div>
	
	<div class="form-group">
        {{ Form::label('checks_to', 'Период проверки по') }}
        {{ Form::date('checks_to', Input::old('checks_to'), array('class' => 'form-control')) }}
    </div>
	
	<div class="form-group">
        {{ Form::label('plan', 'Плановая длительность проверки') }}
        {{ Form::text('plan', Input::old('plan'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Сохранить', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>