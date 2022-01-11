@extends ('plantilla')
@section('titulo','Materia-SIGEDB')
@section('css')
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>
			$(document).ready(function(){
			fetch_data();
			function fetch_data()
				{
				  $.ajax({
				   url:"{{route('livetable/fetch_data',[$materia,$asignacion])}}",
				   dataType:"json",
				   success:function(data)
				   {
				    var html = '';
				    for(var count=0; count < data.length; count++)
				    {
				     html +='<tr>';
				     html +='<td class="column_name fw-bold" data-column_name="name" data-id="'+data[count].name+'">'+data[count].apellido1+' '+data[count].apellido2+' '+data[count].name+'</td>';
				     html += '<td contenteditable class="column_name text-center" data-column_name="nota" data-estudiante_name="'+data[count].apellido1+' '+data[count].apellido2+' '+data[count].name+'" data-id_estud="'+data[count].id_estud+'" data-id="'+data[count].nota+'">'+data[count].nota+'</td>';
				    }
				    $('tbody').html(html);
				   }
				  });
				}
				var _token = $('input[name="_token"]').val();
				$(document).on('blur', '.column_name', function(){
					  var column_name = $(this).data("id");
					  var column_value = $(this).text();
					  var valor_porcentual = {{$asignacion->valor_porcentual}};
					  var estudiante_name = $(this).data("estudiante_name");
					  var id_asig = {{$asignacion->id}};
					  var id_materia = {{$materia->id}};
					  var id_estud = $(this).data("id_estud");
					  
					  if(column_value != '')
					  {
					   $.ajax({
					    url:"{{ route('livetable.update_data') }}",
					    method:"POST",
					    data:{column_name:column_name,estudiante_name:estudiante_name, valor_porcentual:valor_porcentual, column_value:column_value, id_asig:id_asig, id_materia:id_materia, id_estud:id_estud,_token:_token},
					    success:function(data)
					    {
					     $('#message').html(data);
					    }
					   })
					  }
					  else
					  {
					   $('#message').html("<div class='alert alert-danger'> "+estudiante_name+": Favor no dejar espacio de calificación en blanco</div>");
					  }
				});
					 
			});
		</script>
@endsection
@section ('contenido')
	<div class="container">
		<div class="d-flex justify-content-between">
			<h2 class="display-8 mb-0">{{$materia->grupo_guia->nombre}} {{$materia->nombre}}: Calificación de {{$asignacion->nombre}} ({{$asignacion->valor_porcentual}}%) </h2>	
		</div>
		<hr><div id="message"></div>
		<div class="row">
			<div class="col-md-3">
				
			</div>
			<div class="d-flex table-responsive col-md-5 justify-content-between">
				@include('partials.validation-errors')
				<table class="table table-striped table-sm table-hover">
					<thead>
						<tr class="align-middle text-center text-nowrap  border border-secondary">
							<th scope="col" class="border border-secondary" >Nombre</th>
							<th scope="col" class="border border-secondary">Calificación</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
				@csrf
			</div>
			<div class="col-md-3">
				
			</div>
		</div>
		<div class="d-flex align-items-center">
			<a class="btn btn-success" href="{{route('materia.notas',$materia)}}">Regresar</a>
			@auth 
				{{-- <button class="btn btn-primary btn-lg btn-block">Actualizar</button>
				<a class="btn btn-primary" href="">Guardar Cambios</a>	 --}}
			@endauth
		</form>
		</div>
	</div>
@endsection
@section('script')

@endsection