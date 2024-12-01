<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Danh mục sách</title>
	@include('layout.link')
</head>
<body>
	@include('admin.menu_admin')
	
	<div class="container mt-5">
		<h1 class="title-admin"><span>Danh sách</span> Phản hồi từ khách hàng</h1>

		<form action="{{ route('contacts.index') }}" method="GET" class="row mt-3">
			<div class="col-3">
				<input type="text" name="key" placeholder="Tên hoặc Email" class="form-control w-100">
			</div>
			<div class="col-2">
				<button type="submit" class="btn btn-success w-75 add-test">Tìm kiếm</button>
			</div>
		</form>

		<table class="table table-bordered table-striped mt-3 table-responsive">
			<tr class="text-center">
				<th>STT</th>
				<th>Tên khách hàng</th>
				<th>Email</th>
				<th>Nội dung phản hồi</th>
				<!-- <th>Thao tác</th> -->
			</tr>
			<?php $stt = 1; ?>
			@foreach ($contacts as $contact)
			<tr>
				<td class="text-center align-middle">{{ $stt++ }}</td>
				<td class="align-middle">{{ $contact->name }}</td>
				<td class="align-middle">{{ $contact->email }}</td>
				<td class="align-middle">{{ $contact->content }}</td>
				<!-- <td class="text-center">
					<button class="btn btn-warning text-white" data-toggle="modal" data-target="#edit_book_list{{ $contact->id }}">Sửa</button> -->

					<!-- Modal Sửa -->
					<!-- <div class="modal fade" id="edit_book_list{{ $contact->id }}">
						<div class="modal-dialog modal-lg">
							<div class="modal-content"> -->

								<!-- Modal Header -->
								<!-- <div class="modal-header">
									<h4 class="modal-title">Sửa danh mục sách</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<form action="{{ route('contacts.update', $contact->id) }}" method="POST">
									@csrf
									@method('PUT') -->
									<!-- Modal body -->
									<!-- <div class="modal-body container">
										<div class="row">
											<div class="col-3 mb-3">Tên danh mục:</div>
											<div class="col-9 mb-3">
												<input type="text" name="nameupdate" placeholder="Tên danh mục" class="form-control w-100" value="{{ $contact->name }}">
												@if($errors->has('nameupdate'))
													<span class="text-danger text-left d-block mt-2">{{ $errors->first('nameupdate') }}</span>
												@endif
											</div>
										</div>
									</div> -->

									<!-- Modal footer -->
									<!-- <div class="modal-footer justify-content-center">
										<button type="submit" class="btn btn-warning text-white w-25">Lưu lại</button>
										<button type="button" class="btn btn-danger w-25" data-dismiss="modal">Đóng</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
					</form>
				</td> -->
			</tr>
			@endforeach
		</table>
		<div class="text-center mb-5">
			{{ $contacts->appends(['key' => $request->key])->links()  }}
		</div>
	</div>

	@include('layout.script')
</body>
</html>