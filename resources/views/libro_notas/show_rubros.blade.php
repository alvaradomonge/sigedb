@extends ('plantilla')
@section('titulo','Materia-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="d-flex justify-content-between">
			<h2 class="display-8 mb-0">Rubros de {{$materia->nombre}} {{$materia->grupo_guia->nombre}}</h2>	
		</div>
		<hr>
		<div class="d-flex align-content-start flex-wrap justify-content-between">
			@forelse ($materia->rubros as $rubro)
				<div class="card text-white bg-info m-1" >
				  <div class="card-header"><h5>{{$rubro->nombre}}</h5></div>
				  <div class="card-body">
				    <p class="card-title">Valor: {{$rubro->valor_porcentual}}%</p>
				    <p class="card-text">Asignaciones:</p>
				    <ul class="list-group list-group-flush">
				    	@forelse ($rubro->asignaciones as $asignacion)
							<li class="list-group-item">{{$asignacion->id}}:{{$asignacion->nombre}} ({{$asignacion->valor_porcentual}}%)</li>
						@empty
							<th>Cree asignaciones primero</th>
						@endforelse
				    </ul>
				  </div>
				</div>
			@empty
				<th>Cree rubros primero</th>
			@endforelse
		</div>
		{{-- <div class="table-responsive">
			<table class="table table-striped table-sm">
				<thead>
					<tr class="align-middle text-center text-nowrap">
						<th scope="col" colspan="2"></th>
						@forelse ($materia->rubros as $rubro)
							<th scope="col" class="table-active border border-secondary" colspan="{{$rubro->asignaciones()->count('*')}}">
								{{$rubro->id}}:{{$rubro->nombre}}
							</th>	
						@empty
							<th>Cree rubros primero</th>
						@endforelse
					</tr>
					<tr class="align-middle text-center text-nowrap  border border-secondary">
						<th scope="col" class="border border-secondary" >Nombre</th>
						<th scope="col" class="border border-secondary">Promedio</th>
						@forelse ($materia->asignaciones as $asignacion)
								<td scope="col" class="border border-secondary">{{$asignacion->id}}:{{$asignacion->nombre}} ({{$asignacion->valor_porcentual}}%)<a href="#"><i class="i-xlarge fas fa-pen-square"></i></a></td>
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
							@forelse($notas->where('id',$estudiante->id) as $asignacion)
								<td class="text-center border border-secondary">E:{{$asignacion->pivot->id_estud}}/A:{{$asignacion->pivot->id_asig}}/N:{{$asignacion->pivot->nota}}</td>
							@empty
								<td class="text-center">No hay asignaciones en esta clase, agregue unos primero</td>	
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
		</div> --}}
		<div class="d-flex align-items-center">
			<a class="btn btn-success" href="{{route('materia.notas',$materia)}}">Regresar</a>
			@auth 
				<a class="btn btn-primary" href="#">Crear Rubro</a>		
			@endauth
		</div>
	</div>
@endsection