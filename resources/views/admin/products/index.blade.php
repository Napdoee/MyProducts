@extends('templates.default')
@section('title', 'Product')

@push('page-action')
<div class="d-print-none col-auto ms-auto">
	<div class="btn-list">
		<a href="#" class="btn btn-primary d-none d-sm-inline-block"
			data-bs-toggle="modal" data-bs-target="#modal-report">
			<!-- Download SVG icon from http://tabler-icons.io/i/plus -->
			<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
				viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
				stroke-linecap="round" stroke-linejoin="round">
				<path stroke="none" d="M0 0h24v24H0z" fill="none" />
				<path d="M12 5l0 14" />
				<path d="M5 12l14 0" />
			</svg>
			Create new product
		</a>
	</div>
</div>
@endPush

@section('content')
	@if($errors->any())
		<div class="alert alert-important alert-warning alert-dismissible" role="alert">
			<b>an error occured while create a product</b>
			@foreach($errors->all() as $error)
				<li class="mx-1">{{ $error }}</li>
			@endforeach
			<a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
		</div>
	@endif
	 <div class="card">
		<div class="table-responsive">
			<table class="table table-vcenter card-table pt-3" id="example">
				<thead>
					<tr>
						<th width="20%">Image</th>
						<th>Product Name</th>
						<th>Price Per Item</th>
						<th>Stock</th>
						<th>Discount</th>
						<th width="17%"></th>
					</tr>
				</thead>
				<tbody>
				@foreach($products as $row)
				<tr @if($row->stock <= 0) class="bg-danger-lt" @endif>
					<td class="align-middle">
						@if($row->image)
							<img class="avatar avatar-xl object-fit-contain" src="{{ asset('storage/images/'.$row->image) }}">
						@else
							<span>No image found</span>
						@endif
					</td>
					<td >{{ $row->name }}</td>
					<td >Rp. {{ number_format($row->price)  }}</td>
					<td>{{ $row->stock }}</td>
					<td >
						@if($row->discount_id && $row->discount->active === 1)
							{{ '(' . $row->discount->discount_percent . '%) Rp. '
							.number_format((100/100 - $row->discount->discount_percent/100) * $row->price) }}
						@else
							{{ 'No Discount' }}
						@endif
					</td>
					<td class="flex justify-center items-center">
						<a class="btn btn-info d-inline-block" href="{{ route('admin.product.edit', $row->slug) }}">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon m-0 icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							   <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
							   <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
							   <path d="M16 5l3 3"></path>
							</svg>
						</a>
						<form action="{{ route('admin.product.destroy', $row->slug) }}" method="POST" class="d-inline-block">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-danger" >
								<svg xmlns="http://www.w3.org/2000/svg" class="icon m-0 icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
								   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
								   <path d="M4 7l16 0"></path>
								   <path d="M10 11l0 6"></path>
								   <path d="M14 11l0 6"></path>
								   <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
								   <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
								</svg>
							</button>
						</form>
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	  </div>
	  
	    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
				<form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label">Product Name</label>
							<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" 
							placeholder="Product Name" value="{{ old('name') }}">	
							@error('name')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label">Description</label>
							<!-- <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" 
							placeholder="Description" value="{{ old('description') }}">	 -->
							<textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description"  id="tinymce-mytextarea">{{ old('description') }}</textarea>
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
										<option value="{{ $category->id }}" {{ ($category->id == old('category')) ? "selected" : ""}}>
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
										<option value="{{ $discount->id }}" {{ ($discount->id == old('discount')) ? "selected" : ""}}>
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
									<input type="text" type-currency="IDR" class="form-control @error('price') is-invalid @enderror" name="price"
										placeholder="Product Price" value="{{ old('price') }}">
									@error('price')
									<span class="invalid-feedback">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="mb-3">
									<label class="form-label">Stock Items</label>
									<input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" 
									placeholder="Stock" value="{{ old('stock') }}">	
									@error('stock')
									<span class="invalid-feedback">{{ $message }}</span>
									@enderror
								</div>
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Product Image</label>
							<input type="file" class="form-control @error('img') is-invalid @enderror" name="img"
								placeholder="Product Image" value="{{ old('img') }}">
							@error('img')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-link link-secondary" data-bs-dismiss="modal">
							Cancel
						</button>
						<button type='submit' class="btn btn-primary ms-auto">
							Add Product
						</button>
					</div>
				</form>
            </div>
        </div>
    </div>
@endSection()