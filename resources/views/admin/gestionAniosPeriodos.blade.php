@extends ('plantilla')

@section('titulo','Gestion de Años y Perdiodos lectivos')

@section ('contenido')
	<div class="container">
		<div class="">
			<h2 class="display-8 mb-0">Años Lectivos</h2>
				<ul class="list-group">
					@forelse ($anio_lectivo as $anio_lectivo_Item)
						<li class="list-group-item border-0 mb-2 shadow-sm">
							<a class="li_element text-secondary d-flex justify-content-between align-items-center" href="{{route('anio_lectivo.show',$anio_lectivo_Item)}}">
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
			<h2 class="display-8 mb-0">Periodos activos</h2>
				
			<h2 class="display-8 mb-0">Herramientas</h2>
			<ul>
				<a class="btn btn-primary" href="{{route('anio_lectivo.create')}}">Crear año lectivo</a> 
				<li>Crear Periodo</li>
				<li>Modificar años y periodos</li>
			</ul>
		</div>
	</div>
@endsection