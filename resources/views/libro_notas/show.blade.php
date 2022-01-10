@extends ('plantilla')
@section('titulo','Materia-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="d-flex justify-content-between">
			<h2 class="display-8 mb-0">Notas de {{$materia->nombre}} {{$materia->grupo_guia->nombre}}</h2>	
		</div>
		<hr>
		<div class="table-responsive">
			<table class="table table-striped table-sm">
				<thead>
					<tr class="align-middle text-center text-nowrap">
						<th scope="col" colspan="2"></th>
						@forelse ($materia->rubros as $rubro)
							@if($rubro->asignaciones->count()==0)
							
							@else
							<th scope="col" class="table-active border border-secondary" colspan="{{$rubro->asignaciones()->count('*')}}">
								{{$rubro->id}}:{{$rubro->nombre}}
							</th>
							@endif	
						@empty
							<th>Cree rubros primero</th>
						@endforelse
					</tr>
					<tr class="align-middle text-center text-nowrap  border border-secondary">
						<th scope="col" class="border border-secondary" >Nombre</th>
						<th scope="col" class="border border-secondary">Promedio</th>
						@forelse ($materia->asignaciones as $asignacion)
							@if($asignacion->nota->count()==0)
							
							@else
								<td scope="col" class="border border-secondary">{{$asignacion->id}}:{{$asignacion->nombre}} ({{$asignacion->valor_porcentual}}%)<a href="{{route('asignacion.calificar',[$materia,$asignacion])}}"><i class="i-xlarge fas fa-pen-square"></i></a></td>
							@endif
						@empty
							<th>Cree asignaciones primero</th>
						@endforelse
					</tr>
				</thead>
				<tbody>
					@forelse ($materia->promedio_estudiante as $estudiante)
						<tr class="align-middle text-nowrap border-secondary">
							<th scope="row" class="font-weight-bold">
								{{$estudiante->apellido1}} {{$estudiante->apellido2}} {{$estudiante->name}}
							</th>
							<td class="text-center">
								@if($estudiante->promedio_materia == null)
									<p class="text-break">vacío</p>
								@else						
									<p class="text-break">{{$estudiante->pivot->promedio}}</p>
								@endif
							</td>
							@forelse($notas->where('id_estud',$estudiante->id) as $asignacion)
								<td class="text-center border border-secondary">E:{{$asignacion->pivot->id_estud}}/A:{{$asignacion->pivot->id_asig}}/N:{{$asignacion->pivot->nota}}</td>
							@empty
								<td class="text-center">No hay asignaciones para mostrar, agregue unas primero</td>	
							@endforelse
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
			@auth 
				<a class="btn btn-primary" href="{{route('materia.rubros',$materia)}}">Rubros y Asignaciones</a>	
				<a class="btn btn-secondary" href="#">Importar Rubros</a>	
			@endauth
		</div>
	</div>
@endsection