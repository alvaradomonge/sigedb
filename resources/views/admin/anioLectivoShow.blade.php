@extends ('plantilla')

@section('titulo','Años Lectivos')

@section ('contenido')
	<div class="container">
		<div class="bg-white p-4 shadow rounded">
			<h2 class="display-8">Año Lectivo {{$anio_lectivo->nombre}}</h2>
			{{-- @include('partials.session-status') --}}
			<p class="text-black"><h4>Periodos vinculados</h4></p>
			<table class="table table-striped table-sm ">
				<thead>
					<tr>
						<th scope="col">Nombre</th>
						<th scope="col">Valor %</th>
						<th scope="col">¿Es final?</th>
						<th scope="col">Estado</th>
						<th scope="col">Herramientas</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($query as $query_Item)
						<tr>
							<th scope="row" class="font-weight-bold">
								{{$query_Item->nombre}}
							</th>
							<td>
								{{$query_Item->valor_porcentual}}%
							</td>
							<td>
								@if($query_Item->es_final==1) Si @else No @endif
							</td>
							<td>
								@if($query_Item->activo==1) Activo @else Inactivo @endif
							</td>
							<td>
								@auth 
									<a class="btn btn-sm btn-outline-info" href="{{route('periodo.show',$query_Item)}}"><i class="fas fa-search"></i></a>
								@endauth
							</td>
						</tr>
					@empty
						<tr>
							<td class="list-group-item border-0 mb-2 shadow-sm" >
								No hay estudiantes asignados 
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
			<br>
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