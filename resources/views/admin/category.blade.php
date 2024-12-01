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
                Sửa danh mục thất bại!
            </div>
		@endif
		@if($errors->has('name'))
			<div class="alert alert-danger text-center mt-3" role="alert">
                <button type="button" class="close d-block" data-dismiss="alert" aria-hidden="true">&times;</button>
                Thêm danh mục thất bại!
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

		<h1 class="title-admin">Danh sách danh mục sách</h1>

		<form action="{{ route('categorys.store') }}" method="POST">
			@csrf
			<div class="row mt-5">
				<div class="col-3">
					<input type="text" name="name" placeholder="Tên danh mục" class="form-control w-100" value="{{ old('name') }}">
					@if($errors->has('name'))
						<span class="text-danger d-block mt-2">{{ $errors->first('name') }}</span>
					@endif
				</div>
				<div class="col-3">
					<select name="parent_id" id="" class="form-control select2 w-100">
						<option value="">Chọn danh mục cha</option>
						@foreach ($category_parents as $category_parent)
						<option value="{{ $category_parent->id }}">{{ $category_parent->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-2">
					<button type="submit" class="btn btn-success w-75">Thêm</button>
				</div>
			</div>
		</form>

		<form action="{{ route('categorys.index') }}" method="GET" class="row mt-3">
			<div class="col-3">
				<input type="text" name="key" placeholder="Tên danh mục" class="form-control w-100">
			</div>
			<div class="col-2">
				<button type="submit" class="btn btn-success w-75 add-test">Tìm kiếm</button>
			</div>
		</form>

		<table class="table table-bordered table-striped mt-3 table-responsive">
			<tr class="text-center">
				<th>STT</th>
				<th>Mã danh mục</th>
				<th>Tên danh mục</th>
				<th>Danh mục cha</th>
				<th>Thao tác</th>
			</tr>
			<?php $stt = 1; ?>
			@foreach ($categories as $category)
			<tr>
				<td class="text-center align-middle">{{ $stt++ }}</td>
				<td class="align-middle">{{ $category->code }}</td>
				<td class="align-middle">{{ $category->name }}</td>
				<td class="align-middle">{{ $category->category_parent }}</td>
				<td class="text-center">
					<button class="btn btn-warning text-white w-25" data-toggle="modal" data-target="#edit_book_list{{ $category->id }}">Sửa</button>


					<form action="{{ route('categorys.destroy', $category->id) }}" method="POST" class="d-inline">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger w-25" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
					</form>
				</td>
				<!-- Modal Sửa -->
				<div class="modal fade" id="edit_book_list{{ $category->id }}">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title">Sửa danh mục sách</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							<form action="{{ route('categorys.update', $category->id) }}" method="POST">
								@csrf
								@method('PUT')
								<!-- Modal body -->
								<div class="modal-body container">
									<div class="row">
										<div class="col-3 mb-3">Tên danh mục *:</div>
										<div class="col-9 mb-3">
											<input type="text" name="nameupdate" placeholder="Tên danh mục" class="form-control w-100" value="{{ $category->name }}">
											@if($errors->has('nameupdate'))
												<span class="text-danger text-left d-block mt-2">{{ $errors->first('nameupdate') }}</span>
											@endif
										</div>

										<div class="col-3 mb-3">Danh mục cha:</div>
										<div class="col-9 mb-3">
											<select name="parent_id" id="" class="form-control select2">
												<option value="">Chọn danh mục cha</option>
												@foreach ($category_parents as $category_parent)
												<option value="{{ $category_parent->id }}" 
													{{ $category_parent->id == $category->parent_id ? 'selected' : '' }}
													>{{ $category_parent->name }}</option>
												@endforeach
											</select>
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
			</tr>
			@endforeach
		</table>
		<div class="text-center mb-5">
			{{ $categories->appends(['key' => $request->key])->links()  }}
		</div>
	</div>

	@include('layout.script')
</body>
</html>