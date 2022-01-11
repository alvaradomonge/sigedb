@section('titulo','Dashboard Admin - SIGEDB')

<div class="container">
	<div class="align-items-center">
		<h2 class="display-8 text-primary">Hola {{auth()->user()->name}}!</h2>
		
		<div>
			<h3 class="display-7 text-secondary">Clases Activas:</h3>
			<small>Acá se visualizarán las clases activas por perdiodo</small>
			
		</div>
		<div>
			<h3 class="display-7 text-secondary">Informes:</h3>	
			<ul>
				<li>Manejo de plantillas</li>
				<li>Envío de informes de notas</li>
			</ul>
		</div>
		<div>
			<h3 class="display-7 text-secondary">Asistencia:</h3>	
			<ul>
				<li>Informe de asistencia</li>
				<li>Gestión de incidencias</li>
			</ul>
		</div>
		<div>
			<h3 class="display-7 text-secondary">Conducta:</h3>
			<ul>
				<li>Informe de conducta</li>
				<li>Gestión de incidencias por sección</li>
			</ul>	
		</div>
		<div>
			<h3 class="display-7 text-secondary">Usuarios:</h3>
			<ul>
				<li>Gestionar usuarios</li>
			</ul>	
		</div>
		<div>
			<h3 class="display-7 text-secondary">Años y periodos lectivos:</h3>	
			<ul>
				<li>Gestión de años lectivos</li>
				<li>Gestión de peridos lectivos</li>
			</ul>
		</div>

	</div>
</div>