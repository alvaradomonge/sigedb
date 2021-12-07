@extends ('plantilla')

@section('titulo','Datos de la grupo guia')

@section ('contenido')
	<div class="container">
		<div class="bg-white p-4 shadow rounded">
			<h2 class="display-8">Datos del grupo guía</h2>
			<p class="text-black">Nombre: {{$grupo_guia->nombre}}</p>
			<p class="text-black">Periodo: {{$grupo_guia->periodo->anio_lectivo->nombre}}--{{$grupo_guia->periodo->nombre}}</p>
			
			<div class="d-flex justify-content-between align-items-center">
				<a  class="btn btn-primary" href="{{route('grupo_guia.index')}}">Regresar</a>
				@auth 
					<div class="btn-group btn-group-sm">
						<a class="btn btn-primary" href="{{route('grupo_guia.edit',$grupo_guia)}}">Editar</a> 
						<a class="btn btn-danger" href="#" onclick="document.getElementById('delete-grupo_guia').submit()">Eliminar</a>
					</div>
					<form id="delete-grupo_guia" class="d-none" method="POST" action="{{route('grupo_guia.destroy',$grupo_guia)}}">
						@csrf @method('DELETE')
					</form>
					
				@endauth
			</div>
		</div>
@endsection