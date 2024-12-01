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
		<h1 class="title-admin">Chi tiết đơn nhập hàng</h1>
	</div>

	<div class="container-fluid mt-5">
		<a class="btn btn-success text-white" href="{{ route('warehouses.index') }}">Danh sách nhập hàng</a>


		<table class="table table-bordered table-striped mt-3 mb-5">
			<tr class="text-center">
				<th>STT</th>
				<th>Mã đơn nhập hàng</th>
				<th>Nhân viên nhập</th>
				<th>Tên sách</th>
				<th>Nhà cung cấp</th>
				<th>Số lượng (Quyển)</th>
				<th>Giá (VNĐ)</th>
				<th>Thành tiền (VNĐ)</th>
			</tr>
			@php ($stt = 1)
			@foreach ($import_order_details as $import_order_detail)
			<tr>
				<td class="text-center">{{ $stt++ }}</td>
				<td class="text-center">{{ $import_order_detail->importOrder->code }}</td>
				<td>{{ $import_order_detail->importOrder->user->name }}</td>
				<td>{{ $import_order_detail->book->name }}</td>
				<td>{{ $import_order_detail->importOrder->supplier->name }}</td>
				<td class="text-center">{{ $import_order_detail->amount }}</td>
				<td class="text-center">{{ number_format($import_order_detail->price) }}</td>
				<td class="text-center">{{ number_format($import_order_detail->amount * $import_order_detail->price) }}</td>
			</tr>
			@endforeach
			<tr class="font-weight-bold">
				<td colspan="7" class="text-right">Tổng tiền</td>
				<td class="text-center">{{ number_format($import_order_detail->importOrder->total_money) }}</td>
			</tr>
		</table>
		<div class="text-center">
			{{ $import_order_details->links()}}
		</div>
	</div>

	@include('layout.script')
</body>
</html>