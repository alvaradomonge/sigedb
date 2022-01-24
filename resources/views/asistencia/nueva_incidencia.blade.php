@extends ('plantilla')

@section('titulo','Editar-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-10 col-lg-6 mx-auto">				
				@include('partials.validation-errors')
				<form class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{route('incidencia.create',['materia'=>$materia])}}">
					@csrf
					<h2 class="display-8">
						Agregar incidencia para {{$estudiante->name}} {{$estudiante->apellido1}}
					</h2> 
					<hr>
					<input id="id_user" class="d-none" type="text" name="id_user" value="{{$estudiante->id}}">
					<input id="id_grupo_guia" class="d-none" type="text" name="id_grupo_guia" value="{{$materia->grupo_guia->id}}">
					<input id="id_materia" class="d-none" type="text" name="id_materia" value="{{$materia->id}}">
					<div class="form-group">
						<label for="id_escala_incidencia">
							Incidencia
						</label>
						<br>
						<select name="id_escala_incidencia" class="form-control">
							@forelse ($escala_asistencia as $incidencia)
								<option value="{{$incidencia->id}}" @if($incidencia->id==$incidencia) selected @endif>
									{{$incidencia->nombre}}
								</option>
							@empty
								<option>
									Agregue primero incidencias a la lista primero
								</option>
							@endforelse
					  	</select>
					</div>

					<div class="form-group">
						<label for="fecha_incidencia">
							Valor Porcentual{!!$errors->first('valor_porcentual','(*)')!!}
						</label>
						<br>
						<input id="fecha_incidencia" class="form-control border-0 bg-light shadow-sm" type="date" value="{{$fecha}}" name="fecha_incidencia">
					</div>
					<br>
					<button class="btn btn-primary btn-lg btn-block">Actualizar</button>
					<a class="btn btn-secondary btn-lg btn-block" href="{{redirect()->back()}}">Cancelar</a> 
				</form>
			</div>
		</div>
	</div>

@endsection