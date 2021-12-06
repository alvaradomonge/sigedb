@extends ('plantilla')

@section('titulo','Años Lectivos')

@section ('contenido')
	<div class="container">
		<div class="bg-white p-4 shadow rounded">
			<h2 class="display-8">Año Lectivo</h2>
			{{-- @include('partials.session-status') --}}
			<p class="text-black">Nombre: {{$anio_lectivo->nombre}}</p>
			<p class="text-black">Periodos vinculados</p>
			<div class="dropdown">
				<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
			    	Seleccione...
			  	</a>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					@forelse ($query as $query_Item)
						<li>
							<a class="dropdown-item" href="{{route('periodo.show',$query_Item)}}">
								<span class="font-weight-bold">
									{{$query_Item->nombre}}/
									Valor: {{$query_Item->valor_porcentual}}%/
									Final: @if($query_Item->es_final==1) Si @else No @endif /
									Estado: @if($query_Item->activo==1) Activo @else Inactivo @endif
								</span>
							</a>
						</li>
					@empty
						<li>
							No hay periodos activos
						</li>
					@endforelse
					{{-- {{$query->links()}} --}}
				</ul>
			</div>
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