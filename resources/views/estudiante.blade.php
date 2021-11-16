@extends ('plantilla')

@section('titulo','Estudiantes-SIGEDB')

@section ('contenido')
	<style>
		.li_element{
			text-decoration: none
		}
	</style>
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h2 class="display-8 mb-0">Estudiantes de la institución </h2>
			@auth 
				<a class="btn btn-primary" href="{{route('estudiante.create')}}">Agregar estudiante</a> 
			@endauth
		</div>
		<hr>
		<p class="lead text-secondary"> Listado de estudiantes</p>
		{{-- @include('partials.session-status') --}}
		<ul class="list-group">
			@forelse ($estudiante as $estudianteItem)
				<li class="list-group-item border-0 mb-2 shadow-sm">
					<a class="li_element text-secondary d-flex justify-content-between align-items-center" href="{{route('estudiante.show',$estudianteItem)}}">
						<span class="font-weight-bold">
							{{$estudianteItem->nombre}} 
							{{$estudianteItem->apellido1}} 
						</span>
						<span class="text-black-50">
							{{$estudianteItem->created_at->format('d/m/Y')}}
						</span>
					</a>
				</li>
			@empty
				<li class="list-group-item border-0 mb-2 shadow-sm">
					No hay estudiantes actualmente en la clase
				</li>
			@endforelse
			{{$estudiante->links()}}
		</ul>
	</div>
@endsection