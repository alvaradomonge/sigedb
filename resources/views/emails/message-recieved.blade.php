<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SIGEDB-Informe de notas</title>
	</head>
	<body>
		<p>Recibiste un mensaje de : {{$msg['name']}} - {{$msg['email']}}</p>
		<p><strong>Asunto: </strong>{{$msg['subject']}}</p>
		<p><strong>Mensaje: </strong>{{$msg['content']}}</p>
	</body>
</html>
