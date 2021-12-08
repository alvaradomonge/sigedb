@extends ('plantilla')

@section('titulo','Gestion de Grupos y Materias')

@section ('contenido')
	<div class="container">
		<div class="">
			<h2 class="display-8 mb-0">Periodos activos </h2>
				
			<h2 class="display-8 mb-0">Herramientas</h2>
			<ul>
				<li>Estado de Periodo</li>
				<li> <a href="{{route('materia.index')}}"> Administrar Materias </a></li>
				<li><a href="#">Asignación de estudiantes a grupos</a></li>
				<li> <a href="{{route('grupo_guia.index')}}">Mantenimiento de Gupos guías</li>
			</ul>
		</div>
	</div>
@endsection