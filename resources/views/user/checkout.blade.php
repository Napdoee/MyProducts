@extends('templates.guest')
@section('title', 'Billing Details')

@push('page-action')
<div class="d-print-none col-auto ms-auto">
    <ol class="breadcrumb breadcrumb-arrows">
      <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Cart</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('checkout') }}">Checkout</a></li>
      <li class="breadcrumb-item disabled"><a href="#">Finish</a></li>
    </ol>
</div>
@endPush

@section('content')
	<div class="row g-0">
		<div class="col">
			<div class="card">
				<!-- <div class="card-header">
					<div class="card-title">II</div>
				</div> -->
				<div class="card-body">
					<div class="row g-5">
						<div class="col-md-7">
							<a href="{{ route('user.profile.edit') }}" class="btn btn-outline-primary float-end">
								<small>Edit</small>
							</a>
							<div class="card-title">User Information</div>
							<hr class="my-2" />
              <div class="mb-3">
              	<div class="form-label">Name</div>
                <input type="text" class="form-control" value="{{ $user->getFullName() }}" disabled>
              </div>
              <div class="mb-3">
              	<div class="form-label">Email</div>
                <input type="text" class="form-control" value="{{ $user->email }}" disabled>
              </div>
              <div class="mb-3">
              	<div class="form-label">Address 
              		@if(!$user->address != '')
              			<small class="text-danger mb-3">* Your address field is required!</small>
              		@endif
              	</div>
                <input type="text" class="form-control" value="{{ $user->address != '' ? $user->address : 'My Adresss' }}" disabled>
              </div>
							<div class="card-title">Payment</div>
							<hr class="my-2" />
							<div class="row">
								<div class="col">
                  <div class="mb-3">
                    <div class="form-label">Card number</div>
                    <input type="text" name="input-mask" class="form-control" data-mask="0000 0000 0000 0000" data-mask-visible="true" placeholder="0000 0000 0000 0000"autocomplete="off"/>
                  </div>	
								</div>	
								<div class="col">
									<div class="form-label">Card number</div>
									<div class="row g-2">
										<div class="col">
											<select class="form-select">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
										</div>
										<div class="col">
                      <select class="form-select">
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                      </select>
                    </div>
									</div>
								</div>	
							</div>
							<div class="row">
								<div class="col-8">
									<div class="mb-3">
                    <div class="form-label">Card name</div>
                    <input type="text" class="form-control">
                  </div>	
								</div>	
								<div class="col">
                  <div class="form-label">CVV</div>
                  <input type="number" class="form-control">
								</div>	
							</div>
							<hr class="my-2" />
							@if($user->address != '')
							<form class="{{ route('order.store') }}" method="POST">
								@csrf
								<button class="btn btn-primary w-100" type="submit">Place Orders</button>
							</form>
							@else
							<button class="btn btn-primary w-100 disabled">Place Order</button>
							@endif
						</div>
						<div class="col-md-5">
							<div class="card sticky-top bg-primary-lt">
								<div class="card-header">
									<div class="card-title">Cart Summary</div>
									<div class="card-actions">
                     <a href="{{ route('cart.index') }}" class="btn btn-outline-primary">
                        <small>Edit</small>
                      </a>
									</div>
								</div>
								<div class="card-body">
									<table class="table table-transparent table-responsive">
	                  <tbody>
	                  	@foreach($listCart as $row)
	                  	<tr>
	                  		<td>
	                  			<a class="strong mb-1 text-primary" href="{{ route('product.details', $row->product->slug) }}">{{ "(".$row->quantity."x) ".$row->product->name}}</a>
		                    </td>
		                    <td class="text-end">${{ number_format($row->total) }}</td>
		                </tr>
		                @endforeach
		                <tr>
		                    <td class="font-weight-bold text-end">Subtotal</td>
		                    <td class="font-weight-bold text-end">${{ number_format($row->itemsPrice()) }}</td>
		                </tr>
		                <tr>
		                    <td class="font-weight-bold text-end">Tax</td>
		                    <td class="font-weight-bold text-end">${{ number_format($row->getTax()) }}</td>
		                </tr>
		                <tr>
		                    <td class="font-weight-bold text-uppercase text-end">Total Due</td>
		                    <td class="font-weight-bold text-end">${{ number_format($row->totalItemsPrice()) }}</td>
		                </tr>
	                  </tbody>
	              	</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endSection