@extends('templates.default')
@section('title','Edit User')

@push('page-action')
<div class="d-print-none col-auto ms-auto">
	<div class="btn-list">
		<a href="{{ route('admin.user.index') }}" class="btn btn-primary d-none d-sm-inline-block">
			<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
			   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
			   <path d="M15 6l-6 6l6 6"></path>
			</svg>
			Back to User
		</a>
	</div>
</div>
@endPush

@section('content')
<div class="card">
	<form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<div class="card-body">
			<div class="mb-3">
				<label class="form-label">Userame</label>
				<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" 
				placeholder="Name" value="{{ old('name', $user->name) }}">	
				@error('name')
				<span class="invalid-feedback">{{ $message }}</span>
				@enderror
			</div>
			<div class="mb-3">
                <label class="form-label">Email address</label>
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" autocomplete="email" placeholder="Enter email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Roles</label>
                <select id="roles" type="email" class="form-select @error('roles') is-invalid @enderror" name="roles">
                	<option value="">Select Roles</option>
                	<option {{ ($user->roles == 'user') ? "selected" : "" }} value="user">USER</option>
                	<option {{ ($user->roles == 'admin') ? "selected" : "" }} value="admin">ADMIN</option>
                </select>
                @error('roles')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
		</div>
		<div class="card-footer">
			<button type='submit' class="btn btn-primary ms-auto">
				Save Changes
			</button>
			<button type="button" class="btn btn-outline-primary ms-auto @error('password') btn-outline-danger @enderror" data-bs-toggle="modal" data-bs-target="#modal-small">
				Change Password
			</button>
		</div>
	</form>
</div>

<div class="modal modal-blur fade" id="modal-small" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
        <form method="post" action="{{ route('admin.user.password', $user->id) }}">
        	@method('PATCH')
            @csrf
            <div class="modal-body">
                <div class="modal-title">Change Password</div>
                <div class="mb-4">Be carefully, process will changes {{ $user->name."'s" }} password</div>
                <div class="mb-4">
                    <div class="form-label">Password</div>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <div class="form-label">Confirm Password</div>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="password_confirmation">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Confirm Changes</button>
            </div>
      </form>
    </div>
  </div>
</div>
@endSection()