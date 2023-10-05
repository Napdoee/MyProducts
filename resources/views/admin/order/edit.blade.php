@extends('templates.default')
@section('title','Confirm Orders')

@push('page-action')
<div class="d-print-none col-auto ms-auto">
	<div class="btn-list">
		<a href="{{ route('admin.order.index') }}" class="btn btn-primary d-none d-sm-inline-block">
			<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
			   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
			   <path d="M15 6l-6 6l6 6"></path>
			</svg>
			Back to orders
		</a>
	</div>
</div>
@endPush

@section('content')
<div class="card card-sm">
    <div class="card-header">
    	<div class="card-title">ORDERS #{{ $order->id }}</div>
    	<span class="ms-2 badge @if($order->status === 'pending') bg-azure-lt
    	@elseif($order->status === 'progress') bg-orange-lt
		@else bg-teal-lt @endif p-2">
			{{ Str::upper($order->status) }}
		</span>
    	<div class="card-actions">
    		<div class="d-flex gap-2">
				<div class="dropdown">
					<button class="btn btn-outline-primary dropdown-toggle align-text-top" data-bs-toggle="dropdown">
						Status
					</button>
					<div class="dropdown-menu dropdown-menu-end">
						<form action="{{ route('admin.order.update', $order->id) }}" method="POST">
							@method('PUT')
							@csrf
							<button type="submit" name="status" class="dropdown-item" value="pending" id="btn-status-1">
								<span class="badge bg-azure-lt">PENDING</span>
							</button>
							<button type="submit" name="status" class="dropdown-item" value="progress" id="btn-status-2">
								<span class="badge bg-orange-lt">PROGRESS</span>
							</button>
							<button type="submit" name="status" class="dropdown-item" value="complete" id="btn-status-3">
								<span class="badge bg-teal-lt">COMPLETE</span>
							</button>
						</form>
					</div>
				</div>
	            <a class="btn btn-outline-danger">
	            	Delete
	            </a>
    		</div>
    	</div>
    </div>
    <div class="card-body">
    	<div class="card-title">Base Info</div>
		<div class="datagrid">
	      <div class="datagrid-item">
	        <div class="datagrid-title">Username</div>
	        <div class="datagrid-content">{{ $order->name }}</div>
	      </div>
	      <div class="datagrid-item">
	        <div class="datagrid-title">Address</div>
	        <div class="datagrid-content">{{ $order->address }}</div>
	      </div>
	      <div class="datagrid-item">
	        <div class="datagrid-title">Order Date</div>
	        <div class="datagrid-content">{{ $order->order_date }}</div>
	      </div>
	      <div class="datagrid-item">
	        <div class="datagrid-title">Status</div>
	        <div class="datagrid-content">{{ $order->status }}</div>
	      </div>
	  	</div>
	  	<hr class="my-4" />
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
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <a class="strong mb-1 text-primary" href="#">{{ "(".$item->quantity."x) ".$item->product->name}}</a>
                            </td>
                            <td class="text-end">Rp. {{ number_format($item->sub_price) }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td class="font-weight-bold text-end">DUE TOTAL</td>
                            <td class="font-weight-bold text-end">Rp. {{ number_format($order->total_price) }}</td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endSection()