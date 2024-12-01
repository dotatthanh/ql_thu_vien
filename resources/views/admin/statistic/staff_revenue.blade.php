<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Thống kê doanh thu nhân viên</title>
	@include('layout.link')
</head>
<body>
	@include('admin.menu_admin')
	
	<div class="container mt-5">
		<h1 class="title-admin">Thống kê doanh thu nhân viên</h1>
	</div>

	<div class="container-fluid mt-5">
		<form action="{{ route('staff-revenue') }}" method="GET" class="row mt-3">
			<div class="col-3">
				<input type="text" name="name" placeholder="Tên nhân viên" class="form-control w-100">
			</div>
			<div class="col-2">
				<input type="date" name="from_date" class="form-control w-100">
			</div>
			<div class="col-2">
				<input type="date" name="to_date" class="form-control w-100">
			</div>
			<div class="col-2">
				<button class="btn btn-success w-75">Tìm kiếm</button>
			</div>
			<div class="col-12 text-right font-weight-bold">
				Doanh thu hệ thống: {{ number_format($revenue) }} VNĐ
			</div>
		</form>
		<table class="table table-bordered table-striped mt-3 mb-5">
			<tr class="text-center">
				<th>STT</th>
				<th>Tên nhân viên</th>
				<th>Email</th>
				<th>Số đơn bán hàng</th>
				<th>Tổng tiền đơn bán hàng (VNĐ)</th>
				<th>Số đơn trả hàng</th>
				<th>Tổng tiền đơn trả hàng (VNĐ)</th>
				<th>Doanh thu (VNĐ)</th>
			</tr>
			<?php $stt = 1; ?>
			@foreach ($users as $user)
			<tr>
				<td class="text-center">{{ $stt++ }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td class="text-center">{{ $user->total_sales_order }}</td>
				<td class="text-center">{{ number_format($user->total_sales_order_amount) }}</td>
				<td class="text-center">{{ $user->total_return_order }}</td>
				<td class="text-center">{{ number_format($user->total_return_order_amount) }}</td>
				<td class="text-center">{{ number_format($user->total_sales_order_amount - $user->total_return_order_amount) }}</td>
			</tr>
			@endforeach
		</table>
		<div class="text-center">
			{{ $users->appends([
				'name' => $request->name,
				'from_date' => $request->from_date,
				'to_date' => $request->to_date,
			])->links()}}
		</div>
	</div>

	@include('layout.script')
</body>
</html>