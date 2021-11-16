@if(session('status'))
	<div class="alert alert-primary alert-dismissible fade show" role="alert">
		{{session('status')}}
		<button 
		class="close" 
		type="button" 
		data-dismiss="alert" 
		aria-label="Close">
			<span aria-hidden="true">&times;</span>		
		</button>
	</div>
@endif