@csrf 
<div class="form-group">
	<label for="nombre">
		Nombre{!!$errors->first('nombre','(*)')!!}
	</label>
	<br>
	<input id="nombre" class="form-control border-0 bg-light shadow-sm" type="text" name="nombre" value="{{old('nombre',$estudiante->nombre)}}">
</div>
<div class="form-group">
	<label for="apellido1">
		Primer Apellido {!!$errors->first('apellido1','(*)')!!}
	</label>
	<br>
	<input id="apellido1" class="form-control border-0 bg-light shadow-sm" type="text" name="apellido1" value="{{old('apellido1',$estudiante->apellido1)}}">
</div>
<div class="form-group">
	<label for="apellido2">
		Segundo Apellido {!!$errors->first('apellido2','(*)')!!}
	</label>
	<br>
	<input id="apellido2" class="form-control border-0 bg-light shadow-sm" type="text" name="apellido2" value="{{old('apellido2',$estudiante->apellido2)}}">
</div>
<div class="form-group">
	<label for="email">
		Email{!!$errors->first('email','(*)')!!}
	</label>
	<br>
	<input id="email" class="form-control border-0 bg-light shadow-sm" type="text" name="email" value="{{old('email',$estudiante->email)}}">
</div>
<div class="form-group">
	<label for="cedula">
		Cédula
	</label>
	<br>
	<input id="cedula" class="form-control border-0 bg-light shadow-sm" type="text" name="cedula" value="{{old('cedula',$estudiante->cedula)}}">
</div>
<div class="form-group">
	<label for="telefono">
		Teléfono
	</label>
	<br>
	<input id="telefono" class="form-control border-0 bg-light shadow-sm" type="text" name="telefono" value="{{old('telefono',$estudiante->telefono)}}">
</div>
<div class="form-group">
	<label for="direccion">
		Dirección
	</label>
	<br>
	<textarea id="direccion" class="form-control border-0 bg-light shadow-sm" name="direccion" >{{old('direccion',$estudiante->direccion)}}
	</textarea>
</div>
<br>
<button class="btn btn-primary btn-lg btn-block">{{$btnText}}</button>
<a class="btn btn-secondary btn-lg btn-block" href="{{route('estudiante.index',$estudiante)}}">Cancelar</a> 