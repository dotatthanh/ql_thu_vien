@extends('layout.master')
@section('content')

	<div class="container book-tv pt-3">
		<div class="row">
			<div class="col-12">
				<h1>Tìm kiếm sách</h1>
			</div>
			
			@if(count($books) == 0)
				<p class="h5 mt-3 pl-3">Không tìm thấy kết quả nào!</p>
			@endif
			@foreach ($books as $book)
				<div class="col20 book">
					<div class="book-img">
						<img title="" src="{{ asset('storage/'.$book->img) }}" alt="" class="img-item">
						<div class="hover">
							<div class="icon-book">
								<a href="{{ route('pages.show', $book->id) }}" title="">
									<img title="" src="{{ asset('images/timkiem.png') }}" alt="">
								</a>
								<a href="{{ route('page.add-to-cart', [$book->id, $book->name]) }}" title="">
									<img title="" src="{{ asset('images/cart.png') }}" alt="">
								</a>
							</div>
						</div>
						<!-- <span class="book-sale">New</span> -->
					</div>
					<div class="book-info">
						<h4><a href="{{ route('pages.show', $book->id) }}" title="{{ $book->name }}">
							<?php
								$str = strip_tags($book->name); //Lược bỏ các tags HTML
								if(strlen($str)>39) { //Đếm kí tự chuỗi $str, 25 ở đây là chiều dài bạn cần quy định
									$strCut = substr($str, 0, 39); //Cắt 25 kí tự đầu
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
						<span>{{ number_format($book->price-($book->price*$book->sale/100), 0, ",", ".") }} ₫</span><strike>{{ number_format($book->cover_price, 0, ",", ".") }} đ</strike>
					</div>
				</div>
			@endforeach
		</div>
	</div>
	
@endsection