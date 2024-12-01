<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>{{ $title }}</title>
	@include('layout.link')
</head>
<body>
	@include('admin.menu_admin')
	
	<div class="container mt-5">
		<h1 class="title-admin">Danh sách đơn hàng trả lại</h1>
	</div>

	<div class="container-fluid mt-5">
		<form action="{{ route('return-order.index') }}" method="GET" class="row mt-3">
			<div class="col-3">
				<input type="text" name="code" placeholder="Mã đơn hàng trả lại" class="form-control w-100">
			</div>
			<div class="col-2">
				<button class="btn btn-success w-75">Tìm kiếm</button>
			</div>
			<div class="col-7 text-right">
				<a class="btn btn-success text-white" href="{{ route('return-order.create') }}">+ Tạo đơn hàng trả lại</a>
			</div>
		</form>
		<table class="table table-bordered table-striped mt-3 mb-5">
			<tr class="text-center">
				<th>STT</th>
				<th>Mã đơn hàng trả lại</th>
				<th>Mã đơn hàng</th>
				<th>Mã khách hàng</th>
				<th>Tên khách hàng</th>
				<th>Nhân viên tạo đơn</th>
				<th>Tổng tiền (VNĐ)</th>
				<th>Trạng thái</th>
				<th>Lý do</th>
				<th>Ngày tạo</th>
				<th>Thao tác</th>
			</tr>
			<?php $stt = 1; ?>
			@foreach ($return_orders as $return_order)
			<tr>
				<td class="text-center">{{ $stt++ }}</td>
				<td class="text-center">
					<a href="{{ route('return-order.show', $return_order->id) }}" class="text-primary">{{ $return_order->code }}</a>
				</td>
				<td>
					<a href="{{ route('return-order.show', $return_order->id) }}" class="text-primary">{{ $return_order->order->code }}</a>
				</td>
				<td>{{ $return_order->customer->code }}</td>
				<td>{{ $return_order->customer->name }}</td>
				<td>{{ $return_order->user->name }}</td>
				<td class="text-center">{{ number_format($return_order->total_money) }}</td>
				<td>
					@if ($return_order->status == 1)
						Hoàn thành
					@endif
				</td>
				<td>{{ $return_order->reason }}</td>
				<td class="text-center">{{ date_format($return_order->created_at, 'd/m/Y') }}</td>
				<td class="text-center">
					<a href="{{ route('return-order.edit', $return_order->id) }}" class="btn btn-warning text-white">Sửa</a>
					
					@if ($return_order->status != 0 && $return_order->status != 4)
						<form action="{{ route('return-order.destroy', $return_order->id) }}" method="POST" class="d-inline">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">Xóa</button>
						</form>
					@endif
				</td>
			</tr>
			@endforeach
		</table>
		<div class="text-center">
			{{ $return_orders->appends(['code' => $request->code])->links()}}
		</div>
	</div>

	@include('layout.script')
</body>
</html>