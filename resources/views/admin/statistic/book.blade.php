<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Thống kê sách</title>
	@include('layout.link')
</head>
<body>
	@include('admin.menu_admin')
	
	<div class="container mt-5">
		<h1 class="title-admin">Thống kê sách</h1>
	</div>

	<div class="container-fluid mt-5">
		<form action="{{ route('book-statistic') }}" method="GET" class="row mt-3">
			<div class="col-3">
				<input type="text" name="name" placeholder="Tên sách" class="form-control w-100">
			</div>
			<div class="col-3">
				<select class="form-control w-100" name="amount">
					<option value=""></option>
					<option value="Còn hàng">Còn hàng</option>
					<option value="Hết hàng">Hết hàng</option>
				</select>
			</div>
			<div class="col-2">
				<button class="btn btn-success w-75">Tìm kiếm</button>
			</div>
		</form>
		<table class="table table-bordered table-striped mt-3 mb-5">
			<tr class="text-center">
				<th>STT</th>
				<th>Mã sách</th>
				<th>Tên sách</th>
				<th>Tồn kho</th>
				<th>Giá trị tồn kho</th>
			</tr>
			<tr>
				<td colspan="3" class="text-center">
					Tổng {{ $books->count() }} sản phẩm
				</td>
				<td class="text-center">{{ $books->sum('amount') }}</td>
				<td class="text-center">{{ $books->sum('inventory_value') }}</td>
			</tr>
			<?php $stt = 1; ?>
			@foreach ($books as $book)
			<tr>
				<td class="text-center">{{ $stt++ }}</td>
				<td>{{ $book->code }}</td>
				<td>{{ $book->name }}</td>
				<td class="text-center">{{ $book->amount }}</td>
				<td class="text-center">{{ $book->inventory_value }}</td>
			</tr>
			@endforeach
		</table>
		<div class="text-center">
			{{ $books->appends([
				'name' => $request->name,
				'amount' => $request->amount,
			])->links()}}
		</div>
	</div>

	@include('layout.script')
</body>
</html>