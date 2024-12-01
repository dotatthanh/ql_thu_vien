<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Chi tiết đơn hàng trả lại</title>
	@include('layout.link')
</head>
<body>
	@include('admin.menu_admin')
	
	<div class="container mt-5">
		<h1 class="title-admin">Chi tiết đơn hàng trả lại</h1>
	</div>

	<div class="container-fluid mt-5">
		<div class="row">
			<div class="col-3">
				<a class="btn btn-success text-white" href="{{ route('return-order.index') }}">Danh sách đơn hàng trả lại</a>
			</div>
		</div>

		<table class="table table-bordered table-striped mt-3 mb-5">
			<tr class="text-center">
				<th>STT</th>
				<th>Mã đơn đặt hàng</th>
				<th>Tên sách</th>
				<th>Số lượng (Quyển)</th>
				<th>Giá (VNĐ)</th>
				<th>Sale (%)</th>
				<th>Thành tiền (VNĐ)</th>
			</tr>
			@php ($stt = 1)
			@foreach ($return_order_details as $return_order_detail)
			<tr>
				<td class="text-center">{{ $stt++ }}</td>
				<td class="text-center">{{ $return_order_detail->returnOrder->code }}</td>
				<td>{{ $return_order_detail->book->name }}</td>
				<td class="text-center">{{ $return_order_detail->amount }}</td>
				<td class="text-center">{{ number_format($return_order_detail->price) }}</td>
				<td class="text-center">{{ $return_order_detail->sale }}</td>
				<td class="text-center">{{ number_format(($return_order_detail->amount * $return_order_detail->price) - ($return_order_detail->amount * $return_order_detail->price * $return_order_detail->sale / 100)) }}</td>
			</tr>
			@endforeach
			<tr class="font-weight-bold">
				<td colspan="6" class="text-right">Tổng tiền</td>
				<td class="text-center">{{ number_format($return_order_detail->returnOrder->total_money) }}</td>
			</tr>
		</table>
		<div class="text-center">
			{{ $return_order_details->links()}}
		</div>
	</div>

	@include('layout.script')
</body>
</html>