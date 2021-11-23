@extends ('plantilla')

@section('titulo','Materia-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-10 col-lg-6 mx-auto">				
				@include('materia.validation-errors')
				<form class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{route('materia.update',$materia)}}">
					<h2 class="display-8">Editar Materia</h2> 
					<hr>
					@method('PATCH')
					@include('materia.form',['btnText'=>'Actualizar'])
					<br>
				</form>
			</div>
		</div>
	</div>
@endsection