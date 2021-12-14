@extends ('plantilla')
@section('titulo','Materia-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h2 class="display-8 mb-0">Notas de {{$materia->nombre}} {{$materia->grupo_guia->nombre}}</h2>			
		</div>
		<hr>
		<table class="table table-striped table-sm ">
				<thead>
					<tr>
						<th scope="col">Nombre</th>
						<th scope="col">Promedio</th>
						@forelse ($materia->asignaciones as $asignacion_Item)
							<th scope="col">{{$asginacion_Item->nombre}}</th>
						@empty
							<th>Cree asignaciones primero</th>
						@endforelse
						{{-- <th scope="col">Categoría</th>
						<th scope="col">Docente</th>
						<th scope="col">Estado</th>
						<th scope="col">Herramientas</th> --}}
					</tr>
				</thead>
				<tbody>
					@forelse ($materia->promedio_estudiante as $promedio_estudiante_Item)
						<tr>
							<th scope="row" class="font-weight-bold">
								{{$promedio_estudiante_Item->apellido1}} {{$promedio_estudiante_Item->apellido2}} {{$promedio_estudiante_Item->name}}
							</th>
							<td>
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
		<div class="d-flex align-items-center">
			<a class="btn btn-success" href="{{route('grupo_guia.materias',$materia->grupo_guia)}}">Regresar</a>
			@auth <a class="btn btn-info" href="#">Guardar</a>@endauth
		</div>
	</div>
@endsection