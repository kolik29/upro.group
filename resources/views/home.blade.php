@extends('layouts.app')

@section('content')
<div class="container">
	@auth
	<div class="row">
		<div class="col-10">
			<div class="custom-file">
				<input type="file" class="custom-file-input" id="file">
				<label class="custom-file-label" for="file">Выберите файл</label>
			</div>
		</div>
		<div class="col-2">
			<button class="btn btn-primary w-100" id="upload">Загрузить</button>
		</div>
	</div>
	@endauth
	<div class="row">
		<div class="col-12 mt-3">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Марка</th>
						<th scope="col">Модель</th>
						<th scope="col">Год</th>
					</tr>
				</thead>
				<tbody id="automobiles">
					@foreach ($automobilesList as $item)
					<tr>
						<td>
							{{ $item['Brand'] }}
						</td>
						<td>
							{{ $item['Model'] }}
						</td>
						<td>
							{{ $item['Year'] }}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection