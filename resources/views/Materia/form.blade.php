@csrf 
<div class="form-group">
	<label for="nombre">
		Nombre{!!$errors->first('nombre','(*)')!!}
	</label>
	<br>
	<input id="nombre" class="form-control border-0 bg-light shadow-sm" type="text" name="nombre" value="{{old('nombre',$materia->nombre)}}">
</div>
<div class="form-group">
	<label for="EsGuia">
		Es guía {!!$errors->first('es_guia','(*)')!!}
	</label>
	<br>
	<input id="EsGuia" class="form-control border-0 bg-light shadow-sm" type="text" name="es_guia" value="{{old('es_guia',$materia->es_guia)}}">
</div>

<br>
<button class="btn btn-primary btn-lg btn-block">{{$btnText}}</button>
<a class="btn btn-secondary btn-lg btn-block" href="{{route('materia.index',$materia)}}">Cancelar</a> 