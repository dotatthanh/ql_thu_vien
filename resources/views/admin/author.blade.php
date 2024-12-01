<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Tác giả</title>
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
		@if($errors->has('nameupdate') || $errors->has('sexupdate') || $errors->has('birthdayupdate') || $errors->has('storyupdate'))
			<div class="alert alert-danger text-center mt-3" role="alert">
                <button type="button" class="close d-block" data-dismiss="alert" aria-hidden="true">&times;</button>
                Sửa thể loại thất bại!
            </div>
		@endif
		@if($errors->has('name') || $errors->has('sex') || $errors->has('birthday') || $errors->has('story'))
		<div class="alert alert-danger text-center mt-3" role="alert">
                <button type="button" class="close d-block" data-dismiss="alert" aria-hidden="true">&times;</button>
                Thêm thể loại thất bại!
            </div>
		@endif
		@if(session('notificationDeleteFail'))
			<div class="alert alert-danger text-center mt-3" role="alert">
                <button type="button" class="close d-block" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('notificationDeleteFail') }}
            </div>
		@endif
		@if(session('notificationDelete'))
			<div class="alert alert-success text-center mt-3" role="alert">
                <button type="button" class="close d-block" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('notificationDelete') }}
            </div>
		@endif
		<h1 class="title-admin">Danh sách tác giả</h1>
	</div>
	
	<div class="container-fluid mt-5">
		<button class="btn btn-success text-white" data-toggle="modal" data-target="#add_author">Thêm tác giả</button>

		<form action="{{ route('authors.index') }}" method="GET" class="row mt-3">
			<div class="col-3">
				<input type="text" name="key" placeholder="Tên tác giả" class="form-control w-100">
			</div>
			<div class="col-2">
				<button type="submit" class="btn btn-success w-75 add-test">Tìm kiếm</button>
			</div>
		</form>
		
		<table class="table table-bordered table-striped mt-3">
			<tr class="text-center">
				<th>STT</th>
				<th>Tên tác giả</th>
				<th>Giới tính</th>
				<th>Ngày sinh</th>
				<th>Thể loại</th>
				<th class="w-50">Tiểu sử</th>
				<th class="minw-140">Thao tác</th>
			</tr>
			<?php $stt = 1; ?>
			@foreach ($authors as $author)
			<tr>
				<td class="text-center">{{ $stt++ }}</td>
				<td>{{ $author->name }}</td>
				<td>{{ $author->sex }}</td>
				<td>{{ date("d/m/Y", strtotime($author->birthday)) }}</td>
				<td>
					@foreach ($author->types as $type)
						- {{ $type->name }}<br>
					@endforeach
				</td>
				<td>{!! $author->story !!}</td>
				<td class="text-center">
					<button class="btn btn-warning text-white" data-toggle="modal" data-target="#edit_author{{ $author->id }}">Sửa</button>

					<!-- Modal Sửa -->
					<div class="modal fade text-left" id="edit_author{{ $author->id }}">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">

								<!-- Modal Header -->
								<div class="modal-header">
									<h4 class="modal-title">Sửa tác giả</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<!-- Modal body -->
								<form action="{{ route('authors.update', $author->id) }}" method="POST">
									@csrf
									@method('PUT')
									<div class="modal-body container">
										<div class="row">
											<div class="col-3 mb-3">Tên tác giả *:</div>
											<div class="col-9 mb-3">
												<input type="text" name="nameupdate" placeholder="Tên tác giả" class="form-control w-100" value="{{ $author->name }}">
												@if($errors->has('nameupdate'))
													<span class="text-danger d-block mt-2">{{ $errors->first('nameupdate') }}</span>
												@endif
											</div>
											<div class="col-3 mb-3">Giới tính *:</div>
											<div class="col-9 mb-3">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="sexupdate" id="nam" value="Nam" {{ $author->sex == 'Nam' ? 'checked' : '' }}>
													<label class="form-check-label" for="nam">Nam</label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="sexupdate" id="nu" value="Nữ" {{ $author->sex == 'Nữ' ? 'checked' : '' }}>
													<label class="form-check-label" for="nu">Nữ</label>
												</div>

												@if($errors->has('sexupdate'))
													<span class="text-danger d-block mt-2">{{ $errors->first('sexupdate') }}</span>
												@endif
											</div>
											<div class="col-3 mb-3">Ngày sinh *:</div>
											<div class="col-9 mb-3">
												<input type="date" name="birthdayupdate" class="form-control w-100" value="{{ $author->birthday }}">
												@if($errors->has('birthdayupdate'))
													<span class="text-danger d-block mt-2">{{ $errors->first('birthdayupdate') }}</span>
												@endif
											</div>
											<div class="col-3 mb-3">Thể loại *:</div>
											<div class="col-9 mb-3 ">
												<select name="typeupdate[]" id="" class="form-control select2 w-100" multiple="multiple">
													@foreach ($types as $type)
													<option value="{{ $type->id }}">{{ $type->name }}</option>
													@endforeach
												</select>
											</div>
											<div class="col-3">Tiểu sử *:</div>
											<div class="col-9">
												<textarea name="storyupdate" id="" rows="3" placeholder="Tiểu sử" class="form-control ckeditor">{{ $author->story }}</textarea>
												@if($errors->has('storyupdate'))
													<span class="text-danger d-block mt-2">{{ $errors->first('storyupdate') }}</span>
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

					<form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="d-inline">
						@csrf
						@method('DELETE')
						<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
					</form>
				</td>
			</tr>
			@endforeach
		</table>
		<div class="text-center mb-5">
			{{ $authors->appends(['key' => $request->key])->links() }}
		</div>
	</div>

	<!-- Modal Add -->
	<div class="modal fade" id="add_author">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Thêm tác giả</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<form action="{{ route('authors.store') }}" method="POST">
					@csrf
					<div class="modal-body container">
						<div class="row">
							<div class="col-3 mb-3">Tên tác giả *:</div>
							<div class="col-9 mb-3">
								<input type="text" name="name" placeholder="Tên tác giả" class="form-control w-100">
								@if($errors->has('name'))
									<span class="text-danger d-block mt-2">{{ $errors->first('name') }}</span>
								@endif
							</div>
							<div class="col-3 mb-3">Giới tính *:</div>
							<div class="col-9 mb-3">
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="sex" id="inlineRadio1" value="Nam">
								  <label class="form-check-label" for="inlineRadio1">Nam</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="sex" id="inlineRadio2" value="Nữ">
								  <label class="form-check-label" for="inlineRadio2">Nữ</label>
								</div>
								@if($errors->has('sex'))
									<span class="text-danger d-block mt-2">{{ $errors->first('sex') }}</span>
								@endif
							</div>
							<div class="col-3 mb-3">Ngày sinh *:</div>
							<div class="col-9 mb-3">
								<input type="date" name="birthday" class="form-control w-100">
								@if($errors->has('birthday'))
									<span class="text-danger d-block mt-2">{{ $errors->first('birthday') }}</span>
								@endif
							</div>
							<div class="col-3 mb-3">Thể loại *:</div>
							<div class="col-9 mb-3 ">
								<select name="type[]" id="" class="form-control select2 w-100" multiple="multiple">
									@foreach ($types as $type)
									<option value="{{ $type->id }}">{{ $type->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-3">Tiểu sử *:</div>
							<div class="col-9">
								<textarea name="story" rows="3" placeholder="Tiểu sử" class="form-control ckeditor"></textarea>
								@if($errors->has('story'))
									<span class="text-danger d-block mt-2">{{ $errors->first('story') }}</span>
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
</body>
</html>