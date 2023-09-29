@extends('templates.default')
@section('title','Edit Category')

@push('page-action')
<div class="d-print-none col-auto ms-auto">
	<div class="btn-list">
		<a href="{{ route('admin.category.index') }}" class="btn btn-primary d-none d-sm-inline-block">
			<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
			   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
			   <path d="M15 6l-6 6l6 6"></path>
			</svg>
			Back to category
		</a>
	</div>
</div>
@endPush

@section('content')
<div class="card">
	<form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<div class="card-body">
			<div class="mb-3">
				<label class="form-label">Category Name</label>
				<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" 
				placeholder="Category Name" value="{{ old('name', $category->category_name) }}">	
				@error('name')
				<span class="invalid-feedback">{{ $message }}</span>
				@enderror
			</div>
		</div>
		<div class="card-footer">
			<button type='submit' class="btn btn-primary ms-auto">
				Save Changes
			</button>
		</div>
	</form>
</div>
@endSection()