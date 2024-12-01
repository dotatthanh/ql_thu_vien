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
					<a itemprop="item"><span itemprop="name">{{ $title }}</span></a>
					<meta itemprop="position" content="2">
				</li>
			</ul>
		</div>
	</div>

	<div class="book-noibat">
		<div class="container">
			<div class="row">
				<div class="col-md-12 order-2 col-sm-12 col-12 col-lg-8">
					<div class="title-book-highlights">
						<h1>Top nổi bật</h1>
					</div>
					
					<div class="all-featured-books">
						<?php $stt=1 ?>
						@foreach ($books as $book)
						<div class="featured-books">
							<span class="star-hl align-middle">{{ $stt++ }}</span>
							<div class="featured-book">
								<div class="img-book-hl">
									<a href="{{ route('pages.show', $book->id) }}" class="" title="{{ $book->name }}">
										<img src="{{ asset('storage/'.$book->img) }}" alt="">
									</a>
								</div>
								<div class="book-detail">
									<h3><a href="{{ route('pages.show', $book->id) }}" title="{{ $book->name }}">{{ str_limit($book->name, 45) }}</a></h3>
									@foreach ($book->authors as $author)
										<a title="{{ $author->name }}" class="author">{{ $author->name }}</a>
									@endforeach
									
									<div class="price">
										<span>Giá:</span> <span>{{ number_format($book->price, 0, ",", ".") }}₫</span>
									</div>
								</div>
							</div>
							<a href="{{ route('page.add-to-cart', [$book->id, $book->name]) }}" class="buy-now add-to-cart">MUA NGAY</a>
						</div>
						@endforeach
					</div>
					<div class="text-center">
					</div>
				</div>
				<div class="col-md-12 order-1 order-lg-12 col-sm-12 col-12 col-lg-4 cate-book-selling">
					<div class="book-selling">
						<h2>DANH MỤC SẢN PHẨM</h2>
						<ul>
							@foreach ($categories as $category)
							<li><a href="{{ route('page.category', $category->id) }}" title="{{ $category->name }}">{{ $category->name }}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
				
				
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