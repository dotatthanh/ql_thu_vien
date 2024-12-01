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
		<h1 class="title-admin">Nhập hàng</h1>
	</div>

	<div class="container-fluid mt-5">
		<button class="btn btn-success" data-toggle="modal" data-target="#add_book">Thêm sách</button>
		<a class="btn btn-success text-white" href="{{ route('suppliers.create') }}" target="blank">Thêm nhà cung cấp</a>
		<a class="btn btn-success text-white" href="{{ route('warehouses.index') }}">Danh sách nhập hàng</a>
		
		<form method="POST" action="{{ route('warehouses.store') }}">
			@csrf
			<div class="form-group row mt-3">
				<label class="col-2 col-form-label">Nhà cung cấp <span class="text-danger">(*)</span></label>
				<div class="col-3">
					<select name="supplier_id" class="form-control select2" required>
						<option value=""></option>
						@foreach($suppliers as $supplier)
						<option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<table class="table table-bordered table-striped mt-3">
				<tr class="text-center">
					<th>STT</th>
					<th width="350px">Tên sách</th>
					<th>Số lượng (quyển)</th>
					<th>Giá (VNĐ)</th>
					<th>Thành tiền (VNĐ)</th>
					<th class="minw-140">Thao tác</th>
				</tr>
				<?php $stt = 1; ?>
				<tr>
					<td class="text-center">{{ $stt++ }}</td>
					<td>
						<select name="book_id[0]" class="form-control select2" required>
							<option value=""></option>
							@foreach($books as $book)
							<option value="{{ $book->id }}">{{ $book->name }}</option>
							@endforeach
						</select>
					</td>
					<td class="text-center">
						<input type="number" name="amount[0]" class="form-control" min="1" onkeyup="totalMoney(0)" required>
					</td>
					<td class="text-center">
						<input type="number" name="price[0]" class="form-control" min="1" onkeyup="totalMoney(0)" required>
					</td>
					<td class="text-center" id="totalMoney0">0</td>
					<td></td>
				</tr>
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
				<button type="submit" class="btn btn-success mt-2">Nhập hàng</button>
			</div>
		</form>
	</div>

	<!-- Modal Add -->
	<div class="modal fade" id="add_book">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Thêm sách</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="modal-body container">
						<div class="row">
							{{-- <div class="col-3 mb-3">Mã sách *:</div>
							<div class="col-9 mb-3">
								<input type="text" name="code" placeholder="Mã sách" class="form-control w-100">
								@if($errors->has('code'))
									<span class="text-danger d-block mt-2">{{ $errors->first('code') }}</span>
								@endif
							</div> --}}

							<div class="col-3 mb-3">Tên sách *:</div>
							<div class="col-9 mb-3">
								<input type="text" name="name" placeholder="Tên sách" class="form-control w-100">
								@if($errors->has('name'))
									<span class="text-danger d-block mt-2">{{ $errors->first('name') }}</span>
								@endif
							</div>

							<div class="col-3 mb-3">Ảnh *:</div>
							<div class="col-9 mb-3">
								<input type="file" name="img" class="form-control" required>
								@if($errors->has('img'))
									<span class="text-danger d-block mt-2">{{ $errors->first('img') }}</span>
								@endif
							</div>

							<div class="col-3 mb-3">Sách nổi bật:</div>
							<div class="col-9 mb-3">
								<label class="switch switch-small">
									<input type="checkbox"  name="is_highlight" value="1">
									<span class="slider"></span>
								</label>
							</div>

							<div class="col-3 mb-3">Tác giả *:</div>
							<div class="col-9 mb-3">
								<select name="author_id[]" id="" class="form-control select2 w-100" multiple="multiple">
									@foreach ($authors as $author)
										<option value="{{ $author->id }}">{{ $author->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="col-3 mb-3">Thể loại *:</div>
							<div class="col-9 mb-3">
								<select name="type[]" id="" class="form-control select2 w-100" multiple="multiple">
									@foreach ($types as $type)
									<option value="{{ $type->id }}">{{ $type->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="col-3 mb-3">Danh mục *:</div>
							<div class="col-9 mb-3">
								<select name="category[]" id="" class="form-control select2 w-100" multiple="multiple">
									@foreach ($categories as $category)
									<option value="{{ $category->id }}">{{ $category->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="col-3 mb-3">Kích thước *:</div>
							<div class="col-9 mb-3">
								<input type="text" name="size" placeholder="Kích thước sách" class="form-control w-100">
								@if($errors->has('size'))
								<span class="text-danger d-block mt-2">{{ $errors->first('size') }}</span>
								@endif
							</div>

							<div class="col-3 mb-3">Số trang *:</div>
							<div class="col-9 mb-3">
								<input type="text" name="page_number" placeholder="Số trang sách" class="form-control w-100">
								@if($errors->has('page_number'))
								<span class="text-danger d-block mt-2">{{ $errors->first('page_number') }}</span>
								@endif
							</div>

							{{-- <div class="col-3 mb-3">Số lượng:</div>
							<div class="col-7 mb-3 ">
								<input name="amount" type="number" class="form-control">
								@if($errors->has('amount'))
									<span class="text-danger d-block mt-2">{{ $errors->first('amount') }}</span>
								@endif
							</div>
							<div class="col-2 mb-3 ">
								<input type="text" class="form-control text-center" value="Quyển" disabled>
							</div>

							<div class="col-3 mb-3">Giá bìa:</div>
							<div class="col-7 mb-3 ">
								<input name="cover_price" type="number" min="1" class="form-control">
								@if($errors->has('cover_price'))
									<span class="text-danger d-block mt-2">{{ $errors->first('cover_price') }}</span>
								@endif
							</div> --}}
							{{-- <div class="col-2 mb-3 ">
								<input type="text" class="form-control text-center" value="VNĐ" disabled>
							</div> --}}

							<div class="col-3 mb-3">Đơn giá *:</div>
							<div class="col-7 mb-3 ">
								<input name="price" type="number" min="1" class="form-control">
								@if($errors->has('price'))
									<span class="text-danger d-block mt-2">{{ $errors->first('price') }}</span>
								@endif
							</div>
							<div class="col-2 mb-3 ">
								<input type="text" class="form-control text-center" value="VNĐ" disabled>
							</div>

							<div class="col-3 mb-3">Giảm giá:</div>
							<div class="col-7 mb-3 ">
								<input name="sale" type="number" min="0" class="form-control">
								@if($errors->has('sale'))
									<span class="text-danger d-block mt-2">{{ $errors->first('sale') }}</span>
								@endif
							</div>
							<div class="col-2 mb-3 ">
								<input type="text" class="form-control text-center" value="%" disabled>
							</div>
							<div class="col-3 mb-3">Tóm tắt nội dung *:</div>
							<div class="col-9 mb-3">
								<textarea name="content" id="ckeditor" class="w-100 ckeditor form-control" rows="3"></textarea>
								@if($errors->has('content'))
									<span class="text-danger d-block mt-2">{{ $errors->first('content') }}</span>
								@endif
							</div>
						</div>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer justify-content-center">
						<button type="submit" class="btn btn-success w-25">Thêm</button>
						<button type="button" class="btn btn-danger w-25" data-dismiss="modal">Đóng</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	@include('layout.script')

	<script type="text/javascript">
		let stt = 0;
		function addRow() {

			stt++;
			let row = `
				<tr>
					<td class="text-center">${stt +1}</td>
					<td>
						<select name="book_id[${stt}]" class="form-control select2" required>
							<option value=""></option>
							@foreach($books as $book)
							<option value="{{ $book->id }}">{{ $book->name }}</option>
							@endforeach
						</select>
					</td>
					<td class="text-center">
						<input type="number" name="amount[${stt}]" class="form-control" min="1" onkeyup="totalMoney(${stt})" required>
					</td>
					<td class="text-center">
						<input type="number" name="price[${stt}]" class="form-control" min="1" onkeyup="totalMoney(${stt})" required>
					</td>
					<td class="text-center" id="totalMoney${stt}">0</td>
					<td class="text-center">
						<button type="button" class="btn btn-danger" onclick="removeRow($(this))">X</button>
					</td>
				</tr>
			`;
			jQuery('tbody').append(row);
			
			if($( ".select2" ).length>0) {
				$(".select2").select2({ 
				});
			}
		}

		function removeRow(obj) {
			let a = obj.closest('tr').remove();
			setTotal();
		}

		function totalMoney(stt) {
			let amount = $(`input[name="amount[${stt}]"]`).val();
			let price = $(`input[name="price[${stt}]"]`).val();

			$(`#totalMoney${stt}`).text(amount * price);
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