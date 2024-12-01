<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sửa đơn hàng trả lại</title>
	@include('layout.link')
</head>
<body>
	@include('admin.menu_admin')
	
	<div class="container mt-5">
		<h1 class="title-admin">Sửa đơn hàng trả lại</h1>
	</div>

	<div class="container-fluid mt-5">
		<div class="row">
			<div class="col-3">
				<a class="btn btn-success text-white" href="{{ route('return-order.index') }}">Danh sách đơn hàng trả lại</a>
			</div>
		</div>

		<form method="POST" action="{{ route('return-order.update', $return_order->id) }}">
			@csrf
			@method('PUT')

			<div class="form-group row mt-3">
				<label class="col-2 col-form-label">Lý do <span class="text-danger">(*)</span></label>
				<div class="col-3">
					<textarea class="form-control" name="reason" rows="3">{{ $return_order->reason }}</textarea>
				</div>
			</div>

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
				@foreach ($return_order_details as $return_order_detail)
					<tr>
						<td class="text-center">{{ $stt++ }}</td>
						<td>
							<select name="book_id[{{ $stt-2 }}]" class="form-control select2" required onchange="setSalePrice($(this).val(), {{ $stt-2 }})">
								<option value=""></option>
								@foreach($return_order->order->orderDetails as $order_detail)
								<option value="{{ $order_detail->book->id }}" {{ $return_order_detail->book_id == $order_detail->book->id ? 'selected' : '' }}>{{ $order_detail->book->name }}</option>
								@endforeach
							</select>
						</td>
						<td class="text-center">
							<input type="number" name="amount[{{ $stt-2 }}]" class="form-control" min="1" onkeyup="totalMoney({{ $stt-2 }})" value="{{ $return_order_detail->amount }}" required>
						</td>
						<td class="text-center" id="price{{ $stt-2 }}">{{ $return_order_detail->price }}</td>
						<td class="text-center" id="sale{{ $stt-2 }}">{{ $return_order_detail->sale }}</td>
						<td class="text-center" id="totalMoney{{ $stt-2 }}">{{ ($return_order_detail->amount * $return_order_detail->price) - ($return_order_detail->amount * $return_order_detail->price * $return_order_detail->sale / 100) }}</td>
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
						<td class="font-weight-bold text-center" id="total">{{ $return_order->total_money }}</td>
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
							@foreach($return_order->order->orderDetails as $order_detail)
							<option value="{{ $order_detail->book->id }}">{{ $order_detail->book->name }}</option>
							@endforeach
						</select>
					</td>
					<td class="text-center">
						<input type="number" name="amount[${stt}]" class="form-control" min="1" onkeyup="totalMoney(${stt})" required>
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
	</script>
</body>
</html>