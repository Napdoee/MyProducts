@extends('templates.default')
@section('title', 'Student')

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
			Create new student
		</a>
	</div>
</div>
@endPush

@section('content')
	@if($errors->any())
		<div class="alert alert-important alert-warning alert-dismissible" role="alert">
			<b>an error occured while create a student</b>
			{{-- @foreach($errors->all() as $error)
				<li class="mx-1">{{ $error }}</li>
			@endforeach --}}
			<a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
		</div>
	@endif
	<div class="card">
		<!-- <div class="card-body"> -->
			<div class="table-responsive">
				<table class="table table-vcenter card-table pt-3" id="example">
					<thead>
						<tr>
							<th width="5%">#</th>
							<th>No. Induk</th>
							<th>Nama</th>
							<th>Jenis Kelamin</th>
							<th>Tgl. Lahir</th>
							<th>Alamat</th>
							<th>Orang Tua/Wali</th>
							<th>No. HP Orang Tua</th>
							<th width="17%"></th>
						</tr>
					</thead>
					<tbody>
					@foreach($students as $row)
					<tr>
						<td class="align-middle">{{ $loop->index+1 }}</td>
						<td >{{ $row->induk }}</td>
						<td >{{ $row->nama }}</td>
						<td >{{ $row->jenis_kelamin }}</td>
						<td >{{ $row->tgl_lahir }}</td>
						<td >{{ $row->alamat }}</td>
						<td >{{ $row->nama_orang_tua }}</td>
						<td >{{ $row->nomor_orang_tua }}</td>
						<td class="btn-list">
							<a class="btn btn-info" href="{{ route('student.edit', $row->id) }}">
								<svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
								   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
								   <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
								   <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
								   <path d="M16 5l3 3"></path>
								</svg>
							</a>
							<form action="{{ route('student.destroy', $row->id) }}" method="POST" class="d-inline-block">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger text-center" >
									<svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
		<!-- </div> -->
	 </div>
	  
	    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
				<form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="modal-body">
						<div class="row">
							<div class="col-md-5">
								<div class="mb-3">
									<label class="form-label">Nama Siswa</label>
									<input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" 
									placeholder="Nama Siswa" value="{{ old('nama') }}">	
									@error('nama')
									<span class="invalid-feedback">{{ $message }}</span>
									@enderror
								</div>	
							</div>
							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Jenis Kelamin</label>
									<select class="form-select form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
										<option value="">Pilih Jenis Kelamin</option>
										<option value="Laki-laki">Laki-laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>
									@error('jenis_kelamin')
									<span class="invalid-feedback">{{ $message }}</span>
									@enderror
								</div>	
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Tanggal Lahir</label>
									<input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir"
										placeholder="student tgl_lahir" value="{{ old('tgl_lahir') }}">
									@error('tgl_lahir')
									<span class="invalid-feedback">{{ $message }}</span>
									@enderror
								</div>	
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Alamat</label>
							<input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" 
							placeholder="Alamat" value="{{ old('alamat') }}">	
							@error('alamat')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>	
						<div class="row">
							<div class="col-6">
								<div class="mb-3">
									<label class="form-label">Nama Orang Tua/Wali</label>
									<input type="text" class="form-control @error('nama_orang_tua') is-invalid @enderror" name="nama_orang_tua" 
									placeholder="Nama Orang Tua" value="{{ old('nama_orang_tua') }}">	
									@error('nama_orang_tua')
									<span class="invalid-feedback">{{ $message }}</span>
									@enderror
								</div>	
							</div>
							<div class="col-6">
								<div class="mb-3">
									<label class="form-label">No. HP Orang Tua</label>
									<input type="text" class="form-control @error('nomor_orang_tua') is-invalid @enderror" name="nomor_orang_tua" 
									placeholder="No. HP Orang Tua" value="{{ old('nomor_orang_tua') }}">	
									@error('nomor_orang_tua')
									<span class="invalid-feedback">{{ $message }}</span>
									@enderror
								</div>	
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-link link-secondary" data-bs-dismiss="modal">
							Cancel
						</button>
						<button type='submit' class="btn btn-primary ms-auto">
							Add Student
						</button>
					</div>
				</form>
            </div>
        </div>
    </div>
@endSection()
