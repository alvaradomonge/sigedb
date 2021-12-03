@extends ('plantilla')

@section('titulo','Nuevo Periodo-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-10 col-lg-6 mx-auto">				
				@include('partials.session-status')
				@if($errors->any())
					@include('partials.validation-errors')
				@endif
				<form class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{route('periodo.store')}}">
					@csrf 
					<h2 class="display-8">Nuevo Periodo</h2>
					<hr>
					<div class="form-group">
						<label for="nombre">
							Nombre{!!$errors->first('nombre','(*)')!!}
						</label>
						<br>
						<input id="nombre" class="form-control border-0 bg-light shadow-sm" type="text" name="nombre" value="{{old('nombre',$periodo->nombre)}}">
					  	<label>Año Lectivo al que pertenece</label>
					  	<select name="id_anio" class="form-control">
					  		@forelse ($anio_lectivo as $anio_lectivo_Item)
								<option value="{{$anio_lectivo_Item->id}}">
									{{$anio_lectivo_Item->nombre}}
								</option>
							@empty
								<option>Cree primero un año lectivo</option>
							@endforelse
					  	</select>
						
					  	<label>Valor porcentual del periodo</label>
					  	<select name="valor_porcentual" class="form-control">
							<option value="25">
								25%
							</option>
							<option value="33">
								33%
							</option>
							<option value="50">
								50%
							</option>
					  	</select>
					  	<label>¿Es un periodo final?</label>
						<select name="es_final" class="form-control">
							<option value="0">
								No
							</option>
							<option value="1">
								Si
							</option>
					  	</select>
					  	<label>Estado del periodo</label>
						<select name="activo" class="form-control">
							<option value="1">
								Crear como activo
							</option>
							<option value="0">
								Crear como inactivo
							</option>
					  	</select>
					</div>
					<br>
					<button class="btn btn-primary btn-lg btn-block">Crear</button>
					<a class="btn btn-secondary btn-lg btn-block" href="{{route('admin.gestionAniosPeriodos')}}">Cancelar</a> 
				</form>
			</div>
		</div>
	</div>
@endsection