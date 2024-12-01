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
		<h1 class="title-admin">Sửa đơn đặt hàng</h1>
	</div>

	<div class="container-fluid mt-5">
		<div class="row">
			<div class="col-3">
				<a class="btn btn-success text-white" href="{{ route('orders.index') }}">Danh sách đặt hàng</a>
			</div>
			<div class="col-9 font-weight-bold text-right">
				Địa chỉ: {{ $address }}
			</div>
		</div>

		<form method="POST" action="{{ route('orders.update', $order->id) }}">
			@csrf
			@method('PUT')
			<table class="table table-bordered table-striped mt-3">
				<tr class="text-center">
					<th>STT</th>
					<th width="350px">Tên sách</th>
					<th>Số lượng (Quyển)</th>
					<th>Giá (VNĐ)</th>
					<th>Khuyến mãi (%)</th>
					<th>Thành tiền (VNĐ)</th>
					<th class="minw-140">Thao tác</th>
				</tr>
				<?php $stt = 1; ?>
				@foreach ($order_details as $order_detail)
					<tr>
						<td class="text-center">{{ $stt++ }}</td>
						<td>
							<select name="book_id[{{ $stt-2 }}]" class="form-control select2" required onchange="setSalePrice($(this).val(), {{ $stt-2 }})">
								<option value=""></option>
								@foreach($books as $book)
								<option value="{{ $book->id }}" {{ $order_detail->book_id == $book->id ? 'selected' : '' }}>{{ $book->name }}</option>
								@endforeach
							</select>
						</td>
						<td class="text-center">
							<input type="number" name="amount[{{ $stt-2 }}]" class="form-control" min="1" onkeyup="totalMoney({{ $stt-2 }}); checkNumberBook({{ $stt-2 }}, $(this).val())" value="{{ $order_detail->amount }}" required>
						</td>
						<td class="text-center" id="price{{ $stt-2 }}">{{ $order_detail->price }}</td>
						<td class="text-center" id="sale{{ $stt-2 }}">{{ $order_detail->sale }}</td>
						<td class="text-center" id="totalMoney{{ $stt-2 }}">{{ ($order_detail->amount * $order_detail->price) - ($order_detail->amount * $order_detail->price * $order_detail->sale / 100) }}</td>
						<td class="text-center">
							<button type="button" class="btn btn-danger" onclick="removeRow($(this))">X</button>
						</td>
					</tr>
				@endforeach
				<tfoot>
					<tr>
						<td class="text-center">
							<button type="button" class="btn btn-success" onclick="addRow()">+</button>
						</td>
						<td colspan="4" class="font-weight-bold text-right">Tổng cộng</td>
						<td class="font-weight-bold text-center" id="total">{{ $order->total_money }}</td>
						<td></td>
					</tr>
				</tfoot>
			</table>
			<div class="text-center">
				<button type="submit" class="btn btn-success mt-2">Sửa đơn đặt hàng</button>
			</div>
		</form>
	</div>

	@include('layout.script')

	<script type="text/javascript">
		let stt = {{ $stt-2 }};
		function addRow() {
			stt++;
			let row = `
				<tr>
					<td class="text-center">${stt +1}</td>
					<td>
						<select name="book_id[${stt}]" class="form-control select2" required onchange="setSalePrice($(this).val(), ${stt})">
							<option value=""></option>
							@foreach($books as $book)
								<option value="{{ $book->id }}">{{ $book->name }}</option>
								@endforeach
						</select>
					</td>
					<td class="text-center">
						<input type="number" name="amount[${stt}]" class="form-control" min="1" onkeyup="totalMoney(${stt}); checkNumberBook(${stt}, $(this).val())" required>
					</td>
					<td class="text-center" id="price${stt}">0</td>
					<td class="text-center" id="sale${stt}">0</td>
					<td class="text-center" id="totalMoney${stt}">0</td>
					<td class="text-center">
						<button type="button" class="btn btn-danger" onclick="removeRow($(this))">X</button>
					</td>
				</tr>
			`;
			jQuery('tbody').append(row);
			
				$(".select2").select2({ 
				});
		}

		function removeRow(obj) {
			obj.closest('tr').remove();
			setTotal();
		}

		function setSalePrice(id, stt) {
            $.ajax({
                url: "/admin/books/" + id,
                method: 'GET',
                data: {
                    id: id,
                },
                success: function (respon) {
                    $(`#sale${stt}`).text(respon.sale);
                    $(`#price${stt}`).text(respon.price);
                    totalMoney(stt);
                }
            })
        }

		function totalMoney(stt) {
			let amount = $(`input[name="amount[${stt}]"]`).val();
			let price = $(`#price${stt}`).text();
			let sale = $(`#sale${stt}`).text();
			let total_money = (amount * price) - (amount * price * sale / 100);

			$(`#totalMoney${stt}`).text(total_money);

			setTotal();
		}

        function setTotal() {
	        let total = 0;
	        for (i=0; i<=stt; i++) {
	        	if ($(`#totalMoney${i}`).text()) {
	        		total += parseInt($(`#totalMoney${i}`).text());
	        	}
	        }
	        $(`#total`).text(total);
        }

        function checkNumberBook(stt, amount) {
        	let id = $(`select[name="book_id[${stt}]"]`).val();
        	$.ajax({
                url: '/admin/books/'+id,
                method: 'GET',
                success: function (response) {
                    if (amount > response.amount) {
                        Toast.fire({
                            icon: 'error',
                            title: `Sản phẩm này cửa hàng chỉ còn lại ${response.amount} sản phẩm!`
                        })
                    }
                },
                error: function (error) {
                    console.log(error)
                }
            })
        }
	</script>
</body>
</html>