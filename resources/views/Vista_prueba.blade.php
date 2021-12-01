<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Prueba-SIGEDB</title>
</head>
<body>
	<div class="container mt-4">
		<div class="row justify-content-center">
			<div class="col-auto">
				<h3>materias---><span class="badge bg-secondary">{{$peri->nombre}}</span></h3>

				<table class="table table-striped table-hover">
					<thead class="bg-primary text-white">
						   <th> ID Mater</th>
						   <th> nombre </th>
						   <th> perido </th>
					</thead>
					<tbody>

						@foreach($peri->materias as $materiaItem)
							<tr>
								<td>{{$materiaItem->id}}</td>	
								<td>{{$materiaItem->nombre}}</td>
								<td>{{$materiaItem->periodo}}</td>
								<td>{{$peri->nombre}}</td>								
							</tr>
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>