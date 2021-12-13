@extends ('plantilla')

@section('titulo','Gestion de Años y Perdiodos lectivos')

@section ('contenido')
	<div class="container">
		<div class="">
			<h2 class="display-8 mb-0">Años Lectivos</h2>
				<div class="dropdown">
					<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
				    	Seleccione el año lectivo
				  	</a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
						@forelse ($anio_lectivo as $anio_lectivo_Item)
							<li>
								<a class="dropdown-item" href="{{route('anio_lectivo.show',$anio_lectivo_Item)}}">
									<span class="font-weight-bold">
										{{$anio_lectivo_Item->nombre}} 
									</span>
								</a>
							</li>
						@empty
							<li>
								Cree primero un año lectivo
							</li>
						@endforelse
						{{$anio_lectivo->links()}}
					</ul>
				</div>
			<h2 class="display-8 mb-0">Periodos activos</h2>
				{{-- <div class="dropdown">
					<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
				    	Seleccione...
				  	</a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
						@forelse ($query as $query_Item)
							<li>
								<a class="dropdown-item" href="{{route('periodo.show',$query_Item)}}">
									<span class="font-weight-bold">
										{{$query_Item->anio_lectivo->nombre}}-{{$query_Item->nombre}} 
									</span>
								</a>
							</li>
						@empty
							<li>
								No hay periodos activos
							</li>
						@endforelse
						{{$anio_lectivo->links()}}
					</ul>
				</div> --}}
				<table class="table table-striped table-sm ">
					<thead>
						<tr>
							<th scope="col">Año</th>
							<th scope="col">Nombre</th>
							<th scope="col">Cantidad de Grupos</th>
							<th scope="col">Herramientas</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($query as $query_Item)
							<tr>
								<th scope="row" class="font-weight-bold">
									{{$query_Item->anio_lectivo->nombre}}
								</th>
								<td>
									{{$query_Item->nombre}}
								</td>
								<td>
									{{$query_Item->grupos_guias()->count('*')}}
								</td>
								<td>
									<a class="btn btn-sm btn-outline-info" tooltip="Buscar" href="{{route('periodo.show',$query_Item)}}"><i class="fas fa-search"></i></a>
								</td>
							</tr>
						@empty
							<tr>
								<td class="list-group-item border-0 mb-2 shadow-sm" >
									No hay periodos activos 
								</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			<h2 class="display-8 mb-0">Herramientas</h2>
				<a class="btn btn-primary" href="{{route('anio_lectivo.create')}}">Crear año lectivo</a>
				<a class="btn btn-secondary" href="{{route('periodo.create',$anio_lectivo)}}">Crear Periodo</a>
				{{-- <a class="btn btn-danger" href="#">Modificar años y periodos</a> --}}
		</div>
	</div>
@endsection