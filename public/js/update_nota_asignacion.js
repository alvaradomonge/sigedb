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
	     html +='<td class="column_name" data-column_name="name" data-id="'+data[count].name+'">'+data[count].apellido1+' '+data[count].apellido2+' '+data[count].name+'</td>';
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