@extends ('plantilla')
@section('titulo','Materia-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h2 class="display-8 mb-0">Notas de {{$materia->nombre}} {{$materia->grupo_guia->nombre}}</h2>			
		</div>
		<hr>
		<div class="table-responsive">
			<table class="table table-striped table-sm">
				<thead>
					<tr class="align-middle text-center text-nowrap">
						<th scope="col" colspan="2"></th>
						@forelse ($materia->rubros as $rubro)
							<th scope="col" class="table-active" colspan="{{$rubro->asignaciones()->count('*')}}">	
								<th>{{$rubro->nombre}}</th>
							</th>	
						@empty
							<th>Cree rubros primero</th>
						@endforelse
					</tr>
					<tr class="align-middle text-center text-nowrap">
						<th scope="col">Nombre</th>
						<th scope="col">Promedio</th>
						@forelse ($materia->rubros as $rubro)
							<td>
							@forelse ($rubro->asignaciones as $asginacion)
								<td scope="col">{{$asginacion->nombre}}</td>
							@empty
								<td scope="col">No posee asignaciones</td>
							@endforelse
							</td>
						@empty
							<th>Cree asignaciones primero</th>
						@endforelse
					</tr>
				</thead>
				<tbody>
					@forelse ($materia->promedio_estudiante as $promedio_estudiante_Item)
						<tr class="align-middle text-nowrap">
							<th scope="row" class="font-weight-bold">
								{{$promedio_estudiante_Item->apellido1}} {{$promedio_estudiante_Item->apellido2}} {{$promedio_estudiante_Item->name}}
							</th>
							<td class="text-center">
								@if($promedio_estudiante_Item->promedio_materia == null)
									<p class="text-break">vacío</p>
								@else						
									<p class="text-break">{{$promedio_estudiante_Item->pivot->promedio}}</p>
								@endif
							</td>
							{{-- ACA VAN MAS TD PARA LAS ASIGNACIONES --}}
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
		</div>
		<div class="d-flex align-items-center">
			<a class="btn btn-success" href="{{route('grupo_guia.materias',$materia->grupo_guia)}}">Regresar</a>
			@auth <a class="btn btn-info" href="#">Guardar</a>@endauth
		</div>
	</div>
@endsection