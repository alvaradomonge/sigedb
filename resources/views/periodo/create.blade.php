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
					  	<label>Seleccione un Año Lectivo</label>
					  	<select class="form-control">
					  		@forelse ($anio_lectivo as $anio_lectivo_Item)
									<option value="{{$anio_lectivo_Item->id}}">{{$anio_lectivo_Item->nombre}}</option>
							@empty
								<option>Cree primero un año lectivo</option>
							@endforelse
					  	</select>
						<label for="nombre">
							Nombre{!!$errors->first('nombre','(*)')!!}
						</label>
						<br>
						<input id="nombre" class="form-control border-0 bg-light shadow-sm" type="text" name="nombre" value="{{old('nombre',$periodo->nombre)}}">
					</div>
					<br>
					<button class="btn btn-primary btn-lg btn-block">Crear</button>
					<a class="btn btn-secondary btn-lg btn-block" href="{{route('admin.gestionAniosPeriodos')}}">Cancelar</a> 
				</form>
			</div>
		</div>
	</div>
@endsection