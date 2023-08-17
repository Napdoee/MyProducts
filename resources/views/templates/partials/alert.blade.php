@if(session('message'))
	<div class="alert alert-important alert-{{ session('status') }} alert-dismissible" role="alert">
		{{ session('message') }}
		<a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
	</div>
@endif