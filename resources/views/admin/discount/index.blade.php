@extends('templates.default')
@section('title', 'Discount')

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
			Create new discount
		</a>
	</div>
</div>
@endPush

@section('content')
	@if($errors->any())
		<div class="alert alert-important alert-warning alert-dismissible" role="alert">
			<b>an error occured while create a discount</b>
			@foreach($errors->all() as $error)
				<li class="mx-1">{{ $error }}</li>
			@endforeach
			<a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
		</div>
	@endif
	 <div class="card">
		<div class="table-responsive">
			<table class="table table-vcenter card-table pt-3">
				<thead>
					<tr>
						<th>Discount Percent</th>
						<th>Description</th>
						<th>Status</th>
						<th width="17%"></th>
					</tr>
				</thead>
				<tbody>
				@foreach($discounts as $row)
				<tr>
					<td >{{ $row->discount_percent }}</td>
					<td >{{ $row->description }}</td>
					<td >{{ $row->active ? 'Actived' : 'Deactived' }}</td>
					<td class="flex justify-center items-center">
						<a class="btn btn-info d-inline-block" href="{{ route('admin.discount.edit', $row->id) }}">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon m-0 icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							   <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
							   <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
							   <path d="M16 5l3 3"></path>
							</svg>
						</a>
						<form action="{{ route('admin.discount.destroy', $row->id) }}" method="POST" class="d-inline-block">
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
                    <h5 class="modal-title">New discount</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
				<form action="{{ route('admin.discount.store') }}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label">Discount Percent</label>
							<input type="number" class="form-control @error('discount_percent') is-invalid @enderror" name="discount_percent" placeholder="Discount Percent" value="{{ old('discount_percent') }}">	
							@error('discount_percent')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label">Description</label>
							<input type="text" class="form-control @error('description') is-invalid @enderror" name="description" 
							placeholder="Description" value="{{ old('description') }}">	
							@error('description')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label">Status</label>
							<select class="form-select @error('status') is-invalid @enderror" name="status">
								<option value="">Select Status</option>
								<option value="1">Actived</option>
								<option value="0">Deactived</option>
							</select>
							@error('status')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-link link-secondary" data-bs-dismiss="modal">
							Cancel
						</button>
						<button type='submit' class="btn btn-primary ms-auto">
							Add Discount
						</button>
					</div>
				</form>
            </div>
        </div>
    </div>
@endSection()