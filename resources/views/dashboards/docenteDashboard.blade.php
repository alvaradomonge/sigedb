@section('titulo','Dashboard Docente - SIGEDB')

<div class="container">
	<div class="align-items-center">
		<h2 class="display-8 text-primary">¡Hola {{auth()->user()->name}}!</h2>
		
		<div>
			<h3 class="display-7 text-secondary">Clases Activas:</h3>
			<div class="row">
				<div class="col-12">
					<div class="row">
						@forelse(auth()->user()->materias()->where('id_estado',1)->get() as $materia)
							<div class="card bg-light my-2 mx-2 p-0 border border-2 rounded-3" style="width: 15rem;">
								<div class="card-header fw-bolder">
							    	{{$materia->grupo_guia->nombre}} {{$materia->nombre}}
							  	</div>
								<div class="card-body">
									<h6 class="card-subtitle mb-2 text-danger fw-bolder">{{$materia->grupo_guia->periodo->nombre}} ({{$materia->grupo_guia->periodo->anio_lectivo->nombre}})</h6>
									<a href="{{route('materia.notas',$materia)}}" class="btn btn-success">Libro Notas</a>
									<a href="#" class="btn btn-danger">Asistencia</a>
								</div>
							</div>
						@empty
							<p class="">Aún no posee clases asignadas</p>
						@endforelse
					</div>
				</div>
			</div>
		</div>
		{{-- <div>
			<h3 class="display-7 text-secondary">Otras Herramientas:</h3>	
		</div> --}}
		

	</div>
</div>