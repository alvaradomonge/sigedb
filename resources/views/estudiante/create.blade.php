@extends ('plantilla')

@section('titulo','Estudiantes-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-10 col-lg-6 mx-auto">				
				@include('partials.session-status')
				@if($errors->any())
					@include('estudiante.validation-errors')
				@endif
				<form class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{route('estudiante.store')}}">
					<h2 class="display-8">Nuevo estudiante</h2>
					<hr>
					@include('estudiante.form' ,['btnText'=>'Crear'])
				</form>
			</div>
		</div>
	</div>
@endsection