<!DOCTYPE html>
<html>
<head>
    <title>Перечень плановых проверок</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	<script type="text/javascript">
		$(document).ready(function () {
			// Setup - add a text input to each footer cell
			$('#checksplans thead tr')
				.clone(true)
				.addClass('filters')
				.appendTo('#checksplans thead');
		 
			var table = $('#checksplans').DataTable({
				orderCellsTop: true,
				fixedHeader: true,
				initComplete: function () {
					var api = this.api();
		 
					// For each column
					api
						.columns()
						.eq(0)
						.each(function (colIdx) {
							// Set the header cell to contain the input element
							var cell = $('.filters th').eq(
								$(api.column(colIdx).header()).index()
							);
							var title = $(cell).text();
							$(cell).html('<input type="text" placeholder="' + title + '" />');
		 
							// On every keypress in this input
							$(
								'input',
								$('.filters th').eq($(api.column(colIdx).header()).index())
							)
								.off('keyup change')
								.on('keyup change', function (e) {
									e.stopPropagation();
		 
									// Get the search value
									$(this).attr('title', $(this).val());
									var regexr = '({search})'; //$(this).parents('th').find('select').val();
		 
									var cursorPosition = this.selectionStart;
									// Search the column for that value
									api
										.column(colIdx)
										.search(
											this.value != ''
												? regexr.replace('{search}', '(((' + this.value + ')))')
												: '',
											this.value != '',
											this.value == ''
										)
										.draw();
		 
									$(this)
										.focus()[0]
										.setSelectionRange(cursorPosition, cursorPosition);
								});
						});
				},
				infoCallback: function ( settings, start, end, max, total, pre ) {
					let elements = '';
					$( ".elements" ).each(function( index ) {
						elements = $( this ).data('checkid') + '-' + elements;
					});
					
					//$.cookie('elements_list', elements, { expires: 7, path: '/' });
					$.post('/checksplans/export', {_token: $('input[name="_token"]').val(), elements: elements}, function(data) {
					});
				}	
			});
			
		});
	</script>
	
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('checksplans') }}">Перечень плановых проверок</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('checksplans') }}">Список</a></li>
        <li><a href="{{ URL::to('checksplans/create') }}">Добавить</a>
    </ul>
</nav>

<h1>Перечень плановых проверок</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<hr>

<h2>Поиск</h2>

<div>Наименование СМП</div>
<div>Контролирующий орган</div>
<div>Период проверки с</div>
<div>Период проверки по</div>

<a href="#">Найти</a>
<a href="#" id="export-btn">Excel</a>

<hr>

<form id="checksplans_form" action="/checksplans/export/" method="post">

{{ csrf_field() }}

<button href="/checksplans/export/" class="btn btn-primary">ЭКСПОРТ ДАННЫХ</button>

<table id="checksplans" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>№</th>
            <th>Проверяемый СМП</th>
			<th>Контролирующий орган</th>
            <th>Плановый период проверки</th>
			<th>Плановая длительность</th>
			<td></td>
        </tr>
    </thead>
    <tbody>
    @foreach($checksplans as $key => $value)
        <tr>
            <td class="elements" data-checkid="{{ $value->id }}">
				{{ $value->id }}
				<input name="elements[]" value="{{ $value->id }}" style="display:none"/>
			</td>
            <td>{{ $value->objectslist->name }}</td>
            <td>{{ $value->controlist->name }}</td>
			<td>{{ $value->checks_from }} - {{ $value->checks_to }}</td>
			<td>{{ $value->plan }}</td>

            <td>
                {{ Form::open(array('url' => 'checksplans/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Удалить', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}

                <a class="btn btn-small btn-success" href="{{ URL::to('checksplans/' . $value->id) }}">Открыть</a>
                <a class="btn btn-small btn-info" href="{{ URL::to('checksplans/' . $value->id . '/edit') }}">Редактировать</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</form>

</div>
</body>
</html>