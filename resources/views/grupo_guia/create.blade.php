@extends ('plantilla')

@section('titulo','grupo guía-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-10 col-lg-6 mx-auto">				
				@include('partials.session-status')
				@if($errors->any())
					@include('grupo_guia.validation-errors')
				@endif
				<form class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{route('grupo_guia.store')}}">
					@csrf 
					<h2 class="display-8">Nuevo grupo guia</h2>
					<hr>
					<div class="form-group">
						<label for="nombre">
							Indique grupo guia{!!$errors->first('nombre','(*)')!!}
						</label>
						<br>
						<input id="nombre" class="form-control border-0 bg-light shadow-sm" type="text" name="nombre" value="{{old('nombre',$grupo_guia->nombre)}}">
					</div>

					<div class="form-group">
						<label for="id_periodo">
							Seleccione el periodo{!!$errors->first('id_periodo','(*)')!!}
						</label>
						<br>
						
						 <select name="id_periodo" class="form-control">
							@forelse ($periodo as $periodo_Item)
								<option value="{{$periodo_Item->id}}">
									{{$periodo_Item->nombre}}
								</option>
							@empty
								<option>No existen peridos</option>
							@endforelse
						</select>
					</div>

					<br>
					<button class="btn btn-primary btn-lg btn-block">Crear</button>
					<a class="btn btn-secondary btn-lg btn-block" href="{{route('grupo_guia.index',$grupo_guia)}}">Cancelar</a> 
				</form>
			</div>
		</div>
	</div>
@endsection