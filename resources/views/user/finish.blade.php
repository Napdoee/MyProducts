@extends('templates.guest')
@section('title', 'Finish')

@push('page-action')
	<div class="d-print-none col-auto ms-auto">
		<ol class="breadcrumb breadcrumb-arrows">
		  <li class="breadcrumb-item disabled"><a href="{{ route('cart.index') }}">Cart</a></li>
		  <li class="breadcrumb-item disabled"><a href="{{ route('checkout') }}">Checkout</a></li>
		  <li class="breadcrumb-item active"><a href="#">Finish</a></li>
		</ol>
	</div>
@endPush

@section('content')
	<div class="row row-cards justify-content-center">
		<div class="col-12 col-md-6">
        <div class="card bg-primary-lt">
            <div class="card-header">
                <div class="row text-center">
                  <div class="card-title h2 text-success">Succesfully orders items</div>
                  <div class="card-text text-muted">Thank you very much for doing business with us. We look forward to see you again!</div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="card-text text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                               <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                            </svg> {{ $orderDetail->name }}
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <div class="card-text text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                               <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
                            </svg> {{ $orderDetail->address }}
                        </div>
                    </div>
                </div>
                <div class="accordion">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-1">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true">
                        Summary Cart
                      </button>
                    </h2>
                    <div id="collapse-1" class="accordion-collapse collapse">
                      <div class="accordion-body pt-0">
                        <table class="table table-transparent table-responsive">
                            <tbody>
                                @foreach($orderDetail->items as $item)
                                <tr>
                                    <td>
                                        <a class="strong mb-1 text-primary" href="#">{{ "(".$item->quantity."x) ".$item->product->name}}</a>
                                    </td>
                                    <td class="text-end">Rp. {{ number_format($item->product->getPrice()) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td class="font-weight-bold text-end">DUE TOTAL</td>
                                    <td class="font-weight-bold text-end">Rp. {{ number_format($orderDetail->total_price) }}</td>
                                </tr>
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-primary" href="{{ route('home') }}">Go Home</a>
                <a class="btn btn-outline-primary float-end" href="{{ route('order.show') }}">See Order List</a>
            </div>
        </div>
		</div>
	</div>
@endSection