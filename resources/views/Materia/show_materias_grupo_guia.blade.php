@extends ('plantilla')
@section('titulo','Materia-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h2 class="display-8 mb-0">Materias de {{$grupo_guia->nombre}}</h2>			
		</div>
		<hr>
		<table class="table table-striped table-sm ">
				<thead>
					<tr>
						<th scope="col">Nombre</th>
						<th scope="col"># de estudiantes</th>
						<th scope="col">Categoría</th>
						<th scope="col">Docente</th>
						<th scope="col">Estado</th>
						<th scope="col">Herramientas</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($grupo_guia->materias as $materia_Item)
						<tr>
							<th scope="row" class="font-weight-bold">
								{{$materia_Item->nombre}}
							</th>
							<td>
								@if($materia_Item->promedio_estudiante == null)
									<p class="text-break">vacío</p>
								@else						
									<p class="text-break">{{$materia_Item->promedio_estudiante->count('*')}}</p>
								@endif
							</td>
							<td>
								<p class="text-break">{{$materia_Item->categoria->nombre}}</p>
							</td>
							<td>
								<p class="text-break">{{$materia_Item->docentes->name}} {{$materia_Item->docentes->apellido1}} {{$materia_Item->docentes->apellido2}}</p>
							</td>
							<td>
								<p class="text-break">{{$materia_Item->estados->nombre}}</p>
							</td>
							<td>
								@auth 
									<a class="btn btn-sm btn-outline-info" href="{{route('materia.show',['materia'=>$materia_Item])}}"><i class="fas fa-search"></i></a>
									<a class="btn btn-sm btn-outline-danger" href="{{route('materia.notas',['materia'=>$materia_Item])}}"><i class="fas fa-chart-line"></i></a>
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
		<div class="d-flex align-items-center">
			<a class="btn btn-success" href="{{route('periodo.show',$grupo_guia->periodo)}}">Regresar</a>
			@auth <a class="btn btn-info" href="{{route('materia.create_grupo_guia',$grupo_guia)}}">Agregar materia</a>@endauth
		</div>
	</div>
@endsection