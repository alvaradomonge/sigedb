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

<div class="form-group">
	<label for="id_grupo_guia">
		Seleccione el grupo guía {!!$errors->first('id_grupo_guia','(*)')!!}
	</label>
	<br>
	 <select name="id_grupo_guia" class="form-control">
		@forelse ($grupo_guia as $grupo_guia_Item)
			<option value="{{$grupo_guia_Item->id}}" @if($grupo_guia_Item->id==$materia->id_grupo_guia) selected @endif>
				{{$grupo_guia_Item->nombre}}
			</option>
		@empty
			<option>No existen grupos</option>
		@endforelse
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
		Seleccione el tipo de materia{!!$errors->first('es_cualitativo','(*)')!!}
	</label>
	<br>
	
	 <select name="es_cualitativo" class="form-control">
		<option value="{{1}}">Cuantitativa</option>
		<option value="{{0}}">Cualitativa</option>
	</select>
</div>

<br>
<button class="btn btn-primary btn-lg btn-block">{{$btnText}}</button>
<a class="btn btn-secondary btn-lg btn-block" href="{{route('materia.index',$materia)}}">Cancelar</a> 