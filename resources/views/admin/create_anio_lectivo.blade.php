@extends ('plantilla')

@section('titulo','Año Lectivo-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-10 col-lg-6 mx-auto">				
				@include('partials.session-status')
				@if($errors->any())
					@include('partials.validation-errors')
				@endif
				<form class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{route('anio_lectivo.store')}}">
					@csrf 
					<h2 class="display-8">Nuevo año lectivo</h2>
					<hr>
					<div class="form-group">
						<label for="nombre">
							Indique el año{!!$errors->first('nombre','(*)')!!}
						</label>
						<br>
						<input id="nombre" class="form-control border-0 bg-light shadow-sm" type="text" name="nombre" value="{{old('nombre',$anio_lectivo->nombre)}}">
					</div>
					<br>
					<button class="btn btn-primary btn-lg btn-block">Crear</button>
					<a class="btn btn-secondary btn-lg btn-block" href="{{route('anio_lectivo.index',$anio_lectivo)}}">Cancelar</a> 
				</form>
			</div>
		</div>
	</div>
@endsection