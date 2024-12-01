@extends('layout.master')
@section('content')

	<div class="container">
		<div class="list-item">
			<ul class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="#"><span itemprop="name">Trang chủ</span></a>
					<meta itemprop="position" content="1">
				</li>
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
					<a itemprop="item"><span itemprop="name">Liên hệ</span></a>
					<meta itemprop="position" content="2">
				</li>
			</ul>
		</div>
	</div>
	

	<div class="container">
		@if(session('notificationContact'))
			<div class="alert alert-success text-center mt-3" role="alert">
                <button type="button" class="close d-block" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('notificationContact') }}
            </div>
		@endif
		@if($errors->has('namecontact') || $errors->has('emailcontact') || $errors->has('content'))
		<div class="alert alert-danger text-center mt-3" role="alert">
                <button type="button" class="close d-block" data-dismiss="alert" aria-hidden="true">&times;</button>
                Phản hồi thất bại! Hãy điền thông tin theo đúng yêu cầu!
            </div>
		@endif
		<div class="row">
			<div class="col-md-12 col-lg-4 contact">
				<p>TECH 55</p>
				<p>Trân trọng Kính chào Quý khách!  Mọi thông tin xin vui lòng liên hệ:</p>

				<div class="info-contact">
					<p>CTY CỔ PHẦN CÔNG NGHỆ TECH5S</p>
					<p>Văn phòng giao dịch Việt Nam</p>
					<div class="address">
						<span>Địa chỉ: </span>
						<a title="" href="#">Tầng 3, Số 10, Ngõ 800A, Nghĩa Đô, Cầu Giấy, TP.Hà Nội</a>
					</div>
					<div class="hotline">
						<span>Hotline:</span>	
						<a title="" href="tel:0964949988">096.494.9988</a>
					</div>
					<div class="email">
						<span>Email:</span>		
						<div class="email-contact">
							<a title="" href="mailto:cskh.tech5s@gmail.com">cskh.tech5s@gmail.com</a>
							<a title="" href="mailto:kythuat.tech5s@gmail.com">kythuat.tech5s@gmail.com</a>
						</div>
					</div>					
					<div class="website">
						<span>Website:</span>	
						<div class="website-contact">
							<a title="" href="https://tech5s.com.vn">https://tech5s.com.vn</a>
							<a title="" href="http://giaodiendep.com.vn">http://giaodiendep.com.vn</a>
							<a title="" href="http://web5s.info">http://web5s.info</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-lg-8 form">
				<form action="{{ route('page.send_us') }}" method="POST">
					@csrf
					<div class="form-contact">
						<label for="">Họ và tên <span class="text-danger">(*)</span></label>
						<input type="text" name="namecontact" placeholder="Nhập tên của bạn" value="{{ old('namecontact') }}">
						@if($errors->has('namecontact'))
							<span class="text-danger d-block mt-2">{{ $errors->first('namecontact') }}</span>
						@endif
					</div>
					<div class="form-contact">
						<label for="">Email <span class="text-danger">(*)</span></label>
						<input type="text" name="emailcontact" placeholder="Nhập email của bạn" value="{{ old('emailcontact') }}">
						@if($errors->has('emailcontact'))
							<span class="text-danger d-block mt-2">{{ $errors->first('emailcontact') }}</span>
						@endif
					</div>
					<div class="form-contact">
						<label for="">Nội dung <span class="text-danger">(*)</span></label>
						<textarea name="content" id="" cols="30" rows="3" placeholder="Nhập nội dung">{{ old('content') }}</textarea>
						@if($errors->has('content'))
							<span class="text-danger d-block mt-2">{{ $errors->first('content') }}</span>
						@endif
					</div>
					<button type="submit">Gửi cho chúng tôi</button>
				</form>
			</div>
			<div class="col-12 map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8247215471115!2d105.8034119402141!3d21.039698211996644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab3e85bdf73f%3A0xdb5f11934c72194d!2zMTAgxJDGsOG7nW5nIDgwMEEsIE5naMSpYSDEkMO0LCBD4bqndSBHaeG6pXksIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1550204839842" width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
	
@endsection


@section('script')
<script>
	$(document).ready(function() {
		$("html, body").animate({ scrollTop: $('.slider').height() }, 1000);
	});
</script>
@endsection