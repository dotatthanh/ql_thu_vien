<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Nhà cung cấp</title>
	@include('layout.link')
</head>
<body>
	@include('admin.menu_admin')
	
	<div class="container mt-5">

		<h1 class="title-admin">Danh sách nhà cung cấp</h1>
		
		<a href="{{ route('suppliers.create') }}" class="btn btn-success">Thêm nhà cung cấp</a>

		<form action="{{ route('suppliers.index') }}" method="GET" class="row mt-3">
			<div class="col-3">
				<input type="text" name="key" value="{{ request()->key }}" placeholder="Tên nhà cung cấp" class="form-control w-100">
			</div>
			<div class="col-2">
				<button type="submit" class="btn btn-success w-75 add-test">Tìm kiếm</button>
			</div>
		</form>

		<table class="table table-bordered table-striped mt-3 table-responsive">
			<tr class="text-center">
				<th>STT</th>
				<th>Mã nhà cung cấp</th>
				<th>Tên nhà cung cấp</th>
				<th>Số điện thoại</th>
				<th>Email</th>
				<th>Địa chỉ</th>
				<th>Thao tác</th>
			</tr>
			<?php $stt = 1; ?>
			@foreach ($suppliers as $supplier)
			<tr>
				<td class="text-center align-middle">{{ $stt++ }}</td>
				<td class="align-middle">{{ $supplier->code }}</td>
				<td class="align-middle">{{ $supplier->name }}</td>
				<td class="align-middle">{{ $supplier->phone }}</td>
				<td class="align-middle">{{ $supplier->email }}</td>
				<td class="align-middle">{{ $supplier->address }}</td>
				<td class="text-center">
					<a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning">Sửa</a>

					<form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
					</form>
				</td>
			</tr>
			@endforeach
		</table>
		<div class="text-center mb-5">
			{{ $suppliers->appends(['key' => $request->key])->links()  }}
		</div>
	</div>

	@include('layout.script')
</body>
</html>