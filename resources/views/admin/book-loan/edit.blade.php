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
        <h1 class="title-admin">Chỉnh sửa mượn sách</h1>
    </div>

    <div class="container-fluid mt-5">
        <form method="POST" action="{{ route('book_loans.update', $data_edit->id) }}">
            @method('PUT')
            <div class="form-group row mt-3">
                <label class="col-2 col-form-label">Khách hàng <span class="text-danger">(*)</span></label>
                <div class="col-3">
                    <select name="customer_id" class="form-control select2" required>
                        <option value=""></option>
                        @foreach ($customers as $item)
                            <option value="{{ $item->id }}" {{ $data_edit->customer_id == $item->id ? 'selected' : ''}}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row mt-3">
                <label class="col-2 col-form-label">Từ ngày <span class="text-danger">(*)</span></label>
                <div class="col-3">
                    <input type="date" name="from_date" class="form-control" value="{{ $data_edit->from_date }}" required onchange="handlDateChange()">
                </div>
                <label class="col-2 col-form-label">Đến ngày <span class="text-danger">(*)</span></label>
                <div class="col-3">
                    <input type="date" name="to_date" class="form-control" value="{{ $data_edit->to_date }}" required onchange="handlDateChange()">
                </div>
            </div>
            @csrf
            <table class="table table-bordered table-striped mt-3">
                <tbody>
                    <tr class="text-center">
                        <th>STT</th>
                        <th width="350px">Tên sách</th>
                        <th>Số lượng (quyển)</th>
                        <th>Giá/Ngày (VNĐ)</th>
                        <th>Thành tiền (VNĐ)</th>
                        <th class="minw-140">Thao tác</th>
                    </tr>
                    <?php $stt = 1; ?>
                    @foreach ($data_edit->bookLoanDetails as $key => $bookLoanDetail)
                    <input type="hidden" name="book_loans[{{ $key }}][id]" value="{{ $bookLoanDetail->id }}">
                    <tr>
                        <td class="text-center">{{ $stt++ }}</td>
                        <td>
                            <select name="book_loans[{{ $key }}][book_id]" class="form-control select2" required
                                onchange="handleBookChange(this, {{ $key }})">
                                <option value=""></option>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}" data-price="{{ $book->price }}"
                                        data-sale="{{ $book->sale }}" {{ $bookLoanDetail->book_id == $book->id ? 'selected' : ''}}>{{ $book->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="text-center">
                            <input type="number" name="book_loans[{{ $key }}][quantity]" class="form-control" min="1"
                                onkeyup="totalMoney({{ $key }})" value="{{ $bookLoanDetail->quantity }}" required>
                        </td>
                        <td class="text-center" id="price-{{ $key }}">{{ $bookLoanDetail->price - ($bookLoanDetail->price * $bookLoanDetail->sale / 100) }}</td>
                        <td class="text-center" id="totalMoney{{ $key }}">{{ $bookLoanDetail->total_money - $bookLoanDetail->discount }}</td>
                        <td class="text-center">
                            @if ($key > 0)
                                <button type="button" class="btn btn-danger" onclick="removeRow($(this))">X</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-center">
                            <button type="button" class="btn btn-success" onclick="addRow()">+</button>
                        </td>
                        <td colspan="3" class="font-weight-bold text-right">Tổng cộng</td>
                        <td class="font-weight-bold text-center" id="total">0</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <div class="text-center">
                <button type="submit" class="btn btn-success mt-2">Lưu lại</button>
            </div>
        </form>
    </div>

    @include('layout.script')

    <script type="text/javascript">
        let stt = "{{ $data_edit->bookLoanDetails->count() }}";

        function addRow() {
            stt++;
            let row = `
				<tr>
					<td class="text-center">${stt +1}</td>
					<td>
						<select name="book_loans[${stt}][book_id]" class="form-control select2" required onchange="handleBookChange(this, ${stt})">
							<option value=""></option>
							@foreach ($books as $book)
							<option value="{{ $book->id }}" data-price="{{ $book->price }}" data-sale="{{ $book->sale }}">{{ $book->name }}
							@endforeach
						</select>
					</td>
					<td class="text-center">
						<input type="number" name="book_loans[${stt}][quantity]" class="form-control" min="1" onkeyup="totalMoney(${stt})" required>
					</td>
					<td class="text-center" id="price-${stt}">
					</td>
					<td class="text-center" id="totalMoney${stt}">0</td>
					<td class="text-center">
						<button type="button" class="btn btn-danger" onclick="removeRow($(this))">X</button>
					</td>
				</tr>
			`;
            $('tbody').append(row);

            if ($(".select2").length > 0) {
                $(".select2").select2({});
            }
        }

        function removeRow(obj) {
            obj.closest('tr').remove();
            setTotal();
        }

        function totalMoney(stt) {
            let quantity = $(`input[name="book_loans[${stt}][quantity]"]`).val();
            let price = $(`#price-${stt}`).text();
			let numberDays = calcNumberDays();
			
            $(`#totalMoney${stt}`).text(quantity * price * numberDays);

            setTotal();
        }

        function setTotal() {
            let total = 0;
            for (let i = 0; i <= stt; i++) {
                if ($(`#totalMoney${i}`).text()) {
                    total += parseInt($(`#totalMoney${i}`).text());
                }
            }
            $(`#total`).text(total);
        }

        function handleBookChange(selectElement, stt) {
            let selectedOption = $(selectElement).find(':selected');
            let price = selectedOption.data('price');
            const sale = selectedOption.data('sale');

            if (sale > 0) {
                price = price - (price * sale / 100);
            }
            $(`#price-${stt}`).html(price);

            totalMoney(stt)
        }

        function calcNumberDays() {
            let fromDate = $(`input[name="from_date"]`).val();
            let toDate = $(`input[name="to_date"]`).val();
			let diffDays = 0
            if (fromDate && toDate) {
                let from = new Date(fromDate);
                let to = new Date(toDate);

                let diffTime = to - from; // Lấy số milliseconds
                diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // Chuyển đổi sang số ngày và + 1
            }

			return diffDays;
        }

		function handlDateChange() {
			for (let i = 0; i <= stt; i++) {
				totalMoney(i)
            }
		}
    </script>
</body>

</html>
