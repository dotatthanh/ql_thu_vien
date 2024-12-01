@extends('layout.master')
@section('content')
	
	<div class="container">
		<div class="list-item">
			<ul class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="{{ route('pages.index') }}"><span itemprop="name">Trang chủ</span></a>
					<meta itemprop="position" content="1">
				</li>
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
					<a itemprop="item"><span itemprop="name">Danh mục Sách mới ra mắt</span></a>
					<meta itemprop="position" content="2">
				</li>
			</ul>
		</div>
	</div>

	<div class="container cate-book">
		<div class="row">
			<div class="order-2 col-md-12 col-sm-12 col-12 col-lg-8">
				<div class="title-book-highlights">
					<h1>Sách mới ra mắt</h1>
					<!-- <form action="">
						<select name="" id="">
							<option value="">-- Chọn đầu sách --</option>
							<option value="">Sách kinh tế/ Kinh doanh</option>
							<option value="">Trong tuần</option>
							<option value="">Trong tuần</option>
						</select>
					</form> -->
				</div>
				
				<div class="row cate-books row10">
					@if(count($books) == 0)
						<p class="h5 mt-3 pl-3">Không tìm thấy kết quả nào!</p>
					@endif
					@foreach ($books as $book)
						<div class="col-md-4 col-sm-6 col-12 col-lg-3 pad10">
							<div class="book">
								<div class="book-img">
									<div class="img-item">
										<a href="" class="c-img">
											<img title="" src="{{ asset('storage/'.$book->img) }}" alt="" class=""><!-- img-item -->
										</a>
									</div>
									<div class="hover">
										<div class="icon-book">
											<a href="{{ route('pages.show', $book->id) }}" title="">
												<img title="" src="{{ asset('images/timkiem.png') }}" alt="">
											</a>
											<a href="{{ route('page.add-to-cart', [$book->id, $book->name]) }}" title="" class="add-to-cart">
												<img title="" src="{{ asset('images/cart.png') }}" alt="">
											</a>
										</div>
									</div>
									<span class="book-sale">New</span>
								</div>
								<div class="book-info">
									<h4><a href="{{ route('pages.show', $book->id) }}" title="{{ $book->name }}">
										<?php
											$str = strip_tags($book->name); //Lược bỏ các tags HTML
											if(strlen($str)>32) { //Đếm kí tự chuỗi $str, 25 ở đây là chiều dài bạn cần quy định
												$strCut = substr($str, 0, 32); //Cắt 25 kí tự đầu
												$str = substr($strCut, 0, strrpos($strCut, ' ')).' ... '; //Tránh trường hợp cắt dang dở như "nội d... Read More"
											}
											echo $str;
										?>
									</a></h4>
									@foreach ($book->authors as $author)
										<p><a title="{{ $author->name }}">
											{{ $author->name }}
										</a></p>
									@endforeach
									<!-- <div class="star-base">
										<div class="star-rate" style="width:90%;"></div>
										<a href="#" title=""></a>
										<a href="#" title=""></a>
										<a href="#" title=""></a>
										<a href="#" title=""></a>
										<a href="#" title=""></a>
									</div>
									<p class="vote">(2000 đánh giá)</p> -->
									<span>{{ number_format($book->price-($book->price*$book->sale/100), 0, ",", ".") }}₫</span>
									@if ($book->sale > 0)
									<strike>{{ number_format($book->price, 0, ",", ".") }}đ</strike>
									@endif
								</div>
							</div>
						</div>
					@endforeach
				</div>
				<div class="text-center">
					{{ $books->appends(['key' => $request->key])->links() }}
				</div>
				<!-- <div class="see-more">
					<a href="#" title="">Xem thêm</a>
				</div> -->
			</div>
			<div class="order-1 order-lg-12 col-md-12 col-sm-12 col-12 col-lg-4 cate-book-selling">
				<div class="search-cate-book">
					<form action="{{ route('page.category_new') }}" method="GET">
						<input type="text" name="key" placeholder="Bạn muốn tìm sách?">
						<button type="submit">
							<img title="" src="{{ asset('images/timkiem.png') }}" alt="">
						</button>
					</form>
				</div>
				<div class="book-selling">
					<h2>DANH MỤC SẢN PHẨM</h2>
					<ul>
						@foreach ($categories as $category)
							<li><a href="{{ route('page.category', $category->id) }}" title="{{ $category->name }}">{{ $category->name }}</a></li>
						@endforeach
					</ul>
				</div>
				<!-- <div class="filter">
					<h4>LỌC THEO GIÁ</h4>

					<div class="slider-filter">
						<div id="slider-range"></div>
						<form action="#">
							<label for="amount">Giá:</label>
							<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
							<button>Lọc</button>
						</form>
					</div>
				</div> -->
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