@extends('templates.default')
@section('title', 'Orders')

@section('content')
<div class="card">
	<div class="table-responsive">
		<table class="table table-vcenter card-table pt-3">
			<thead>
				<tr>
					<th width="6%">#</th>
					<th>Account</th>
					<th>Name</th>
					<th width="20%">Address</th>
					<th>Order Date</th>
					<th>Due Total</th>
					<th>Status</th>
					<th width="17%"></th>
				</tr>
			</thead>
			<tbody>
			@forelse($orders as $row)
			<tr>
				<td>{{ $row->id}}</td>
				<td>{{ $row->user->name }}</td>
				<td>{{ $row->name }}</td>
				<td>{{ $row->address }}</td>
				<td>{{ $row->order_date }}</td>
				<td>Rp. {{ number_format($row->total_price) }}</td>
				<td>
					<span class="badge @if($row->status === 'pending') bg-azure-lt
					@elseif($row->status === 'progress') bg-orange-lt
					@else bg-teal-lt @endif p-2">
						{{ Str::upper($row->status) }}
					</span>
				</td>
				<td align="center">
					<div class="d-flex gap-2">
						<a class="btn btn-outline-info" href="{{ route('admin.order.edit', $row->id) }}" title="Show Order Detail" data-bs-toggle="tooltip">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon m-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							   <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
							   <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
							</svg>
						</a>
						<div class="dropdown">
							<button class="btn btn-outline dropdown-toggle align-text-top" data-bs-toggle="dropdown">
								Status
							</button>
							<div class="dropdown-menu dropdown-menu-end">
								<form action="{{ route('admin.order.update', $row->id) }}" method="POST">
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
					</div>
				</td>
			</tr>
			@empty
			<tr>
				<td colspan="100" align="center">No records found</td>
			<tr>
			@endforelse
			</tbody>
		</table>
	</div>
</div>
@endSection()