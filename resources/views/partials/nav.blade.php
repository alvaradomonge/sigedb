<nav class="navbar navbar-light navbar-expand-lg bg-white shadow-sm">
	<div class="container-fluid">
		<a class="navbar-brand" href="{{route('inicio')}}">{{config('app.name')}}</a>
		<button class="navbar-toggler" 
			type="button" 
			data-toggle="collapse" 
			data-target="#navbarSupportedContent" 
			aria-controls="navbarSupportedContent" 
			aria-expanded="false" 
			aria-label="{{ __('Toggle navigation') }}">
	        <span class="navbar-toggler-icon"></span>
	    </button>
	    
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="nav nav-pills">
				<li class="nav-item ">
					<a class="nav-link {{setActive('inicio')}}" 
					href="{{route('inicio')}}">Inicio</a>
				</li>
				@auth
					@if (auth()->user()->id_rol_usuario == '1')
						@include('partials/navAdmin')
					@elseif(auth()->user()->id_rol_usuario == '2')
						@include('partials/navDocente')
					@elseif(auth()->user()->id_rol_usuario == '3')
						@include('partials/navEstudiante')
					@elseif(auth()->user()->id_rol_usuario == '4')
						@include('partials/navCoordinador')
					@endif
				@endauth
				@guest
					<li class="nav-item">
						<a class="nav-link {{setActive('informenotas')}}" href="{{route('informenotas')}}"
					>Contacto</a>
					</li>
					<li class="nav-item"><a class="nav-link {{setActive('login')}}" href="{{route('login')}}">Login</a></li>
				@else
					<li class="nav-item">
						<a class="nav-link" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
							Cerrar Sesión
						</a>
					</li>
				@endguest
				
			</ul>
		@auth
			<div class="d-flex me-2 btn btn-light">
				{{auth()->user()->name}}
				@if(auth()->user()->id_rol_usuario == '1')
					<small >(Administrador)</small>
				@elseif(auth()->user()->id_rol_usuario == '2')
					<small>(Docente)</small>
				@elseif(auth()->user()->id_rol_usuario == '3')
					<small>(Estudiante)</small>
				@elseif(auth()->user()->id_rol_usuario == '4')
					<small >(Coordinador)</small>
				@endif	
			</div>
		@endauth
	</div>
</nav>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
	@csrf

</form>