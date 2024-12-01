<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>{{ $title }}</title>
	@include('layout.link')
</head>
<body>
	@include('admin.menu_admin')
	
	<div class="container mt-5">
		@if(session('notificationAdd'))
			<span class="alert alert-success mt-2 d-block text-center" role="alert">{{ session('notificationAdd') }}</span>
		@endif
		@if($errors->has('title') || $errors->has('summary') || $errors->has('img') || $errors->has('content'))
			<span class="alert alert-danger mt-2 d-block text-center" role="alert">Thêm sách thất bại!</span>
		@endif
		@if($errors->has('titleupdate') || $errors->has('summaryupdate') || $errors->has('imgupdate') || $errors->has('contentupdate'))
			<span class="alert alert-danger mt-2 d-block text-center" role="alert">Sửa sách thất bại!</span>
		@endif
		
		<h1 class="title-admin">Danh sách tin tức</h1>
	</div>

	<div class="container-fluid mt-5">
		<button class="btn btn-success" data-toggle="modal" data-target="#add_news">Thêm tin tức</button>
		<form action="{{ route('news.index') }}" method="GET" class="row mt-3">
			<div class="col-3">
				<input type="text" name="key" placeholder="Tên sách" class="form-control w-100">
			</div>
			<div class="col-2">
				<button class="btn btn-success w-75">Tìm kiếm</button>
			</div>
		</form>
		<table class="table table-bordered table-striped mt-3 mb-5">
			<tr class="text-center">
				<th>STT</th>
				<th>Tiêu đề</th>
				<th class="w-50">Tóm tắt</th>
				<th>Ảnh</th>
				<th class="minw-140">Thao tác</th>
			</tr>
			<?php $stt = 1; ?>
			@foreach ($news as $new)
			<tr>
				<td class="text-center">{{ $stt++ }}</td>
				<td>{{ $new->title }}</td>
				<td>{!! $new->summary !!}</td>
				<td class="text-center"><img class="maxw-218" src="{{ asset('storage/'.$new->img) }}" alt=""></td>
				<td class="text-center">
					<button class="btn btn-warning text-white" data-toggle="modal" data-target="#edit_news{{ $new->id }}">Sửa</button>

					<!-- Modal Sửa -->
					<div class="modal fade text-left" id="edit_news{{ $new->id }}">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">

								<!-- Modal Header -->
								<div class="modal-header">
									<h4 class="modal-title">Sửa tin tức</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<!-- Modal body -->
								<form action="{{ route('news.update', $new->id) }}" method="POST" enctype="multipart/form-data">
									@csrf
									@method('PUT')
									<div class="modal-body container">
										<div class="row">
											<div class="col-3 mb-3">Tiêu đề *:</div>
											<div class="col-9 mb-3">
												<input type="text" name="titleupdate" placeholder="Tiêu đề" class="form-control w-100" value="{{ $new->title }}">
												@if($errors->has('titleupdate'))
													<span class="text-danger d-block mt-2">{{ $errors->first('titleupdate') }}</span>
												@endif
											</div>

											<div class="col-3 mb-3">Tóm tắt *:</div>
											<div class="col-9 mb-3">
												<textarea name="summaryupdate" class="w-100 ckeditor form-control" rows="3">{{ $new->summary }}</textarea>
												@if($errors->has('summaryupdate'))
													<span class="text-danger d-block mt-2">{{ $errors->first('summaryupdate') }}</span>
												@endif
											</div>

											<div class="col-3 mb-3">Ảnh *:</div>
											<div class="col-9 mb-3">
												<input type="file" name="imgupdate" class="form-control" value="">
												@if($errors->has('imgupdate'))
													<span class="text-danger d-block mt-2">{{ $errors->first('imgupdate') }}</span>
												@endif
											</div>

											<div class="col-3 mb-3">Nội dung *:</div>
											<div class="col-9 mb-3">
												<textarea name="contentupdate" id="" class="w-100 ckeditor form-control" rows="3">{{ $new->content }}</textarea>
												@if($errors->has('contentupdate'))
													<span class="text-danger d-block mt-2">{{ $errors->first('contentupdate') }}</span>
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

					<form action="{{ route('news.destroy', $new->id) }}" method="POST" class="d-inline">
						@csrf
						@method('DELETE')
						<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
					</form>
				</td>
			</tr>
			@endforeach
		</table>
		<div class="text-center">
			{{ $news->appends(['key' => $request->key])->links() }}
		</div>
	</div>

	<!-- Modal Add -->
	<div class="modal fade" id="add_news">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Thêm tin tức</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="modal-body container">
						<div class="row">
							<div class="col-3 mb-3">Tiêu đề *:</div>
							<div class="col-9 mb-3">
								<input type="text" name="title" placeholder="Tiêu đề" class="form-control w-100">
								@if($errors->has('title'))
									<span class="text-danger d-block mt-2">{{ $errors->first('title') }}</span>
								@endif
							</div>

							<div class="col-3 mb-3">Tóm tắt *:</div>
							<div class="col-9 mb-3">
								<textarea name="summary" class="w-100 ckeditor form-control" rows="3"></textarea>
								@if($errors->has('summary'))
									<span class="text-danger d-block mt-2">{{ $errors->first('summary') }}</span>
								@endif
							</div>

							<div class="col-3 mb-3">Ảnh *:</div>
							<div class="col-9 mb-3">
								<input type="file" name="img" class="form-control">
								@if($errors->has('img'))
									<span class="text-danger d-block mt-2">{{ $errors->first('img') }}</span>
								@endif
							</div>

							<div class="col-3 mb-3">Nội dung *:</div>
							<div class="col-9 mb-3">
								<textarea name="content" id="ckeditor" class="w-100 form-control ckeditor" rows="3"></textarea>
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
</body>
</html>