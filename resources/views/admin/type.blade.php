<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ $title }}</title>
	@include('layout.link')
</head>
<body>
	@include('admin.menu_admin')
	
	<div class="container mt-5">
		@if(session('notificationAdd'))
			<div class="alert alert-success text-center mt-3" role="alert">
                <button type="button" class="close d-block" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('notificationAdd') }}
            </div>
		@endif
		@if(session('notificationUpdate'))
			<div class="alert alert-success text-center mt-3" role="alert">
                <button type="button" class="close d-block" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('notificationUpdate') }}
            </div>
		@endif
		@if($errors->has('nameupdate'))
			<div class="alert alert-danger text-center mt-3" role="alert">
                <button type="button" class="close d-block" data-dismiss="alert" aria-hidden="true">&times;</button>
                Sửa thể loại thất bại!
            </div>
		@endif
		@if($errors->has('name'))
			<div class="alert alert-danger text-center mt-3" role="alert">
                <button type="button" class="close d-block" data-dismiss="alert" aria-hidden="true">&times;</button>
                Thêm thể loại thất bại!
            </div>
		@endif
		@if(session('notificationDelete'))
            <div class="alert alert-success text-center mt-3" role="alert">
                <button type="button" class="close d-block" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('notificationDelete') }}
            </div>
        @endif
        @if(session('notificationDeleteFail'))
            <div class="alert alert-danger text-center mt-3" role="alert">
                <button type="button" class="close d-block" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('notificationDeleteFail') }}
            </div>
        @endif
		
		<h1 class="title-admin">Danh sách thể loại sách</h1>

		<form action="{{ route('types.store') }}" method="POST">
			@csrf
			<div class="row mt-5">
				{{-- <div class="col-3">
					<input type="text" name="code" id="code" placeholder="Mã thể loại" class="form-control w-100" value="{{ old('code') }}">
					@if($errors->has('code'))
						<span class="text-danger d-block mt-2">{{ $errors->first('code') }}</span>
					@endif
				</div> --}}
				<div class="col-3">
					<input type="text" name="name" id="name" placeholder="Tên thể loại" class="form-control w-100" value="{{ old('name') }}">
					@if($errors->has('name'))
						<span class="text-danger d-block mt-2">{{ $errors->first('name') }}</span>
					@endif
				</div>
				<div class="col-2">
					<button type="submit" class="btn btn-success w-75" id="add">Thêm</button>
				</div>
			</div>
		</form>


		<form action="{{ route('types.index') }}" method="GET" class="row mt-3">
			<div class="col-3">
				<input type="text" name="key" placeholder="Tên thể loại" class="form-control w-100">
			</div>
			<div class="col-2">
				<button type="submit" class="btn btn-success w-75 add-test">Tìm kiếm</button>
			</div>
		</form>

		<table class="table table-bordered table-striped mt-3 table-responsive" id="table">
			<tr class="text-center">
				<th class="w-25">STT</th>
				<th>Mã thể loại</th>
				<th>Tên thể loại</th>
				<th>Thao tác</th>
			</tr>
			<?php $stt = 1; ?>
			@foreach ($types as $type)
			<tr>
				<td class="text-center align-middle">{{ $stt++ }}</td>
				<td class="align-middle">{{ $type->code }}</td>
				<td class="align-middle">{{ $type->name }}</td>
				<td class="text-center">
					<button class="btn btn-warning text-white w-25" data-toggle="modal" data-target="#edit_category_book{{ $type->id }}">Sửa</button>

					<!-- Modal Sửa -->
					<div class="modal fade" id="edit_category_book{{ $type->id }}">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">

								<!-- Modal Header -->
								<div class="modal-header">
									<h4 class="modal-title">Sửa thể loại</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<form action="{{ route('types.update', $type->id) }}" method="POST" class="col-9 mb-3">
									<!-- Modal body -->
									@csrf
									@method('PUT')
									<div class="modal-body container">
										<div class="row">
											{{-- <div class="col-3 mb-3">Mã thể loại *:</div>
											<div class="col-9 mb-3">
												<input type="text" name="codeupdate" placeholder="Mã thể loại" class="form-control w-100" value="{{ $type->code }}">
												@if($errors->has('codeupdate'))
													<span class="text-danger text-left d-block mt-2">{{ $errors->first('codeupdate') }}</span>
												@endif
											</div> --}}

											<div class="col-3 mb-3">Tên thể loại *:</div>
											<div class="col-9 mb-3">
												<input type="text" name="nameupdate" placeholder="Tên thể loại" class="form-control w-100" value="{{ $type->name }}">
												@if($errors->has('nameupdate'))
													<span class="text-danger text-left d-block mt-2">{{ $errors->first('nameupdate') }}</span>
												@endif
											</div>
										</div>
									</div>

									<!-- Modal footer -->
									<div class="modal-footer justify-content-center">
										<button type="submit" class="btn btn-warning text-white w-25">Lưu lại</button>
										<button type="button" class="btn btn-danger w-25" data-dismiss="modal">Đóng</button>
									</div>
								</form>
							</div>
						</div>
					</div>


					<form action="{{ route('types.destroy', $type->id) }}" method="POST" class="d-inline">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger w-25" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
					</form>
				</td>
			</tr>
			@endforeach
		</table>
		<div class="text-center mb-5">
			{{ $types->appends(['key' => $request->key,])->links() }}
		</div>
	</div>
	@include('layout.script')

</body>
</html>