@extends ('plantilla')

@section('titulo','Años Lectivos')

@section ('contenido')
	<div class="container">
		<div class="bg-white p-4 shadow rounded">
			<h2 class="display-8">Año Lectivo</h2>
			{{-- @include('partials.session-status') --}}
			<p class="text-black">Nombre: {{$anio_lectivo->nombre}}</p>
			<div class="d-flex justify-content-between align-items-center">
				<a class="btn btn-primary" href="{{route('anio_lectivo.index')}}">Regresar</a>
				@auth 
					<div class="btn-group btn-group-sm">
						<a class="btn btn-primary" href="{{route('anio_lectivo.edit',$anio_lectivo)}}">Editar</a> 
						<a class="btn btn-danger" href="#" onclick="document.getElementById('delete-anio').submit()">Eliminar</a>
					</div>
					<form id="delete-anio" class="d-none" method="POST" action="{{route('anio_lectivo.destroy',$anio_lectivo->id)}}">
						@csrf @method('DELETE')
					</form>
					
				@endauth
			</div>
	</div>
@endsection