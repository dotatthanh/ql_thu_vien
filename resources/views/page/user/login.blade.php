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
                    <a itemprop="item"><span itemprop="name">Đăng nhập</span></a>
                    <meta itemprop="position" content="2">
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        @if (Session::has('alert-success'))
            <div class="alert alert-success">{{ Session::get('alert-success') }}</div>
        @endif
        <form class="row" action="{{ route('user.postLogin') }}" method="post">
            @csrf
            <div class="col-md-6" style="margin: 0 auto">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                    {!! $errors->first('email', '<span class="help-block error">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" class="form-control">
                    {!! $errors->first('password', '<span class="help-block error">:message</span>') !!}
                </div>

                <div class="form-group text-center">
                    <button class="btn btn-success">Đăng nhập</button>
                </div>
                <hr>
                <p style="margin-bottom: 30px; text-align: center">Bạn chưa có tài khoản? 
                    <a href="{{ route('user.register') }}" style="color: blue">Đăng ký ngay</a>
                </p>
            </div>
        </form>
    </div>
@endsection