@extends('templates.guest')
@section('title', "$product->name")

@php
    $discountInStatus = ($product->discount_id && $product->discount->active === 1);
@endphp

@section('content')
<div class="card mb-3">
  <div class="row g-0">
    <div class="col-12 col-md-5 p-4 position-relative">
      	<img src="{{ asset('storage/images/'.$product->image) }} " class="rounded-start" alt="{{ $product->name }}"
      	style="width:100%; max-height:70vh; object-fit:contain;">
        @if($product->stock <= 0)
        	<div class="w-100 p-2 text-center bg-red-lt position-absolute top-50 start-0 h2">OUT OF STOCK</div>
        @endif
    </div>
    <div class="card-status-start bg-primary"></div>
    <div class="col-12 col-md-7 rounded p-4 bg-primary-lt">
    	@if($discountInStatus)
    		<div class="ribbon bg-azure">{{ $product->discount->description }}</div>
    	@endif
		<div class="small mb-1">{{ $product->category->category_name }}</div>
		<h1 class="display-6 fw-bolder">{{ $product->name }}</h1>
		<div class="mb-3">
	        <span class="fw-bolder">Rp. {{ number_format($product->getPrice()) }}</span>
	        @if($discountInStatus)
	        <span class="text-decoration-line-through text-muted">Rp. {{ number_format($product->price) }}</span>
	        <span class="text-azure fw-bolder">({{ $product->discount->discount_percent }}% OFF)</span>
	        @endif
	    </div>
		<p class="card-text">{!! $product->description !!}</p>
		<small class="text-muted mt-5">In Stock: {{ $product->stock }}
				@error('quantity')
			   <span class="text-red">* {{ $message }}</span>
			  @enderror
		</small>
		@if($product->stock > 0)
		<form class="d-flex mt-1" method="POST" action="{{ route('cart.store') }}" autocomplete="off">
			@csrf
			<div>
					<input type="hidden" name="product_id" value="{{ $product->id }}">
			    <input class="form-control me-3 text-azure @error('quantity') border border-red text-red @enderror" id="quantity" name="quantity" 
			    type="number" min="1" value="{{ old('quantity', 1) }}" style="max-width: 4rem" />
			</div>
	    <button class="btn btn-outline-primary flex-shrink-0" type="submit">
	        <i class="bi-cart-fill me-1"></i>
	        Add to cart
	    </button>
		</form>	
		@endif
    </div>
  </div>
</div>
<!-- <div class="card min-md-vh-75"> 	
	<div class="row gx-4 gx-lg-5">
		<div class="col-md-5">
			<div class="card-body">
				<img class="card-img-top mb-5 mb-md-0" src="{{ asset('storage/images/'.$product->image) }}" alt="{{ $product->name }}" 
				style="object-fit: contain;  max-height: 70vh;" />
			</div>
		</div>
		<div class="col-md-7">
			<div class="card-body">
			
			    <div class="mb-5">
			        <span class="fw-bolder">Rp. {{ number_format($product->price) }}</span>
			        <span class="text-decoration-line-through text-muted">Rp. {{ number_format($product->price) }}</span>
			    </div>
			    <p class="lead">
			    	{!! $product->description !!}
			    </p>
				<div class="d-flex position-relative bottom-0 start-0">
				    <input class="form-control text-center me-3 order border-primary text-primary" id="inputQuantity" 
				    type="num" value="1" style="max-width: 3rem" />
				    <button class="btn btn-outline-primary flex-shrink-0" type="button">
				        <i class="bi-cart-fill me-1"></i>
				        Add to cart
				    </button>
				</div>	
			</div>
		</div>
	</div>
</div> -->
@endSection