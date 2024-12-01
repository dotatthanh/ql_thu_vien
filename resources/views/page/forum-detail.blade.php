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
					<a itemprop="item" href="{{ route('page.forum') }}"><span itemprop="name">Diễn đàn</span></a>
					<meta itemprop="position" content="2">
				</li>
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
					<a itemprop="item"><span itemprop="name">{{ $news->title }}</span></a>
					<meta itemprop="position" content="3">
				</li>
			</ul>
		</div>
	</div>

	<div class="container forum-detail pb-3">
		<div class="row">
			<div class="col-md-12 col-lg-9 new-forum-detail">
				<h1 class="title-news">{{ $news->title }}</h1>
				<span class="time">{{ date_format($news->created_at, "h:i") }} - Ngày {{ date_format($news->created_at, "d/m/Y") }}</span>
				<p class="quote">{!! $news->summary !!}</p>
				<div class="s-content">
					{!! $news->content !!}
				</div>


				{{-- <div class="fb-comments" data-width="100%" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-numposts="5"></div> --}}
			</div>
			<div class="col-md-12 col-lg-3 new-book-good">
				<h2 class="title-book-good">Tin sách hay</h2>
				<ul>
					@foreach ($random as $news)
					<li>
						<h3><a href="{{ route('page.forum-detail', $news->id) }}">{{ $news->title }}</a></h3>
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
				<img title="" src="{{ asset('images/qc-forum-detail1.jpg') }}" alt="">
				<img title="" src="{{ asset('images/qc-forum-detail2.jpg') }}" alt="">
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