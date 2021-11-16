@extends ('plantilla')

@section('titulo','Estudiantes-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-10 col-lg-6 mx-auto">				
				@include('estudiante.validation-errors')
				<form class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{route('estudiante.update',$estudiante)}}">
					<h2 class="display-8">Editar estudiante</h2> 
					<hr>
					@method('PATCH')
					@include('estudiante.form',['btnText'=>'Actualizar'])
					<br>
				</form>
			</div>
		</div>
	</div>
@endsection