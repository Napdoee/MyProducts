@if(session('message'))
	<div class="alert alert-important bg-{{ session('status') }}-lt alert-dismissible" role="alert">
		{{ session('message') }}
		<a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
	</div>
@endif