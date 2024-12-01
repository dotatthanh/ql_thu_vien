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
					<a itemprop="item"><span itemprop="name">Diễn đàn</span></a>
					<meta itemprop="position" content="2">
				</li>
			</ul>
		</div>
	</div>

	<div class="container forum">
		<div class="row">
			<div class="col-12 col-md-12 col-sm-12 col-lg-9 news-forum">
				@foreach ($news as $new)				
				<div class="row new-forum">
					<div class="col-12 col-sm-12 col-md-4 col-lg-4 img-new-forum">
						<a href="{{ route('page.forum-detail', $new->id) }}" class="c-img hv-light">
							<img src="{{ asset('storage/'.$new->img) }}" alt="">
						</a>
						<div class="date">
							<p>{{ date_format($new->created_at,"d") }}</p>
							<p>Th{{ date_format($new->created_at,"m") }}</p>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-8 col-lg-8 text">
						<h3><a href="{{ route('page.forum-detail', $new->id) }}">
							<?php
								$str = strip_tags($new->title); //Lược bỏ các tags HTML
								if(strlen($str)>64) { //Đếm kí tự chuỗi $str, 64 ở đây là chiều dài bạn cần quy định
									$strCut = substr($str, 0, 64); //Cắt 64 kí tự đầu
									$str = substr($strCut, 0, strrpos($strCut, ' ')).' ... '; //Tránh trường hợp cắt dang dở như "nội d... Read More"
								}
								echo $str;
							?>
						</a></h3>

						<p>
							<?php
								$str = strip_tags($new->summary); //Lược bỏ các tags HTML
								if(strlen($str)>730) { //Đếm kí tự chuỗi $str, 730 ở đây là chiều dài bạn cần quy định
									$strCut = substr($str, 0, 730); //Cắt 730 kí tự đầu
									$str = substr($strCut, 0, strrpos($strCut, ' ')).' ... '; //Tránh trường hợp cắt dang dở như "nội d... Read More"
								}
								echo $str;
							?>
						</p>
					</div>
				</div>
				@endforeach
				<div class="text-center">
					{{ $news->links() }}
				</div>
				<!-- <div class="see-more">
					<a href="#" title="">Xem thêm</a>
				</div> -->
			</div>
			<div class="col-12 col-md-12 col-sm-12 col-lg-3 new-book-good">
				<h2 class="title-book-good">Tin sách khác</h2>
				<ul>
					@foreach ($random as $news)
					<li>
						<h3><a href="{{ route('page.forum-detail', $news->id) }}">
							<?php
								$str = strip_tags($news->title); //Lược bỏ các tags HTML
								if(strlen($str)>70) { //Đếm kí tự chuỗi $str, 70 ở đây là chiều dài bạn cần quy định
									$strCut = substr($str, 0, 70); //Cắt 70 kí tự đầu
									$str = substr($strCut, 0, strrpos($strCut, ' ')).' ... '; //Tránh trường hợp cắt dang dở như "nội d... Read More"
								}
								echo $str;
							?>
						</a></h3>
						<p>
							<?php
								$str = strip_tags($news->summary); //Lược bỏ các tags HTML
								if(strlen($str)>200) { //Đếm kí tự chuỗi $str, 200 ở đây là chiều dài bạn cần quy định
									$strCut = substr($str, 0, 200); //Cắt 200 kí tự đầu
									$str = substr($strCut, 0, strrpos($strCut, ' ')).' ... '; //Tránh trường hợp cắt dang dở như "nội d... Read More"
								}
								echo $str;
							?>
						</p>
					</li>
					@endforeach
				</ul>
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