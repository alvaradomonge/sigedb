<select name="id_anio" class="form-control">
	@forelse ($grupo_guia->estudiantes as $estudiante_Item)
		<option value="{{$estudiante_Item->id}}">
			{{$estudiante_Item->name}}
		</option>
	@empty
		<option>
			Agregue primero un estudiante
		</option>
	@endforelse
</select>