@extends ('plantilla')
@section('titulo','Materia-SIGEDB')

@section ('contenido')
	
	<div class="container">
		<div class="d-flex justify-content-between">
			<h2 class="display-8 mb-0">Asistencia de hoy de {{$materia->nombre}} {{$materia->grupo_guia->nombre}}</h2>	
		</div>
		<hr>
		<div class="table-responsive">
			<table class="table table-striped table-sm table-hover">
				<thead>
					<tr class="align-middle text-center text-nowrap  border border-secondary">
						<th scope="col" class="border border-secondary" >Nombre</th>
						<th scope="col" class="border border-secondary" >Crear Incidencia</th>
						<th scope="col" class="border border-secondary" >Tardías</th>
						<th scope="col" class="border border-secondary" >Ausencias</th>
						<th scope="col" class="border border-secondary" >Escapes</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($materia->promedio_estudiante as $estudiante)
						<tr class="align-middle text-nowrap border-secondary">
							<th scope="col" class="font-weight-bold">
								{{$estudiante->apellido1}} {{$estudiante->apellido2}} {{$estudiante->name}}
							</th>
							<th scope="col" class="border text-center border-secondary" >
								<a class="btn btn-sm btn-outline-success" href="{{route('incidencia.create',['materia'=>$materia,'estudiante'=>$estudiante,'incidencia'=>1])}}">Tardía</a>
								<a class="btn btn-sm btn-outline-info" href="#">Ausencia</a>
								<a class="btn btn-sm btn-outline-danger" href="#">Escape</a>
							</th>
							<th scope="col" class="border border-secondary text-center" >
								{{$estudiante->incidencias_asistencia->where('pivot->id_escala_asistencia',1)->count()}}
							</th>
							<th scope="col" class="border border-secondary text-center" >
							{{$estudiante->incidencias_asistencia->where('pivot->id_escala_asistencia',2)->count()}}
							</th>
							<th scope="col" class="border border-secondary text-center" >
							{{$estudiante->incidencias_asistencia->where('pivot->id_escala_asistencia',3)->count()}}
							</th>
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
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Asistencia Masiva</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
	      		<div class="row">
		      		<div class="col-md-3">
			      		
					</div>
					<div class="col-md-5 d-flex">
						<label class="btn btn-sm btn-info" for="fecha">
							Fecha{!!$errors->first('id_lecciones','(*)')!!}
						</label>
						<input type="text" name="fecha">
			  		</div>
			  		<div class="col-md-3">
			  		</div>
		  		</div>
		  		<hr>
		        <div class="table-responsive">
					<table class="table table-striped table-sm">
						<thead>
							<tr>
								<th scope="col" class="" >Nombre</th>
								<th scope="col" class="" >Presente</th>
								<th scope="col" class="" >Tarde</th>
								<th scope="col" class="" >Ausencia</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($materia->promedio_estudiante as $estudiante)
								<tr class="align-middle text-nowrap">
									<th scope="col" class="font-weight-bold">
										{{$estudiante->apellido1}} {{$estudiante->apellido2}} {{$estudiante->name}}
									</th>
									<fieldset class="form-group">
									<th scope="col" class="font-weight-bold">
										<div class=" switch form-check custom-control custom-radio">
											<input type="radio" id="incidencia_{{$estudiante->id}}" name="incidencia_{{$estudiante->id}}" value="presente" class="custom-control-input" checked>
											<span class="slider"></span>
										</div>
									</th>
									<th scope="col" class="font-weight-bold">
										<div class="form-check custom-control custom-radio">
											<input type="radio" id="incidencia_{{$estudiante->id}}" name="incidencia_{{$estudiante->id}}" value="1" class="custom-control-input">
										</div>
									</th>
									<th scope="col" class="font-weight-bold">
										<div class="form-check custom-control custom-radio">
											<input type="radio" id="incidencia_{{$estudiante->id}}" name="incidencia_{{$estudiante->id}}" value="2" class="custom-control-input">
										</div>
									</th>
									</fieldset>
								</tr>
							@empty
								<tr>
									<td>No hay estudiantes asignados</td>
								</tr>	
							@endforelse
						</tbody>
					</table>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-4">
					</div>
					<div class="col-md-4">
						<ul class="list-group">
							<label class="btn btn-info" for="id_lecciones">
								Lecciones
							</label>
						  	@forelse ($lecciones as $leccion)
						  		<li class="list-group-item py-0">
									<div class="form-check form-switch fs-4">
										  <label class="form-check-label " for="leccion_{{$leccion->id}}">
										  	{{$leccion->nombre}} 
										  </label>
										  <input class="form-check-input " type="checkbox" id="leccion_{{$leccion->id}}">
									</div>
								</li>
							@empty
								<li class="list-group-item">
									Agregue lecciones
								</li>
							@endforelse
						</ul>
					</div>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		        <button type="button" class="btn btn-primary">Guardar</button>
		      </div>
		    </div>
		  </div>
		</div>
		<div class="d-flex align-items-center">
			@auth 
				
				@if(auth()->user()->id_rol_usuario == '1')
					<a class="btn btn-success" href="{{route('grupo_guia.materias',$materia->grupo_guia)}}">Regresar</a>
				@endif
				@if(auth()->user()->id_rol_usuario == '2')
					<a class="btn btn-success" href="{{route('inicio')}}">Regresar</a>	
				@endif	
				<a class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal" >Asistencia Masiva</a>
			@endauth
		</div>
	</div>
@endsection
@section('script')
	
@endsection