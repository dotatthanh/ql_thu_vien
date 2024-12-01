@extends('layout.master')
@section('content')
	<!-- Danh mục sách -->
	<div class="container">
		<div class="row category-book">
			<div class="col-12 col-md-4 col-sm-6 col-lg-4 flex">
				<a href="{{ route('page.category_new') }}" title="" class="book-item">
					<h2>Sách</h2>
					<p>Mới ra mắt</p>
					<img title="" src="{{ asset('images/sachmoi.jpg') }}" alt="">
				</a>
			</div>
			<div class="col-12 col-md-4 col-sm-6 col-lg-4 flex">
				<a href="{{ route('page.category_sale') }}" title="" class="book-item">
					<h2>Sách</h2>
					<p>Đang khuyến mãi</p>
					<img title="" src="{{ asset('images/sachsapra.jpg') }}" alt="">
				</a>
			</div>
			<div class="col-12 col-md-4 col-sm-6 col-lg-4 flex">
				<a href="{{ route('page.tophighlight') }}" title="Sách nổi bật" class="book-item">
					<h2>Sách</h2>
					<p>Nổi bật</p>
					<img title="" src="{{ asset('images/sachbanchay.jpg') }}" alt="">
				</a>
			</div>
		</div>
	</div>

	<!-- Tiếng Việt -->
	<div class="container book-tv">
		<div class="row">
			<div class="col-12">
				<h1><a href="{{ route('page.category', $id_categoryBookTV) }}" title="Sách Tiếng Việt">Sách tiếng việt</a></h1>
			</div>
			@foreach ($bookTVs as $bookTV)
				<div class="col20 book">
					<div class="book-img">
						<img title="" src="{{ asset('storage/'.$bookTV->img) }}" alt="" class="img-item">
						<div class="hover">
							<div class="icon-book">
								<a href="{{ route('pages.show', $bookTV->id) }}" title="">
									<img title="" src="{{ asset('images/timkiem.png') }}" alt="">
								</a>
								<a href="{{ route('page.add-to-cart', [$bookTV->id, $bookTV->name]) }}" title="" class="add-to-cart">
									<img title="" src="{{ asset('images/cart.png') }}" alt="">
								</a>
							</div>
						</div>
						<!-- <span class="book-sale">New</span> -->
					</div>
					<div class="book-info">
						<h4><a href="{{ route('pages.show', $bookTV->id) }}" title="{{ $bookTV->name }}">
							{{ str_limit($bookTV->name, 25) }}
							
						</a></h4>
						@foreach ($bookTV->authors as $author)
							<p><a title="{{ $author->name }}">
								{{ $author->name }}
							</a></p>
						@endforeach
						<!-- <div class="star-base">
							<div class="star-rate" style="width:90%;"></div>
							<a href="void:javascript(0)" title=""></a>
							<a href="void:javascript(0)" title=""></a>
							<a href="void:javascript(0)" title=""></a>
							<a href="void:javascript(0)" title=""></a>
							<a href="void:javascript(0)" title=""></a>
						</div>
						<p class="vote">(2000 đánh giá)</p> -->
						<span>{{ number_format($bookTV->price-($bookTV->price*$bookTV->sale/100), 0, ",", ".") }}₫</span>
						@if ($bookTV->sale > 0)
							<strike>{{ number_format($bookTV->price, 0, ",", ".") }}đ</strike>
						@endif
					</div>
				</div>
			@endforeach
		</div>
	</div>

	<!-- Tiếng Anh -->
	<div class="container book-tv">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
				<h2><a href="{{ route('page.category', $id_categoryBookTA) }}" title="Sách Tiếng Anh">Sách tiếng anh</a></h2>
			</div>

			@foreach ($bookTAs as $bookTA)
				<div class="col20 book">
					<div class="book-img">
						<img title="" src="{{ asset('storage/'.$bookTA->img) }}" alt="" class="img-item">
						<div class="hover">
							<div class="icon-book">
								<a href="{{ route('pages.show', $bookTA->id) }}" title="">
									<img title="" src="{{ asset('images/timkiem.png') }}" alt="">
								</a>
								<a href="{{ route('page.add-to-cart', [$bookTA->id, $bookTA->name]) }}" title="" class="add-to-cart">
									<img title="" src="{{ asset('images/cart.png') }}" alt="">
								</a>
							</div>
						</div>
						<!-- <span class="book-sale">New</span> -->
					</div>
					<div class="book-info">
						<h4><a href="void:javascript(0)" title="{{ $bookTA->name }}">
						<?php
								$str = strip_tags($bookTA->name); //Lược bỏ các tags HTML
								if(strlen($str)>39) { //Đếm kí tự chuỗi $str, 25 ở đây là chiều dài bạn cần quy định
									$strCut = substr($str, 0, 39); //Cắt 25 kí tự đầu
									$str = substr($strCut, 0, strrpos($strCut, ' ')).' ... '; //Tránh trường hợp cắt dang dở như "nội d... Read More"
								}
								echo $str;
							?>
						</a></h4>
						@foreach ($bookTA->authors as $author)
							<p><a title="{{ $author->name }}">
								{{ $author->name }}
							</a></p>
						@endforeach
						<span>{{ number_format($bookTA->price-($bookTA->price*$bookTA->sale/100), 0, ",", ".") }}₫</span>
						@if ($bookTA->sale > 0)
							<strike>{{ number_format($bookTA->price, 0, ",", ".") }}đ</strike>
						@endif
					</div>
				</div>
			@endforeach
		</div>
	</div>

	<!-- Quảng cáo 1 -->
	<div class="container qc">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
				<a class="img-responsive" href="void:javascript(0)" title="">
					<img title="" src="{{ asset('images/qc.jpg') }}" alt="">
				</a>
			</div>
		</div>
	</div>

	<!-- Khuyến mãi -->
	<div class="container book-tv">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
				<h2><a href="{{ route('page.category_sale') }}" title="Sách đang khuyến mãi">Sách đang khuyến mãi</a></h2>
			</div>
			@foreach ($bookSales as $bookSale)
				<div class="col20 book">
					<div class="book-img">
						<img title="" src="{{ asset('storage/'.$bookSale->img) }}" alt="" class="img-item">
						<div class="hover">
							<div class="icon-book">
								<a href="{{ route('pages.show', $bookSale->id) }}" title="">
									<img title="" src="{{ asset('images/timkiem.png') }}" alt="">
								</a>
								<a href="{{ route('page.add-to-cart', [$bookSale->id, $bookSale->name]) }}" title="" class="add-to-cart">
									<img title="" src="{{ asset('images/cart.png') }}" alt="">
								</a>
							</div>
						</div>
						<span class="book-sale">{{ $bookSale->sale }}%</span>
					</div>
					<div class="book-info">
						<h4><a href="void:javascript(0)" title="{{ $bookSale->name }}">
							<?php
								$str = strip_tags($bookSale->name); //Lược bỏ các tags HTML
								if(strlen($str)>39) { //Đếm kí tự chuỗi $str, 25 ở đây là chiều dài bạn cần quy định
									$strCut = substr($str, 0, 39); //Cắt 25 kí tự đầu
									$str = substr($strCut, 0, strrpos($strCut, ' ')).' ... '; //Tránh trường hợp cắt dang dở như "nội d... Read More"
								}
								echo $str;
							?>
						</a></h4>
						@foreach ($bookSale->authors as $author)
							<p><a title="{{ $author->name }}">
								{{ $author->name }}
							</a></p>
						@endforeach
						<span>{{ number_format($bookSale->price-($bookSale->price*$bookSale->sale/100), 0, ",", ".") }}₫</span><strike>{{ number_format($bookSale->price, 0, ",", ".") }}đ</strike>
					</div>
				</div>
			@endforeach
		</div>
	</div>

	<!-- Nổi bật -->
	<div class="book-highlight">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="title-book-hl"><a href="{{ route('page.tophighlight') }}" title="Sách nổi bật">Sách nổi bật</a></h2>
				</div>

				@foreach ($bookHighlights as $bookHighlight)
					<div class="col-12 col-md-6 col-sm-6 col-lg-4 book-highlights">
						<div class="book-hl">
							<a href="{{ route('pages.show', $bookHighlight->id) }}" title="" class="c-img">
								<img title="" src="{{ asset('storage/'.$bookHighlight->img) }}" alt="">
							</a>
							<a href="{{ route('pages.show', $bookHighlight->id) }}" title="Xem chi tiết" class="detail">Xem chi tiết</a>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>


	<!-- Bán chạy -->
	<div class="book-tv">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12">
					<h2><a href="" title="Sách đang khuyến mãi">Sách bán chạy</a></h2>
				</div>
				
				@foreach ($book_sellings as $book_selling)
				<div class="col20 book">
					<div class="book-img">
						<img title="" src="{{ asset('storage/'.$book_selling->img) }}" alt="" class="img-item">
						<div class="hover">
							<div class="icon-book">
								<a href="{{ route('pages.show', $book_selling->id) }}" title="">
									<img title="" src="{{ asset('images/timkiem.png') }}" alt="">
								</a>
								<a href="{{ route('page.add-to-cart', [$book_selling->id, $book_selling->name]) }}" title="" class="add-to-cart">
									<img title="" src="{{ asset('images/cart.png') }}" alt="">
								</a>
							</div>
						</div>
						<!-- <span class="book-sale">New</span> -->
					</div>
					<div class="book-info">
						<h4><a href="{{ route('pages.show', $book_selling->id) }}" title="{{ $book_selling->name }}">
							{{ str_limit($book_selling->name, 25) }}
							
						</a></h4>
						@foreach ($book_selling->authors as $author)
						<p><a title="{{ $author->name }}">
							{{ $author->name }}
						</a></p>
						@endforeach
						<span>{{ number_format($book_selling->price-($book_selling->price*$book_selling->sale/100), 0, ",", ".") }}₫</span>
						@if ($book_selling->sale > 0)
							<strike>{{ number_format($book_selling->price, 0, ",", ".") }}đ</strike>
						@endif
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>

	

	<!-- Quảng cáo 2 -->
	<div class="container qc">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
				<a class="img-responsive" href="void:javascript(0)" title="">
					<img title="" src="{{ asset('images/qc2.jpg') }}" alt="">
				</a>
			</div>
		</div>
	</div>
	
	<!-- Văn học nước ta -->
	<div class="container book-tv">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
				<h2><a href="{{ route('page.category', $id_categoryBookLiterature) }}" title="Sách văn học nước ta">Sách văn học nước ta</a></h2>
			</div>
			
			@foreach ($bookLiteratures as $bookLiterature)
				<div class="col20 book">
					<div class="book-img">
						<img title="" src="{{ asset('storage/'.$bookLiterature->img) }}" alt="" class="img-item">
						<div class="hover">
							<div class="icon-book">
								<a href="{{ route('pages.show', $bookLiterature->id) }}" title="">
									<img title="" src="{{ asset('images/timkiem.png') }}" alt="">
								</a>
								<a href="{{ route('page.add-to-cart', [$bookLiterature->id, $bookLiterature->name]) }}" title="" class="add-to-cart">
									<img title="" src="{{ asset('images/cart.png') }}" alt="">
								</a>
							</div>
						</div>
						<!-- <span class="book-sale">New</span> -->
					</div>
					<div class="book-info">
						<h4><a href="void:javascript(0)" title="{{ $bookLiterature->name }}">
							<?php
								$str = strip_tags($bookLiterature->name); //Lược bỏ các tags HTML
								if(strlen($str)>39) { //Đếm kí tự chuỗi $str, 25 ở đây là chiều dài bạn cần quy định
									$strCut = substr($str, 0, 39); //Cắt 25 kí tự đầu
									$str = substr($strCut, 0, strrpos($strCut, ' ')).' ... '; //Tránh trường hợp cắt dang dở như "nội d... Read More"
								}
								echo $str;
							?>
						</a></h4>
						@foreach ($bookLiterature->authors as $author)
							<p><a title="{{ $author->name }}">
								{{ $author->name }}
							</a></p>
						@endforeach
						<span>{{ number_format($bookLiterature->price-($bookLiterature->price*$bookLiterature->sale/100), 0, ",", ".") }}₫</span>
						@if ($bookLiterature->sale > 0)
							<strike>{{ number_format($bookLiterature->price, 0, ",", ".") }}đ</strike>
						@endif
					</div>
				</div>
			@endforeach
		</div>
	</div>
	
@endsection