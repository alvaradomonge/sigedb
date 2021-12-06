@extends ('plantilla')

@section('titulo','Grupo guía-SIGEDB')

@section ('contenido')
	<style>
		.li_element{
			text-decoration: none
		}
	</style>
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h2 class="display-8 mb-0">Grupo guía </h2>
			@auth 
				<a class="btn btn-primary" href="{{route('grupo_guia.create')}}">Agregar Grupo guía</a> 
			@endauth
		</div>
		<hr>
		<p class="lead text-secondary"> Listado de Grupo guía</p>
		{{-- @include('partials.session-status') --}}
		<ul class="list-group">
			@forelse ($grupo_guia as $grupo_guiaItem)
				<li class="list-group-item border-0 mb-2 shadow-sm">
					<a class="li_element text-secondary d-flex justify-content-between align-items-center" href="{{route('grupo_guia.show',$grupo_guiaItem)}}">
						<span class="font-weight-bold">
							{{$grupo_guiaItem->nombre}} 
							
						</span>
					</a>
				</li>
			@empty
				<li class="list-group-item border-0 mb-2 shadow-sm">
					No hay Grupo guía actualmente
				</li>
			@endforelse
			{{$grupo_guia->links()}}
		</ul>
	</div>
@endsection