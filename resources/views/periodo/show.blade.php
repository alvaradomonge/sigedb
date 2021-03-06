@extends ('plantilla')

@section('titulo','Datos del periodo')

@section ('contenido')
	<div class="container">
		<div class="bg-white p-4 shadow rounded">
			<h2 class="display-8">Datos del perdiodo</h2>
			<p class="text-black">Nombre: {{$periodo->nombre}}</p>
			<p class="text-black">Valor Porcentual: {{$periodo->valor_porcentual}}%</p>
			<div class="form-check form-switch">
			  <label class="form-check-label" for="es_final">¿Es un periodo final?</label>
			  <input class="form-check-input" type="checkbox" id="es_final" @if ($periodo->es_final =='1') checked @else @endif disabled>
			</div>
			<br>
			<div class="form-check form-switch">
			  <label class="form-check-label" for="activo">¿Periodo Activo?</label>
			  <input class="form-check-input" type="checkbox" id="activo" @if ($periodo->activo =='1') checked @else @endif disabled>
			</div>
			<br>
			<p class="text-black fs-5 text">Grupos vinculados:</p>
			{{-- <div class="dropdown">
				<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
			    	Seleccione un grupo guía
			  	</a>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					@forelse ($grupos_guia as $grupo_guia_Item)
						<li>
							<a class="dropdown-item" href="{{route('admin.gruposEstudiantes',$grupo_guia_Item)}}">
								<span class="font-weight-bold">
									{{$grupo_guia_Item->nombre}} / {{$grupo_guia_Item->estudiantes()->count('*')}} estudiantes
								</span>
							</a>
						</li>
					@empty
						<li>
							No posee grupos vinculados
						</li>
					@endforelse
				</ul> --}}
				<table class="table table-striped table-sm ">
					<thead>
						<tr>
							<th scope="col">Nombre</th>
							<th scope="col">Estudiantes inscritos</th>
							<th scope="col">Materias</th>
							<th scope="col">Herramientas</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($grupos_guia as $grupo_guia_Item)
							<tr>
								<th scope="row" class="font-weight-bold">
									{{$grupo_guia_Item->nombre}}
								</th>
								<td>
									{{$grupo_guia_Item->estudiantes()->count('*')}}
								</td>
								<td>
									{{$grupo_guia_Item->materias()->count('*')}}
								</td>
								<td>
									<a class="btn btn-sm btn-outline-info" href="{{route('admin.gruposEstudiantes',$grupo_guia_Item)}}">
									Estudiantes
								</a>
									<a class="btn btn-sm btn-outline-success" href="{{route('grupo_guia.materias',$grupo_guia_Item)}}">
									Materias
								</a>
								</a>
									<a class="btn btn-sm btn-outline-primary" href="{{route('grupo_guia.asistencia',$grupo_guia_Item)}}">
									Asistencia
								</a>
								</a>
									<a class="btn btn-sm btn-outline-danger" href="#">
									Conducta
								</a>
								</td>
							</tr>
						@empty
							<tr>
								<td class="list-group-item border-0 mb-2 shadow-sm" >
									No hay grupos en este periodo 
								</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<br>	
			<div class="d-flex justify-content-between align-items-center">
				<a class="btn btn-primary" href="{{route('admin.gestionAniosPeriodos')}}">Regresar</a>
				@auth 
					<div class="btn-group btn-group-sm">
						<a class="btn btn-primary" href="{{route('periodo.edit',$periodo)}}">Editar</a> 
						<a class="btn btn-danger" href="#" onclick="document.getElementById('delete').submit()">Eliminar</a>
					</div>
					<form id="delete" class="d-none" method="POST" action="{{route('periodo.destroy',$periodo->id)}}">
						@csrf @method('DELETE')
					</form>
					
				@endauth
			</div>
		</div>
@endsection