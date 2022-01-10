@extends ('plantilla')
@section('titulo','Materia-SIGEDB')
@section('css')
	<script type="text/javascript" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"></script>
@endsection
@section ('contenido')
	<div class="container">
		<div class="d-flex justify-content-between">
			<h2 class="display-8 mb-0">Calificación de: {{$asignacion->nombre}} ({{$materia->nombre}} {{$materia->grupo_guia->nombre}})</h2>	
		</div>
		<hr>
		<div class="row">
			<div class="col-md-3">
				
			</div>
			<div class="d-flex table-responsive col-md-5 justify-content-between">
				<table class="table table-striped table-sm">
					<thead>
						<tr class="align-middle text-center text-nowrap  border border-secondary">
							<th scope="col" class="border border-secondary" >Nombre</th>
							<th scope="col" class="border border-secondary">Calificación</th>
						</tr>
					</thead>
					<tbody>
						@include('partials.validation-errors')
						<form class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{route('calificacion.update')}}">
							@csrf
							@method('PATCH')
						@forelse ($asignacion->nota as $estudiante)
							<tr class="align-middle text-nowrap border border-secondary">
								<th scope="row" class="font-weight-bold">
									{{$estudiante->apellido1}} {{$estudiante->apellido2}} {{$estudiante->name}}
								</th>
								<th scope="row" class="font-weight-bold">
									<div class="row">
										<div class="col-4 col-sm-3">
				
										</div>
										<div class="col-4 col-sm-5 form-group">
											<input id="id" class="form-control d-none border-0 bg-light shadow-sm" type="text" name="id" value="{{old('nombre',$estudiante->id)}}">
											<input id="nota{{$estudiante->id}}" class="form-control border-0 bg-transparent shadow-sm text-center" type="text" name="nota{{$estudiante->id}}" value="{{old('nombre',$estudiante->pivot->nota)}}">
										</div>
										<div class="col-4 col-sm-3">
				
										</div>
									</div>
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
		</div>
		<div class="d-flex align-items-center">
			<a class="btn btn-success" href="{{route('materia.notas',$materia)}}">Regresar</a>
			@auth 
				<button class="btn btn-primary btn-lg btn-block">Actualizar</button>
				{{-- <a class="btn btn-primary" href="">Guardar Cambios</a>	 --}}
			@endauth
		</form>
		</div>
	</div>
@endsection