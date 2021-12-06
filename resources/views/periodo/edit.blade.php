@extends ('plantilla')

@section('titulo','Periodo-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-10 col-lg-6 mx-auto">				
				@include('partials.validation-errors')
				<form class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{route('periodo.update',$periodo)}}">
					@csrf
					<h2 class="display-8">Editar periodo</h2> 
					<hr>
					@method('PATCH')
					<div class="form-group">
						<label for="nombre">
							Nombre del periodo{!!$errors->first('nombre','(*)')!!}
						</label>
						<br>
						<input id="nombre" class="form-control border-0 bg-light shadow-sm" type="text" name="nombre" value="{{old('nombre',$periodo->nombre)}}">
						<label for="id_anio">
							Año Lectivo al que pertenece{!!$errors->first('id_anio','(*)')!!}
						</label>
						<br>
						<input id="id_anio" class="form-control border-0 bg-light shadow-sm" type="text" name="id_anio" value="{{old('nombre',$periodo->anio_lectivo->nombre)}}">
						<label for="valor_porcentual">
							Valor porcentual{!!$errors->first('valor_porcentual','(*)')!!}
						</label>
						<br>
						<input id="valor_porcentual" class="form-control border-0 bg-light shadow-sm" type="text" name="valor_porcentual" value="{{old('nombre',$periodo->valor_porcentual)}}">
						<label for="es_final">
							¿Es un periodo final?{!!$errors->first('valor_porcentual','(*)')!!}
						</label>
						<br>
						<input id="es_final" class="form-control border-0 bg-light shadow-sm" type="text" name="es_final" value="{{old('es_final',$periodo->es_final)}}">
						<label for="activo">
							¿Es periodo Activo?{!!$errors->first('es_final','(*)')!!}
						</label>
						<br>
						<input id="activo" class="form-control border-0 bg-light shadow-sm" type="text" name="activo" value="{{old('activo',$periodo->activo)}}">
					</div>
					<br>
					<button class="btn btn-primary btn-lg btn-block">Actualizar</button>
					<a class="btn btn-secondary btn-lg btn-block" href="{{route('periodo.index',$periodo)}}">Cancelar</a> 
				</form>
			</div>
		</div>
	</div>
@endsection