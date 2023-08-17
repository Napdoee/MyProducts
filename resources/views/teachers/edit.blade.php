@extends('templates.default')
@section('title','Update Teacher')

@push('page-action')
<div class="d-print-none col-auto ms-auto">
	<div class="btn-list">
		<a href="{{ route('teacher.index') }}" class="btn btn-primary d-none d-sm-inline-block">
			<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
			   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
			   <path d="M15 6l-6 6l6 6"></path>
			</svg>
			Back to Teachers
		</a>
	</div>
</div>
@endPush

@section('content')
<div class="card">
	<form action="{{ route('teacher.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<!-- <input type="hidden" name="induk" value="{{ $teacher->induk }}"> -->
		<div class="card-body">
			<div class="row">
				<div class="col-md-5">
					<div class="mb-3">
						<label class="form-label">Nama Guru</label>
						<input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" 
						placeholder="Masukkan nama guru" value="{{ old('nama', $teacher->nama) }}">	
						@error('nama')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>	
				</div>
				<div class="col-md-4">
					<div class="mb-3">
						<label class="form-label">No. HP</label>
						<input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp"
							placeholder="Masukkan nomor telp" value="{{ old('no_telp', $teacher->no_telp) }}">
						@error('no_telp')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>	
				</div>
				<div class="col-md-3">
					<div class="mb-3">
						<label class="form-label">Tanggal Lahir</label>
						<input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir"
							placeholder="teacher tgl_lahir" value="{{ old('tgl_lahir', $teacher->tgl_lahir) }}">
						@error('tgl_lahir')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>	
				</div>
			</div>
			<div class="mb-3">
				<label class="form-label">Alamat</label>
				<input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" 
				placeholder="Alamat" value="{{ old('alamat', $teacher->alamat) }}">	
				@error('alamat')
				<span class="invalid-feedback">{{ $message }}</span>
				@enderror
			</div>
		</div>
		<div class="card-footer">
			<button type='submit' class="btn btn-primary ms-auto">
				Save changes
			</button>
		</div>
	</form>
</div>
@endSection()