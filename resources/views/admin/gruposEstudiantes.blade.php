@extends ('plantilla')

@section('titulo','Datos de la materia')

@section ('contenido')
	<div class="container">
		<div class="bg-white p-4 shadow rounded">
			<h2 class="display-8">Estudiantes de {{$grupo_guia->nombre}}</h2>
			<ul class="list-group">
				@forelse ($grupo_guia->estudiantes as $estudiante_Item)
					<li class="list-group-item border-0 mb-2 shadow-sm" value="{{$estudiante_Item->id}}">
						<a class="li_element text-secondary d-flex justify-content-between text-decoration-none" href="#">
							<span class="font-weight-bold">
								{{$estudiante_Item->name}} {{$estudiante_Item->apellido1}} {{$estudiante_Item->apellido2}} 
							</span>
							<span class="text-black-50">
								{{$estudiante_Item->email}}
							</span>
						</a>
					</li>
				@empty
					<li class="list-group-item border-0 mb-2 shadow-sm" >
						Agregue primero un estudiante
					</li>
				@endforelse
			</ul>
			<div class="d-flex justify-content-between align-items-center">
				<a class="btn btn-primary" href="{{route('periodo.show',$grupo_guia->periodo)}}">Regresar</a>
			</div>
		</div>
	</div>
@endsection