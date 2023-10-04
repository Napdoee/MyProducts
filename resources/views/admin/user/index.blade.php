@extends('templates.default')
@section('title', 'Users')

@section('content')
<div class="card">
	<div class="table-responsive">
		<table class="table table-vcenter card-table pt-3">
			<thead>
				<tr>
					<th>Username</th>
					<th>Email (verified ?)</th>
					<th>Roles</th>
					<th width="17%"></th>
				</tr>
			</thead>
			<tbody>
			@foreach($users as $row)
			<tr>
				<td>{{ $row->name }}</td>
				<td><span class="{{ ($row->email_verified_at) ? 'text-success' : 'text-danger' }}">
					{{ $row->email }}
				</span></td>
				<td>{{ strtoupper($row->roles) }}</td>
				<td class="flex justify-center items-center">
					<a class="btn btn-info d-inline-block" href="{{ route('admin.user.edit', $row->id) }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon m-0 icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
						   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
						   <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
						   <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
						   <path d="M16 5l3 3"></path>
						</svg>
					</a>
					<form action="{{ route('admin.user.destroy', $row->id) }}" method="POST" class="d-inline-block">
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
@endSection()