@csrf 
<div class="form-group">
	<label for="nombre">
		Nombre de la materia{!!$errors->first('nombre','(*)')!!}
	</label>
	<br>
	<input id="nombre" class="form-control border-0 bg-light shadow-sm" type="text" name="nombre" value="{{old('nombre',$materia->nombre)}}">
</div>

<div class="form-group">
	<label for="id_libro_nota">
		Seleccione el libro de nota {!!$errors->first('id_libro_nota','(*)')!!}
	</label>
	<br>
	
	 <select name="id_libro_nota" class="form-control">
		<option value="{{" "}}">Libro 1</option>
		<option value="{{" "}}">libro 2</option>
	</select>
</div>


<div class="form-group">
	<label for="id_grupo_guia">
		Seleccione el grupo guía {!!$errors->first('id_grupo_guia','(*)')!!}
	</label>
	<br>
	

	 <select name="id_grupo_guia" class="form-control">
		@forelse ($grupo_guia as $grupo_guia_Item)
			<option value="{{$grupo_guia_Item->id}}">
				{{$grupo_guia_Item->nombre}}
			</option>
		@empty
			<option>No existen grupos</option>
		@endforelse
	</select>
</div>

<div class="form-group">
	<label for="id_docente">
		Seleccione el docente{!!$errors->first('id_docente','(*)')!!}
	</label>
	<br>
	
	 <select name="id_docente" class="form-control">
		<option value="{{" "}}">Docente 1</option>
		<option value="{{" "}}">Docente 2</option>
	</select>
</div>

<div class="form-group">
	<label for="id_estado">
		Seleccione el estado de la materia{!!$errors->first('id_estado','(*)')!!}
	</label>
	<br>
	
	 <select name="id_estado" class="form-control">
		<option value="{{"1"}}">Activo</option>
		<option value="{{"2"}}">Bloqueado</option>
		<option value="{{"3"}}">Finalizado</option>
	</select>
</div>

<br>
<button class="btn btn-primary btn-lg btn-block">{{$btnText}}</button>
<a class="btn btn-secondary btn-lg btn-block" href="{{route('materia.index',$materia)}}">Cancelar</a> 