@extends ('plantilla')
@section('titulo','Materia-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="d-flex justify-content-between">
			<h2 class="display-8 mb-0">Rubros en {{$materia->nombre}} {{$materia->grupo_guia->nombre}}</h2>	
		</div>
		<hr>
		<div class="d-flex row align-content-start justify-content-start">
			<div class="col-md-7" >
				@forelse ($materia->rubros as $rubro)
					<div class="list-group py-2" >	
						<div class="list-group-item list-group-item-action bg-info">
							<div class=" d-flex justify-content-between" >
								{{$rubro->nombre}} ({{$rubro->valor_porcentual}}%)
								<a class="btn btn-primary" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse" href="#collapse_rubro_{{$rubro->id}}">
									<i class="fas fa-bars"></i>
								</a>
							</div>
							<div class="collapse" id="collapse_rubro_{{$rubro->id}}">
								<a class="btn btn-success" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse" href="#collapse_nueva_asignacion_{{$rubro->id}}">Crear Asignación</a>
								<a class="btn btn-danger" href="#" onclick="document.getElementById('delete-grupo_guia').submit()">Eliminar Rubro</a>
								<form id="delete-grupo_guia" class="d-none" method="POST" action="{{route('rubro.destroy',$rubro)}}">
									@csrf @method('DELETE')
								</form>
								<div class="collapse" id="collapse_nueva_asignacion_{{$rubro->id}}">
									<form class="bg-white py-3 px-2 shadow rounded" method="POST" action="{{route('nueva.asignacion',$materia)}}">
										@csrf
										<h3>Nueva Asignación</h3>
										<div class="input-group">
											<label class="btn btn-info" for="nombre">
												Nombre
											</label>
											<input type="text" name="nombre" id="nombre" class="form-control">
											<label class="btn btn-success" for="valor_porcentual">
												Valor
											</label>
											<input type="text" name="valor_porcentual" id="valor_porcentual" class="form-control">
											<input type="text" name="id_rubro" id="id_rubro" value="{{$rubro->id}}" class="form-control d-none">
											<div class="input-group-append">
												<button class="btn btn-danger">Agregar</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					    <ul class="list-group">
					    	@forelse ($rubro->asignaciones as $asignacion)
								<li class="list-group-item">
									<div class=" d-flex justify-content-between" >
										{{$asignacion->id}}:{{$asignacion->nombre}} ({{$asignacion->valor_porcentual}}%)
										<div>
											<a class="px-2 text-success" href="#">
												<i class="fas fa-pencil-alt"></i>
											</a>
											<a class="px-2 text-danger" href="#">
												<i class="fas fa-trash-alt"></i>
											</a>
										</div>
									</div>
								</li>
							@empty
								<th>Cree asignaciones primero</th>
							@endforelse
					    </ul>
				  	</div>
				@empty
					<th>Cree rubros primero</th>
				@endforelse
			</div>
			<div class="col-md-4" >
				<h2 class="display-8 mb-0">Sumatoria de rubros: {{$porcentaje_total}}%</h2>	
			</div>
		</div>
		<div class="collapse" id="collapse_nuevo_rubro">
			<form class="bg-white py-3 px-2 shadow rounded" method="POST" action="{{route('nuevo.rubro',$materia)}}">
				@csrf
				<h3>Nuevo rubro</h3>
				<div class="input-group">
					<label class="btn btn-info" for="nombre">
						Nombre
					</label>
					<input type="text" name="nombre" id="nombre" class="form-control">
					<label class="btn btn-success" for="valor_porcentual">
						Valor
					</label>
					<input type="text" name="valor_porcentual" id="valor_porcentual" class="form-control">
					<input type="text" name="id_materia" id="id_materia" value="{{$materia->id}}" class="form-control d-none">
					<div class="input-group-append">
						<button class="btn btn-danger">Agregar</button>
					</div>
				</div>
			</form>
		</div>
		<hr>
		<div class="d-flex align-items-center">
			<a class="btn btn-success" href="{{route('materia.notas',$materia)}}">Regresar</a>
			@auth 
				<a class="btn btn-dark" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse" href="#collapse_nuevo_rubro">Nuevo Rubro</a>	
			@endauth
		</div>
		
	</div>
@endsection