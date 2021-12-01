@extends ('plantilla')

@section('titulo','Datos de estudiante')

@section ('contenido')
	<div class="container">
		<div class="bg-white p-4 shadow rounded">
			<h2 class="display-8">Datos del estudiante</h2>
			{{-- @include('partials.session-status') --}}
			<p class="text-black">Nombre: {{$estudiante->nombre}}</p>
			<p class="text-black">Apellidos: {{$estudiante->apellido1}} {{$estudiante->apellido2}}</p>
			<p class="text-black">Email: {{$estudiante->email}}</p>
			<p class="text-black">Última modificación: {{$estudiante->created_at->diffForHumans()}}</p>
			<div class="d-flex justify-content-between align-items-center">
				<a href="{{route('estudiante.index')}}">Regresar</a>
				@auth 
					<div class="btn-group btn-group-sm">
						<a class="btn btn-primary" href="{{route('estudiante.edit',$estudiante)}}">Editar</a> 
						<a class="btn btn-danger" href="#" onclick="document.getElementById('delete-estudiante').submit()">Eliminar</a>
					</div>
					<form id="delete-estudiante" class="d-none" method="POST" action="{{route('estudiante.destroy',$estudiante)}}">
						@csrf @method('DELETE')
					</form>
					
				@endauth
			</div>
		</div>
@endsection