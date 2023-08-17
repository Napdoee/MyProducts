@extends('templates.default')
@section('title','Edit Product')

@push('page-action')
<div class="d-print-none col-auto ms-auto">
	<div class="btn-list">
		<a href="{{ route('product.index') }}" class="btn btn-primary d-none d-sm-inline-block">
			<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
			   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
			   <path d="M15 6l-6 6l6 6"></path>
			</svg>
			Back to product
		</a>
	</div>
</div>
@endPush

@section('content')
<div class="card">
	<form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<div class="card-body">
			<div class="mb-3">
				<label class="form-label">Product Name</label>
				<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Product Name" value="{{ old('name', $product->name ) }}">
				@error('name')
					<span class="invalid-feedback">{{ $message }}</span>
				@enderror
			</div>
			<div class="mb-3">
				<label class="form-label">Price</label>
				<input type="text" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Product Price" value="{{  old('price', $product->price)  }}">
				@error('price')
					<span class="invalid-feedback">{{ $message }}</span>
				@enderror
			</div>
			<div class="mb-3">
				<div class="row">
					<div class="col-auto d-flex align-items-center">
						@if($product->image)
							<img class="avatar avatar-md" src="{{ asset('storage/images/'.$product->image) }}"  alt="{{ $product->name }} Image" />
						@else
							<span class="center">No image found</span>
						@endif
					</div>
					<div class="col">
						<div class="mb-3">
							<label class="form-label">Product Image</label>
							<input type="file" class="form-control @error('image') is-invalid @enderror" name="image" placeholder="Product Image" value="{{ old('image') }}">
							@error('image')
								<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
					</div>
				</div>
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