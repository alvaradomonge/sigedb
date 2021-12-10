@extends ('plantilla')

@section('titulo','Datos de la materia')

@section ('contenido')
	<div class="container">
		<div class="bg-white p-4 shadow rounded">
			<h2 class="display-8">Datos de la materia</h2>
			<p class="text-black">Nombre de materia: {{$materia->nombre}}</p>
			<p class="text-black">Grupo: {{$materia->categoria->nombre}}</p>
			<p class="text-black">Grupo: {{$materia->grupos_guias->nombre}}</p>
			@if($materia->libro_notas->es_cualitativo==1)
				 <p class="text-black">Tipo de libro de notas: Cuantitativo</p>
			@else
				<p class="text-black">Tipo de libro de notas: Cualitativo</p>
			@endif
			<p class="text-black">Docente: {{$materia->docentes->name}} {{$materia->docentes->apellido1}} {{$materia->docentes->apellido2}}</p>
			<p class="text-black">Estado de materia: {{$materia->estados->nombre}}</p>		
			<div class="d-flex justify-content-between align-items-center">
				<a  class="btn btn-primary" href="{{route('materia.index')}}">Regresar</a>
				@auth 
					<div class="btn-group btn-group-sm">
						<a class="btn btn-primary" href="{{route('materia.edit',$materia)}}">Editar</a> 
						<a class="btn btn-danger" href="#" onclick="document.getElementById('delete-materia').submit()">Eliminar</a>
					</div>
					<form id="delete-materia" class="d-none" method="POST" action="{{route('materia.destroy',$materia)}}">
						@csrf @method('DELETE')
					</form>
					
				@endauth
			</div>
		</div>
@endsection