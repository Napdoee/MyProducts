@extends('templates.default')
@section('title','Edit Product')

@push('page-action')
<div class="d-print-none col-auto ms-auto">
	<div class="btn-list">
		<a href="{{ route('admin.product.index') }}" class="btn btn-primary d-none d-sm-inline-block">
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
	<form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<div class="card-body">
			<div class="mb-3">
				<label class="form-label">Product Name</label>
				<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" 
				placeholder="Product Name" value="{{ old('name', $product->name) }}">	
				@error('name')
				<span class="invalid-feedback">{{ $message }}</span>
				@enderror
			</div>
			<div class="mb-3">
				<label class="form-label">Description</label>
				<input type="text" class="form-control @error('description') is-invalid @enderror" name="description" 
				placeholder="Description" value="{{ old('description', $product->description) }}">	
				@error('description')
				<span class="invalid-feedback">{{ $message }}</span>
				@enderror
			</div>
			<div class="row">
				<div class="col-12 col-md-6">
					<div class="mb-3">
						<label class="form-label">Category</label>
						<select name="category" class="form-select @error('category') is-invalid @enderror" >
							<option value="">Choose Category</option>
							@foreach($categories as $category) 
							<option value="{{ $category->id }}" 
								@if(old('category') != '')
									{{ ($category->id == old('category')) ? "selected" : "" }}
								@else
									{{ ($product->category_id == $category->id) ? "selected" : "" }}
								@endif >
								{{ $category->category_name }}
							</option>
							@endforeach
						</select>
						@error('category')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="mb-3">
						<label class="form-label">Discount (optional)</label>
						<select name="discount" class="form-select @error('discount') is-invalid @enderror" >
							<option value="" selected>Choose Discount</option>
							@foreach($discounts as $discount) 
							<option value="{{ $discount->id }}" 
								@if(old('discount') != '')
									{{ ($discount->id == old('discount')) ? "selected" : "" }}
								@else
									{{ ($product->discount_id == $discount->id) ? "selected" : "" }}
								@endif >
								{{ $discount->discount_percent }} | {{ $discount->description }}
							</option>
							@endforeach
						</select>
						@error('discount')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-6">
					<div class="mb-3">
						<label class="form-label">Price</label>
						<input type="text" class="form-control @error('price') is-invalid @enderror" name="price"
							placeholder="Product Price" value="{{ old('price', $product->price) }}">
						@error('price')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="mb-3">
						<label class="form-label">Stock Items</label>
						<input type="text" class="form-control @error('stock') is-invalid @enderror" name="stock" 
						placeholder="Stock" value="{{ old('stock', $product->stock) }}">	
						@error('stock')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
				</div>
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
							<input type="file" class="form-control @error('img') is-invalid @enderror" name="img" placeholder="Product Image" value="{{ old('img') }}">
							@error('img')
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