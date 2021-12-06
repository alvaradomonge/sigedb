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
						<select name="id_anio" class="form-control">
							@forelse ($anio_lectivo as $anio_lectivo_Item)
								<option value="{{$anio_lectivo_Item->id}}" @if($anio_lectivo_Item->id==$periodo->id_anio) selected @endif>
									{{$anio_lectivo_Item->nombre}}
								</option>
							@empty
								<option>
									Agregue primero un año lectivo
								</option>
							@endforelse
					  	</select>
						{{-- <input id="id_anio" class="form-control border-0 bg-light shadow-sm" type="text" name="id_anio" value="{{old('id_anio',$periodo->anio_lectivo->nombre)}}"> --}}
						<label for="valor_porcentual">
							Valor porcentual{!!$errors->first('valor_porcentual','(*)')!!}
						</label>
						<br>
						<input id="valor_porcentual" class="form-control border-0 bg-light shadow-sm" type="text" name="valor_porcentual" value="{{old('valor_porcentual',$periodo->valor_porcentual)}}">
						<br>
						<label>¿Es un periodo final?</label>
					  	<select name="es_final" class="form-control">
							<option value="1" @if($periodo->es_final=='1') selected @endif>
								Si
							</option>
							<option value="0" @if($periodo->es_final=='0') selected @endif>
								NO
							</option>
					  	</select>
						<br>
						<label>¿Periodo Activo?</label>
						<select name="activo" class="form-control">
							<option value="1" @if($periodo->activo=='1') selected @endif>
								Si
							</option>
							<option value="0" @if($periodo->activo=='0') selected @endif>
								NO
							</option>
					  	</select>
					</div>
					<br>
					<button class="btn btn-primary btn-lg btn-block">Actualizar</button>
					<a class="btn btn-secondary btn-lg btn-block" href="{{route('periodo.index',$periodo)}}">Cancelar</a> 
				</form>
			</div>
		</div>
	</div>
@endsection