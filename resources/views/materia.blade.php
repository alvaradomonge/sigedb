@extends ('plantilla')

@section('titulo','Materia-SIGEDB')

@section ('contenido')
	<style>
		.li_element{
			text-decoration: none
		}
	</style>
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h2 class="display-8 mb-0">Materia </h2>
			@auth 
				<a class="btn btn-primary" href="{{route('materia.create')}}">Agregar materia</a> 
			@endauth
		</div>
		<hr>
		<p class="lead text-secondary"> Listado de materia</p>
		{{-- @include('partials.session-status') --}}
		<ul class="list-group">
			@forelse ($materia as $materiaItem)
				<li class="list-group-item border-0 mb-2 shadow-sm">
					<a class="li_element text-secondary d-flex justify-content-between align-items-center" href="{{route('materia.show',$materiaItem)}}">
						<span class="font-weight-bold">
							{{$materiaItem->nombre}} 
							
						</span>
					</a>
				</li>
			@empty
				<li class="list-group-item border-0 mb-2 shadow-sm">
					No hay materia actualmente
				</li>
			@endforelse
			{{$materia->links()}}
		</ul>
	</div>
@endsection