@extends('templates.guest')
@section('title', "$product->name")

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
    	@if($product->getDiscountStatus())
    		<div class="ribbon bg-azure">{{ $product->discount->description }}</div>
    	@endif
		<div class="small mb-1">{{ $product->category->category_name }}</div>
		<h1 class="display-6 fw-bolder">{{ $product->name }}</h1>
		<div class="mb-3">
	        <span class="fw-bolder">${{ number_format($product->getPrice()) }}</span>
	        @if($product->getDiscountStatus())
	        <span class="text-decoration-line-through text-muted">${{ number_format($product->price) }}</span>
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
@endSection