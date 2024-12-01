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
		@if(session('notificationAdd'))
			<span class="alert alert-success mt-2 d-block text-center" role="alert">{{ session('notificationAdd') }}</span>
		@endif
		@if($errors->has('title') || $errors->has('summary') || $errors->has('img') || $errors->has('content'))
			<span class="alert alert-danger mt-2 d-block text-center" role="alert">Thêm sách thất bại!</span>
		@endif
		@if($errors->has('titleupdate') || $errors->has('summaryupdate') || $errors->has('imgupdate') || $errors->has('contentupdate'))
			<span class="alert alert-danger mt-2 d-block text-center" role="alert">Sửa sách thất bại!</span>
		@endif
		
		<h1 class="title-admin">Danh sách đặt hàng</h1>
	</div>

	<div class="container-fluid mt-5">
		<form action="{{ route('orders.index') }}" method="GET" class="row mt-3">
			<div class="col-3">
				<input type="text" name="code" placeholder="Mã đơn đặt hàng" class="form-control w-100">
			</div>
			<div class="col-2">
				<button class="btn btn-success w-75">Tìm kiếm</button>
			</div>
		</form>
		<table class="table table-bordered table-striped mt-3 mb-5">
			<tr class="text-center">
				<th>STT</th>
				<th>Mã đơn đặt hàng</th>
				<th>Mã khách hàng</th>
				<th>Tên khách hàng</th>
				<th>Trạng thái</th>
				<th>Phương thức thanh toán</th>
				<th>Tổng tiền (VNĐ)</th>
				<th>Ngày đặt hàng</th>
				<th>Thao tác</th>
			</tr>
			<?php $stt = 1; ?>
			@foreach ($orders as $order)
			<tr>
				<td class="text-center">{{ $stt++ }}</td>
				<td class="text-center">
					<a href="{{ route('orders.show', $order->id) }}" class="text-primary">{{ $order->code }}</a>
				</td>
				<td>{{ $order->customer->code }}</td>
				<td>{{ $order->customer->name }}</td>
				<td>
					@if ($order->status == 1)
						Đặt hàng
					@elseif ($order->status == 2)
						Duyệt
					@elseif ($order->status == 3)
						Đang vận chuyển
					@elseif ($order->status == 4)
						Hoàn thành
					@elseif ($order->status == 0)
						Hủy đơn
					@endif
				</td>
				<td>
					@if ($order->payment_method == 1)
						Thanh toán khi nhận hàng
					@elseif ($order->payment_method == 2)
						Thanh toán khi mua hàng
					@elseif ($order->payment_method == 3)
						Thanh toán Paypal
					@endif
				</td>
				<td class="text-center">{{ number_format($order->total_money) }}</td>
				<td class="text-center">{{ date_format($order->created_at, 'd/m/Y') }}</td>
				<td class="text-center">
					@if ($order->status == 1)
						<form action="{{ route('orders.change-status-order', $order->id) }}" method="POST" class="d-inline">
							@csrf
							<button type="submit" class="btn btn-primary">Duyệt</button>
						</form>
						<a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning text-white">Sửa</a>
					@elseif ($order->status == 2)
						<form action="{{ route('orders.change-status-order', $order->id) }}" method="POST" class="d-inline">
							@csrf
							<button type="submit" class="btn btn-warning text-white">Giao hàng</button>
						</form>
					@elseif ($order->status == 3)
						<form action="{{ route('orders.change-status-order', $order->id) }}" method="POST" class="d-inline">
							@csrf
							<button type="submit" class="btn btn-success">Hoàn thành</button>
						</form>
					@endif
					
					@if ($order->status != 0 && $order->status != 4)
						<form action="{{ route('orders.cancel-order', $order->id) }}" method="POST" class="d-inline">
							@csrf
							<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn?')">Hủy đơn</button>
						</form>
					@endif
				</td>
			</tr>
			@endforeach
		</table>
		<div class="text-center">
			{{ $orders->appends(['code' => $request->code])->links()}}
		</div>
	</div>

	@include('layout.script')
</body>
</html>