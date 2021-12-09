@extends ('plantilla')

@section('titulo','Datos de la materia')
@section('css')
	<link rel="stylesheet" href="{{asset('vendor/jquery-ui/jquery-ui.min.css')}}">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section ('contenido')
	<div class="container">
		<div class="bg-white p-4 shadow rounded">
			<h2 class="display-8">Estudiantes de {{$grupo_guia->nombre}}</h2>
			<ul class="list-group">
				@forelse ($grupo_guia->estudiantes as $estudiante_Item)
					<li class="list-group-item border-0 mb-2 shadow-sm" value="{{$estudiante_Item->id}}">
						<a class="li_element text-secondary d-flex justify-content-between text-decoration-none" href="#">
							<span class="font-weight-bold">
								{{$estudiante_Item->name}} {{$estudiante_Item->apellido1}} {{$estudiante_Item->apellido2}} ({{$estudiante_Item->email}})
							</span>
							
							<span>
								<a class="btn btn-sm btn-outline-danger" href="#">borrar</a>
							</span>
						</a>
					</li>
				@empty
					<li class="list-group-item border-0 mb-2 shadow-sm" >
						No hay estudiantes asignados en este grupo
					</li>
				@endforelse
			</ul>
			<div class="collapse" id="collapse">
				<form class="bg-white py-4 px-5 shadow rounded" method="GET" action="{{route('admin.storeGrupoGuiaEstudiante',$grupo_guia)}}">
					@csrf
					<div class="input-group">
						<input type="text" name="id_user" id="id_user" class="form-control">
						<div class="input-group-append">
							<button class="btn btn-danger">Agregar</button>
						</div>
					</div>
				</form>
			</div>
			<br>
			<div class="d-flex align-items-center">
				<a class="btn btn-success" href="{{route('periodo.show',$grupo_guia->periodo)}}">Regresar</a>
				<a class="btn btn-info" href="#">Crear estudiante</a>
				<a class="btn btn-dark" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse" href="#collapse">Vincular estudiante</a>
			</div>
		</div>
	</div>
@endsection
@section('js')
	<script src="{{asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
	<script>

		$('#user').autocomplete($('#id_user').autocomplete({
			source: function(request,response){
				$.ajax({
					url:"{{route('search.estudiantes')}}",
					dataType: 'json',
					data:{
						term: request.term
					},
					success: function(data){
						response(data)
					}
				});
			}
		})
		);
	</script>
@endsection