@extends ('plantilla')

@section('titulo','Editar-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-10 col-lg-6 mx-auto">				
				@include('partials.validation-errors')
				<form class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{route('asignacion.update',['asignacion'=>$asignacion,'materia'=>$materia])}}">
					@csrf
					<h2 class="display-8">Editar Asignación</h2> 
					<hr>
					@method('PATCH')
					<div class="form-group">
						<label for="nombre">
							Nombre{!!$errors->first('nombre','(*)')!!}
						</label>
						<br>
						<input id="nombre" class="form-control border-0 bg-light shadow-sm" type="text" name="nombre" value="{{old('nombre',$asignacion->nombre)}}">
					</div>

					<div class="form-group">
						<label for="valor_porcentual">
							Valor Porcentual{!!$errors->first('valor_porcentual','(*)')!!}
						</label>
						<br>
						<input id="valor_porcentual" class="form-control border-0 bg-light shadow-sm" type="text" name="valor_porcentual" value="{{old('valor_porcentual',$asignacion->valor_porcentual)}}">
					</div>
						<input id="id_rubro" class="form-control border-0 bg-light shadow-sm d-none" type="text" name="id_rubro" value="{{$asignacion->id_rubro}}">
					<br>
					<button class="btn btn-primary btn-lg btn-block">Actualizar</button>
					<a class="btn btn-secondary btn-lg btn-block" href="{{route('materia.rubros',$materia)}}">Cancelar</a> 
				</form>
			</div>
		</div>
	</div>

@endsection