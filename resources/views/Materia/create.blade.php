@extends ('plantilla')

@section('titulo','Materia-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-10 col-lg-6 mx-auto">				
				@include('partials.session-status')
				@if($errors->any())
					@include('Materia.validation-errors')
				@endif
				<form class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{route('materia.store')}}">
					<h2 class="display-8">Nueva Materia</h2>
					<hr>
					@include('materia.form' ,['btnText'=>'Crear'])
				</form>
			</div>
		</div>
	</div>
@endsection