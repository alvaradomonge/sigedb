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
			<h2 class="display-8 mb-0">Materias de {{$grupo_guia->nombre}}</h2>
			@auth 
				<a class="btn btn-primary" href="{{route('materia.create')}}">Agregar materia</a> 
			@endauth
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
								<a class="btn btn-sm btn-outline-danger" href="{{route('materia.show',['materia'=>$materia_Item])}}">Ver</a>
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
			<a class="btn btn-info" href="{{route('materia.create_grupo_guia',$grupo_guia)}}">Agregar materia</a>
			{{-- <a class="btn btn-dark" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse" href="#collapse">Vincular estudiante</a> --}}
		</div>
	</div>
@endsection