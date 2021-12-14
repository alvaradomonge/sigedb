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
			<h2 class="display-8 mb-0">Todas las Materias</h2>
			@auth 
				<a class="btn btn-primary" href="{{route('materia.create')}}">Agregar materia</a> 
			@endauth
		</div>
		<hr>
		<p class="lead text-secondary"> Listado de materia</p>
		{{-- @include('partials.session-status') --}}

		<table class="table table-striped table-sm ">
			<thead>
				<tr>
					<th scope="col">Nombre</th>
					<th scope="col">Sección</th>
					<th scope="col">Estado</th>
					<th scope="col">Detalles</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($materia as $materia_Item)
					<tr>
						<th scope="row" class="font-weight-bold">
							{{$materia_Item->nombre}}
						</th>
						<td>
							{{$materia_Item->grupo_guia->nombre}}
						</td>
						<td>
							{{$materia_Item->estados->nombre}}
						</td>
						<td>
							<a class="btn btn-sm btn-outline-info" tooltip="Buscar" href="{{route('materia.show',$materia_Item)}}"><i class="fas fa-search"></i></a>
						</td>
					</tr>
				@empty
					<tr>
						<td class="list-group-item border-0 mb-2 shadow-sm" >
							No hay materias
						</td>
					</tr>
				@endforelse
			</tbody>
		</table>
{{-- 











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
		</ul> --}}
	</div>
@endsection