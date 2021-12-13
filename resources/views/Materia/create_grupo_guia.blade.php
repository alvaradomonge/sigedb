@extends ('plantilla')

@section('titulo','Materia-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-10 col-lg-6 mx-auto">				
				@include('partials.session-status')
				@if($errors->any())
					@include('materia.validation-errors')
				@endif
				<form class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{route('materia.store')}}">
					<h2 class="display-8">{{$grupo_guia->nombre}}: Crear nueva Materia</h2>
					<hr>
					@csrf 
<div class="form-group">
	<label for="nombre">
		Nombre de la materia{!!$errors->first('nombre','(*)')!!}
	</label>
	<br>
	<input id="nombre" class="form-control border-0 bg-light shadow-sm" type="text" name="nombre" value="{{old('nombre',$materia->nombre)}}">
</div>

{{-- <div class="form-group">
	<input id="id_libro_notas" type="hidden" name="id_libro_notas" value="1">
</div> --}}

<div class="form-group">
	<label for="id_categoria_materia">
		Seleccione la categoría de la materia{!!$errors->first('id_categoria_materia','(*)')!!}
	</label>
	<br>
	<select name="id_categoria_materia" class="form-control">
		
		@forelse ($categorias as $categoria_Item)
			<option value="{{$categoria_Item->id}}" @if($categoria_Item->id==$materia->id_categoria_materia) selected @endif>
				{{$categoria_Item->nombre}}
			</option>
		@empty
			<option>No existen categorías</option>
		@endforelse
	
	</select>
</div>

<div class="form-group d-none">
	<label for="id_grupo_guia">
		Seleccione el grupo guía {!!$errors->first('id_grupo_guia','(*)')!!}
	</label>
	<br>
	 <select name="id_grupo_guia" class="form-control">
			<option value="{{$grupo_guia->id}}" selected>
				{{$grupo_guia->nombre}}
			</option>
	</select>
</div>

<div class="form-group">
	<label for="id_user">
		Seleccione el docente{!!$errors->first('id_user','(*)')!!}
	</label>
	<br>
	
	 <select name="id_user" class="form-control">
		@forelse ($user as $user_Item)
			<option value="{{$user_Item->id}}" @if($user_Item->id==$materia->id_user) selected @endif>
				{{$user_Item->name}} {{$user_Item->apellido1}} {{$user_Item->apellido2}}
			</option>
		@empty
			<option>No existen docentes</option>
		@endforelse
	</select>
</div>

<div class="form-group">
	<label for="id_estado">
		Seleccione el estado de la materia{!!$errors->first('id_estado','(*)')!!}
	</label>
	<br>
	
	 <select name="id_estado" class="form-control">
	@forelse ($estado_materia as $estado_Item)
			<option value="{{$estado_Item->id}}" @if($estado_Item->id==$materia->estado_Item) selected @endif>
				{{$estado_Item->nombre}}
			</option>
		@empty
			<option>No existen estados</option>
		@endforelse

	</select>
</div>

<div class="form-group">
	<label for="es_cualitativo">
		Seleccione el tipo de libro de notas{!!$errors->first('es_cualitativo','(*)')!!}
	</label>
	<br>
	
	 <select name="es_cualitativo" class="form-control">
		<option value="{{1}}">Cuantitativo</option>
		<option value="{{0}}">Cualitativo</option>
	</select>
</div>

<br>
<button class="btn btn-primary btn-lg btn-block">Crear</button>
<a class="btn btn-secondary btn-lg btn-block" href="{{route('materia.index',$materia)}}">Cancelar</a> 
				</form>
			</div>
		</div>
	</div>
@endsection