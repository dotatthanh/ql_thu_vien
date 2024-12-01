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
					<a itemprop="item" href="#"><span itemprop="name">{{ $book->categories->first()->name }}</span></a>
					<meta itemprop="position" content="2">
				</li>
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
					<a itemprop="item"><span itemprop="name">{{ $book->name }}</span></a>
					<meta itemprop="position" content="2">
				</li>
			</ul>
		</div>
	</div>

	<div class="container cate-book-detail">
		<div class="row">
			<div class="col-lg-9 col-md-12 col-sm-12 col-12 flex">
				<div class="product-detail row">
					<div class="col-3">
						<a href="" class="c-img bg-white p-140" title="">
							<img src="{{ asset('storage/'.$book->img) }}" alt="" title="" class="p-3">
						</a>
					</div>
					<div class="info-product col-9">
						<h1>{{ $book->name }}</h1>

						<div class="author">
							<span>Tác giả:</span>
							@php ($string = '')
							@foreach ($book->authors as $author)
								@php ($string .= $author->name.' ,')
							@endforeach
							{{ rtrim($string, ',') }}
						</div>

						<div class="author">
							<span>Số trang: {{ $book->page_number }}</span>
						</div>

						<div class="author">
							<span>Kích thước: {{ $book->size }}</span>
						</div>

						<div class="price-cover">
							{{-- <span>Giá bìa:</span> <span>{{ number_format($book->cover_price, 0, ",", ".") }}đ</span> --}}
							<span>Giá gốc:</span> <span>{{ number_format($book->price, 0, ",", ".") }}đ</span>
						</div>
						<div class="price">
							<span>Giá:</span> <span>{{ number_format($book->price-($book->price*$book->sale/100), 0, ",", ".") }}đ</span>
						</div>

						<div class="s-content">
							<p class="d-block">
								Tiết kiệm: {{ number_format($book->price - ($book->price-($book->price*$book->sale/100)), 0, ",", ".") }}đ (Giảm {{ $book->sale }}%)
							</p>
							<p class="d-block">
								Thông tin Giao hàng:
							</p>
							<p class="d-block">
								- Nhận hàng trực tiếp.
							</p>
							<p class="d-block">
								- Giao hàng trên toàn toàn quốc.
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-12 col-sm-12 col-12 flex">
				<div class="cart-cate-book-detail">
					<!-- <h5>Chọn số lượng</h5> -->
					<form action="{{ route('page.add-to-cart', [$book->id, $book->name]) }}" method="GET">
						@csrf
						<!-- <div class="sl">
							<i class="fa fa-minus minus" aria-hidden="true"></i>
							<input type="number" value="1" class="input-number" min="1">
							<i class="fa fa-plus plus" aria-hidden="true"></i>
						</div> -->
						<button type="submit" class="add-to-cart">THÊM VÀO GIỎ
							<img src="{{ asset('images/cart2.png') }}" alt="">
						</button>
					</form>
					<p>Bạn ngại đặt hàng trên website. Gọi <a href="tel:1900 6656" title="1900 6656">1900 6656</a>, chúng tôi đặt hàng giúp bạn.</p>
				</div>
			</div>
			<div class="col-lg-9 col-md-12 col-sm-12 col-12">
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#content">Nội dung</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#author">Tác giả</a>
					</li>
				</ul>

				<div class="tab-content">
				    <div id="content" class="container tab-pane active s-content"><br>
				      	{!! $book->content !!}
				    </div>
				    <div id="author" class="container tab-pane fade s-content"><br>
				      	@foreach ($book->authors as $author)
					      	<p>Tác giả: {{ $author->name }}</p>
					      	<p>Giới tính: {{ $author->sex }}</p>
					      	<p>Ngày sinh: {{ date("d/m/Y", strtotime($author->birthday)) }}</p>
					      	<p>Tiểu sử: {!! $author->story !!}</p>
				      	@endforeach
				    </div>
				</div>

				{{-- <div class="fb-comments" data-width="100%" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-numposts="5"></div> --}}
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