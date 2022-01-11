@extends ('plantilla')

@section('titulo','Inicio-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8">
				@guest
					<h1 class="display-6 text-primary">SIGEDB</h1>
					<h3 class="display-7 text-secondary">Sistema de Gestión de Expediente Digital </h3>
					<p class="lead text-secondary">
						Bienvenido a la plataforma de gestión de expediente digital académico, mediante el cual podrá controlar y reportar los registros de notas cuantitativos y cualitativos de la institución.
					</p>
				@endguest
				@auth
					@if (auth()->user()->id_rol_usuario == '1')
						@include('dashboards.adminDashboard')
					@elseif(auth()->user()->id_rol_usuario == '2')
						@include('dashboards.docenteDashboard')
					@elseif(auth()->user()->id_rol_usuario == '3')
						@include('dashboards.estudianteDashboard')
					@elseif(auth()->user()->id_rol_usuario == '4')
						@include('dashboards.coordinadorDashboard')
					@endif
				@endauth
				<br>
				<div class="">
					@guest
						<a class="btn btn-lg btn-primary mx-1" href="{{route('login')}}">Iniciar sesión</a>
					@endguest
					<a class="btn btn-lg btn-outline-primary mx-1" href="{{route('informenotas')}}">Contáctenos</a>					
				</div>
			</div>
			<div class="col-12 col-lg-4">
				<img class="img-fluid p-5 mb-3" src="/img/dev.svg" alt="Desarrollo">
			</div>
		</div>
	</div>
	
	
@endsection