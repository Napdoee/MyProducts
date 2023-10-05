@extends('templates.guest')
@section('title', 'Your Cart')

@if(!$listCart->isEmpty())
	@push('page-action')
	<div class="d-print-none col-auto ms-auto">
    <ol class="breadcrumb breadcrumb-arrows">
      <li class="breadcrumb-item active"><a href="{{ route('cart.index') }}">Cart</a></li>
      <li class="breadcrumb-item disabled"><a href="{{ route('checkout') }}">Checkout</a></li>
      <li class="breadcrumb-item disabled"><a href="#">Finish</a></li>
    </ol>
	</div>
	@endPush
@endif

@section('content')
	<div class="row row-cards g-0">
		@if($listCart->isEmpty())
			<div class="empty">
				<p class="empty-title">You don't have any items in cart</p>
				<p class="empty-subtitle text-muted">
				  Try add some products to your cart
				</p>
				<div class="empty-action">
					<a href="{{ route('product') }}" class="btn btn-primary">
				    Going to products
					</a>
				</div>
			</div>
		@else
		<div class="col-md-8">
			@php $subTotal = 0; $tax = 0; @endphp
			@foreach($listCart as $row)
			<div class="card m-0">
			  <div class="row g-0">
			    <div class="col-auto">
			      <div class="card-body">
			        <div class="avatar avatar-md" style="background-image: url( {{ asset('storage/images/'.$row->product->image)  }})"></div>
			      </div>
			    </div>
			    <div class="col">
			      <div class="card-body px-0">
			        <div class="row">
			          <div class="col">
			            <h3 class="mb-0">
			            	<a href="{{ route('product.details', $row->product->slug) }}">{{ $row->product->name }}</a>
			            	 @if(Session::get('productName') === $row->product->name && $errors->has('quantity')) 
			            		<small class="h5 text-danger d-block">* {{ $errors->first('quantity') }}</small>
			            	@endif
			            </h3>
			            <small class="text-muted">
			            	<span class="text-uppercase">{{ $row->product->category->category_name }}</span>
			            	(In Stock: {{ $row->product->stock }})
			            </small>
			          </div>
			          <div class="col-auto fs-3 text-green"><span class="text-muted">(x{{ $row->quantity }})</span> ${{ number_format($row->total) }}</div>
			        </div>
			        <div class="row">
			          <div class="col-md">
			            <div class="mt-3 list-inline list-inline-dots mb-0 text-muted d-sm-block d-none">
			              <div class="list-inline-item"><!-- Download SVG icon from http://tabler-icons.io/i/license -->
			              		<span class="fw-bolder">${{ number_format($row->product->getPrice()) }}</span>
			              		@if($row->product->getDiscountStatus())
		        							<span class="text-azure fw-bolder">({{ $row->product->discount->discount_percent }}% OFF)</span>
		        						@endif
			              </div>
			            </div>
			            <div class="mt-3 list mb-0 text-muted d-block d-sm-none">
			              <div class="list-inline-item"><!-- Download SVG icon from http://tabler-icons.io/i/license -->
			              		<span class="fw-bolder">${{ number_format($row->product->getPrice()) }}</span>
			              		@if($row->product->getDiscountStatus())
		        						<span class="text-azure fw-bolder">({{ $row->product->discount->discount_percent }}% OFF)</span>
		        						@endif
			              </div>
			            </div>
			          </div>
			          <div class="col-md-auto">
						<form class="d-flex mt-4 mt-md-0" method="POST" action="{{ route('cart.update', $row->id) }}" autocomplete="off">
							@method('PUT')
							@csrf
							<div>
								<input type="hidden" name="product_id" value="{{ $row->product->id }}">
							    <input class="form-control me-3 text-azure 
							    @if(Session::get('productName') === $row->product->name ) border border-red text-red @enderror" 
							    id="quantity" name="quantity" type="number" min="1" value="{{ old('quantity', $row->quantity) }}" style="max-width: 5rem" />
							</div>
						    <button class="btn btn-outline-primary" type="submit">
								<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
								   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
								   <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
								   <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
								   <path d="M16 5l3 3"></path>
								</svg>
								Edit
						    </button>
						</form>	
			          </div>
			        </div>
			      </div>
			    </div>
			    <div class="col-auto align-self-center w-auto">
			    	<div class="card-body p-0 mx-5">
						<form action="{{ route('cart.destroy', $row->id) }}" method="POST" class="d-inline-block">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger p-3 btn-icon" type="submit">
								<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
								   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
								   <path d="M4 7l16 0"></path>
								   <path d="M10 11l0 6"></path>
								   <path d="M14 11l0 6"></path>
								   <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
								   <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
								</svg>
					    	</button>
						</form>
			      	</div>
			    </div>
			  </div>
			</div>
			@php $subTotal += $row->total; $tax += 500 @endphp
			@endforeach
		</div>
		<div class="col-md-4">
			<div class="card sticky-top bg-primary-lt">
				<div class="card-header">
					<div class="card-title">Summary</div>
				</div>
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<p>Subtotal</p>
						<p>${{ number_format($row->itemsPrice()) }}</p>
					</div>
					<div class="d-flex justify-content-between">
						<p>Estimated Tax</p>
						<p>${{ number_format($row->getTax()) }}</p>
					</div>
					<hr class="my-3" />
					<div class="d-flex justify-content-between m-0">
						<p>GrandTotal</p>
						<p>${{ number_format($row->totalItemsPrice()) }}</p>
					</div>
					<hr class="mt-0 mb-4" />
					<!-- <button class="btn btn-primary w-100" type="submit">Checkout</button> -->
					<a class="btn btn-primary w-100" href="{{ route('checkout') }}">Checkout</a>
				</div>
			</div>
		</div>
		@endif
	</div>
@endSection