@extends ('plantilla')

@section('titulo','Informe de Notas-SIGEDB')

@section ('contenido')
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-10 col-lg-6 mx-auto">
				
				@include('partials.session-status')
				<form class="bg-white shadow rounded py-3 px-4" method="POST" action="{{route('informenotas')}}">
					@csrf
					<h2 class="display-5">Contacto</h2>
					<hr>
					<div class="form-group">
						<label for="name">Nombre</label>
						<input id="name" class="form-control bg-light shadow-sm @error('name') is-invalid @else border-0 @enderror" name="name" placeholder="Nombre..." value="{{old('name')}}">
						@error('name')
							<span class="invalid-feedback" role=alert>
								<strong>{{$message}}</strong>
							</span>
						@enderror
						<br>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input id="email" class="form-control bg-light shadow-sm @error('email') is-invalid @else border-0 @enderror"  type="text" name="email" placeholder="Email..." value="{{old('email')}}">
						@error('email')
							<span class="invalid-feedback" role=alert>
								<strong>{{$message}}</strong>
							</span>
						@enderror
						<br>
					</div>
					<div class="form-group">
						<label for="subject">Asunto</label>
						<input id="subject" class="form-control bg-light shadow-sm @error('subject') is-invalid @else border-0 @enderror"  name="subject" placeholder="Asunto..." value="{{old('subject')}}">
						@error('subject')
							<span class="invalid-feedback" role=alert>
								<strong>{{$message}}</strong>
							</span>
						@enderror
						<br>
					</div>
					<div class="form-group">
						<label for="content">Mensaje</label>
						<textarea 
						class="form-control bg-light shadow-sm @error('content') is-invalid @else border-0 @enderror"  
						name="content" 
						id="content" 
						placeholder="Mensaje" 
						value="{{old('content')}}"
						>
						</textarea>
						@error('content')
							<span class="invalid-feedback" role=alert>
								<strong>{{$message}}</strong>
							</span>
						@enderror
					</div>
					<br>
					<button class="btn btn-primary btn-lg btn-block">@lang('Send')</button>
				</form>
			</div>
		</div>
	</div>
@endsection
