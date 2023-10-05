@extends('templates.guest')
@section('title', 'Products')

@section('content')
<div class="row row-cards">
	<div class="col-12">
		<form action="{{ route('product') }}" method="GET" autocomplete="off" novalidate>
			
	      	<div class="input-icon mb-2">
	        	<span class="input-icon-addon">
	          	<!-- Download SVG icon from http://tabler-icons.io/i/search -->
	          	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
	        	</span>
	        	<input type="text" name="q" value="{{ old('q', $search) }}" class="form-control" placeholder="Search…" aria-label="Search Products">
	      	</div>
	      	<div class="d-flex justify-content-between">
		 		<div class="form-selectgroup">
		 			<label class="form-selectgroup-item">
			            <input type="radio" name="category" value="" class="form-selectgroup-input" checked>
		    	        <span class="form-selectgroup-label">ALL</span>
		          	</label>
		          	@foreach($categories as $category)
		          	<label class="form-selectgroup-item">
			            <input type="radio" name="category" value="{{ $category->category_name }}" class="form-selectgroup-input" 
			            {{ $categoryName == $category->category_name ? 'checked' : '' }}>
		    	        <span class="form-selectgroup-label">{{ Str::upper($category->category_name) }}</span>
		          	</label>
		          	@endforeach
		        </div>
		        <button class="btn bg-primary-lt" type="submit">SEARCH</button>
	      	</div>
	    </form>
	</div>
	@if($search != '' || $category != '')
		<h1 class="display-6 fw-bolder">{{ ($category != '' && !$search != '') ? 'Products' : 'Results for: '.$search }}</h1>
		@forelse($products as $row)
		    <div class="col-6 col-md-4 col-lg-3">
		        <div class="card">
		          <!-- Photo -->
		          <div class="img-responsive img-responsive-16x9 card-img-top position-relative" 
		          style="background-image: url({{ asset('storage/images/'.$row->image) }}); background-size:cover;">
		          @if($row->stock <= 0)
		          	<div class="w-100 p-2 text-center bg-red-lt position-absolute top-50 fw-bolder">OUT OF STOCK</div>
		          @endif
		          </div>
		          <!-- <img class="card-img img-thumbnail" src="{{ asset('storage/images/'.$row->image) }}" /> -->
		          <div class="card-body">
		            @if($row->getDiscountStatus())
		                <div class="ribbon bg-red">{{ $row->discount->description." -".$row->discount->discount_percent."%" }}</div>
		            @endif
		            <p class="text-muted my-1">{{ $row->category->category_name }}</p>
		            <div class="d-flex justify-content-between align-items-center">
		                <h3 class="card-title my-3">{{ Str::of($row->name)->limit(15) }}</h3>
		                <p class="card-text">${{ number_format($row->getPrice()) }}</p>
		            </div>
		            <a href="{{ route('product.details', $row->slug) }}" class="btn btn-primary w-100 mb-2">Show Detail</a>
		            <form class="d-flex mt-1" method="POST" action="{{ route('cart.store') }}" autocomplete="off">
		              @csrf
		              <div>
		                  <input type="hidden" name="product_id" value="{{ $row->id }}">
		                  <input id="quantity" name="quantity" type="hidden" min="1" value="1"/>
		              </div>
		                <button class="btn btn-outline-primary w-100 @if($row->stock <= 0) disabled @endif" type="submit">
		                    <i class="bi-cart-fill me-1"></i>
		                    Add to cart
		                </button>
		            </form> 
		          </div>
		        </div>
		    </div>
		@empty
			<div class="empty">
				<div class="empty-img"><img src="{{ asset('static/undraw_printing_invoices_5r4r.svg') }}" height="128" alt="">
				</div>
				<p class="empty-title">No results found</p>
				<p class="empty-subtitle text-muted">
				  Try adjusting your search or filter to find what you're looking for.
				</p>
				<div class="empty-action">
					<a href="{{ route('product') }}" class="btn btn-primary">
				    Go back to products
					</a>
				</div>
			</div>
		@endforelse
	@endif
</div>
@endSection