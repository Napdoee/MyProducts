@extends('templates.default')
@section('title','Update Student')

@push('page-action')
<div class="d-print-none col-auto ms-auto">
	<div class="btn-list">
		<a href="{{ route('student.index') }}" class="btn btn-primary d-none d-sm-inline-block">
			<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
			   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
			   <path d="M15 6l-6 6l6 6"></path>
			</svg>
			Back to Students
		</a>
	</div>
</div>
@endPush

@section('content')
<div class="card">
	<form action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<!-- <input type="hidden" name="induk" value="{{ $student->induk }}"> -->
		<div class="card-body">
			<div class="mb-3">
						<label class="form-label">Nama Siswa</label>
						<input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" 
						placeholder="Nama Siswa" value="{{ old('nama', $student->nama) }}">	
						@error('nama')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>	
			<div class="row">
				<div class="col-6">
					<div class="mb-3">
						<label class="form-label">Jenis Kelamin</label>
						<select class="form-select form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" autocomplete="off">
							<option value="">Pilih Jenis Kelamin</option>
							<option value="Laki-laki" {{ ($student->jenis_kelamin == 'Laki-laki') ? 'selected="selected"' : '' }}>Laki-laki</option>
							<option value="Perempuan" {{ ($student->jenis_kelamin == 'Perempuan') ?  'selected="selected"' : '' }}>Perempuan</option>
						</select>
						@error('jenis_kelamin')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>	
				</div>
				<div class="col-6">
					<div class="mb-3">
						<label class="form-label">Tanggal Lahir</label>
						<input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir"
							placeholder="student tgl_lahir" value="{{ old('tgl_lahir', $student->tgl_lahir) }}">
						@error('tgl_lahir')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>	
				</div>
			</div>
			<div class="mb-3">
				<label class="form-label">Alamat</label>
				<input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" 
				placeholder="Alamat" value="{{ old('alamat', $student->alamat) }}">	
				@error('alamat')
				<span class="invalid-feedback">{{ $message }}</span>
				@enderror
			</div>	
			<div class="row">
				<div class="col-6">
					<div class="mb-3">
						<label class="form-label">Nama Orang Tua/Wali</label>
						<input type="text" class="form-control @error('nama_orang_tua') is-invalid @enderror" name="nama_orang_tua" 
						placeholder="Nama Orang Tua" value="{{ old('nama_orang_tua', $student->nama_orang_tua) }}">	
						@error('nama_orang_tua')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>	
				</div>
				<div class="col-6">
					<div class="mb-3">
						<label class="form-label">No. HP Orang Tua</label>
						<input type="text" class="form-control @error('nomor_orang_tua') is-invalid @enderror" name="nomor_orang_tua" 
						placeholder="No. HP Orang Tua" value="{{ old('nomor_orang_tua', $student->nomor_orang_tua) }}">	
						@error('nomor_orang_tua')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>	
				</div>
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