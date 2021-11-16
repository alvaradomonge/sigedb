@extends ('plantilla')

@section('titulo','Libro de notas -SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-6">
				<h1 class="display-8 text-primary">Libro de notas</h1>
				<p class="lead text-secondary">
					lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum 
				</p>
				<a class="btn btn-lg btn-primary" href="{{route('informenotas')}}">Contáctenos</a>
				<a class="btn btn-lg btn-outline-primary" href="{{route('estudiante.index')}}">Gestor de estudiantes</a>
			</div>
			<div class="col-12 col-lg-6">
				<img class="img-fluid mb-3" src="/img/notes.svg" alt="Trabajo">
			</div>
		</div>
	</div>
@endsection
