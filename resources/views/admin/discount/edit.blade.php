@extends('templates.default')
@section('title','Edit Discount')

@push('page-action')
<div class="d-print-none col-auto ms-auto">
	<div class="btn-list">
		<a href="{{ route('admin.discount.index') }}" class="btn btn-primary d-none d-sm-inline-block">
			<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
			   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
			   <path d="M15 6l-6 6l6 6"></path>
			</svg>
			Back to discount
		</a>
	</div>
</div>
@endPush

@section('content')
<div class="card">
	<form action="{{ route('admin.discount.update', $discount->id) }}" method="POST" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<div class="card-body">
			<div class="mb-3">
				<label class="form-label">Discount Percent</label>
				<input type="number" class="form-control @error('discount_percent') is-invalid @enderror" name="discount_percent" placeholder="Discount Percent" value="{{ old('discount_percent', $discount->discount_percent) }}">	
				@error('discount_percent')
				<span class="invalid-feedback">{{ $message }}</span>
				@enderror
			</div>
			<div class="mb-3">
				<label class="form-label">Description</label>
				<input type="text" class="form-control @error('description') is-invalid @enderror" name="description" 
				placeholder="Description" value="{{ old('description', $discount->description) }}">	
				@error('description')
				<span class="invalid-feedback">{{ $message }}</span>
				@enderror
			</div>
			<div class="mb-3">
				<label class="form-label">Status</label>
				<select class="form-select @error('status') is-invalid @enderror" name="status">
					<option value="">Select Status</option>
					<option value="1" 
						@if(old('status') != '')
							{{ ($discount->active == old('status')) ? "selected" : "" }}
						@else
							{{ ($discount->active === 1) ? "selected" : "" }}
						@endif
					>Actived</option>
					<option value="0" 
						@if(old('status') != '')
							{{ ($discount->active == old('status')) ? "selected" : "" }}
						@else
							{{ ($discount->active === 0) ? "selected" : "" }}
						@endif
					>Deactived</option>
				</select>
				@error('status')
				<span class="invalid-feedback">{{ $message }}</span>
				@enderror
			</div>
		</div>
		<div class="card-footer">
			<button type='submit' class="btn btn-primary ms-auto">
				Save Changes
			</button>
		</div>
	</form>
</div>
@endSection()