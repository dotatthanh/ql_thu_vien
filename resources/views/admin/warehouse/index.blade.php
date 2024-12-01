<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sách</title>
	@include('layout.link')
</head>
<body>
	@include('admin.menu_admin')
	
	<div class="container mt-5">
		<h1 class="title-admin">Danh sách nhập hàng</h1>
	</div>

	<div class="container-fluid mt-5">
		<form action="{{ route('warehouses.index') }}" method="GET" class="row mt-3">
			<div class="col-3">
				<input type="text" name="code" placeholder="Mã đơn nhập hàng" class="form-control w-100">
			</div>
			<div class="col-2">
				<button class="btn btn-success w-75">Tìm kiếm</button>
			</div>
			<div class="col-7 text-right">
				<a class="btn btn-success text-white" href="{{ route('warehouses.create') }}">+ Tạo đơn nhập hàng</a>
			</div>
		</form>
		<table class="table table-bordered table-striped mt-3 mb-5">
			<tr class="text-center">
				<th>STT</th>
				<th>Mã đơn nhập hàng</th>
				<th>Nhà cung cấp</th>
				<th>Tổng tiền (VNĐ)</th>
				<th>Nhân viên nhập</th>
				<th>Ngày nhập</th>
			</tr>
			<?php $stt = 1; ?>
			@foreach ($warehouses as $warehouse)
			<tr>
				<td class="text-center">{{ $stt++ }}</td>
				<td class="text-center">
					<a href="{{ route('warehouses.show', $warehouse->id) }}" class="text-primary">{{ $warehouse->code }}</a>
				</td>
				<td>{{ $warehouse->supplier->name }}</td>
				<td class="text-center">{{ number_format($warehouse->total_money) }}</td>
				<td>{{ $warehouse->user->name }}</td>
				<td class="text-center">{{ date_format($warehouse->created_at, 'd/m/Y') }}</td>
			</tr>
			@endforeach
		</table>
		<div class="text-center">
			{{ $warehouses->appends(['code' => $request->code])->links()}}
		</div>
	</div>

	@include('layout.script')
</body>
</html>