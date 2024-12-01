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
                    <a itemprop="item"><span itemprop="name">Đăng ký</span></a>
                    <meta itemprop="position" content="2">
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        <form class="row" action="{{ route('user.postRegister') }}" method="post">
            @csrf
            <div class="col-md-6" style="margin: 0 auto">
                <div class="form-group">
                    <label>Tên <span class="text-danger">(*)</span></label>
                    <input type="text" name="name" class="form-control">
                    {!! $errors->first('name', '<span class="help-block error">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label>Email <span class="text-danger">(*)</span></label>
                    <input type="email" name="email" class="form-control">
                    {!! $errors->first('email', '<span class="help-block error">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label>Ngày sình <span class="text-danger">(*)</span></label>
                    <input type="date" name="birthday" class="form-control">
                    {!! $errors->first('birthday', '<span class="help-block error">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label>Giới tính <span class="text-danger">(*)</span></label>
                    <div>
                        <input type="radio" name="sex" value="Nam" checked> Nam
                        <input type="radio" name="sex" value="Nữ"> Nữ
                    </div>
                    {!! $errors->first('sex', '<span class="help-block error">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label>Số điện thoại <span class="text-danger">(*)</span></label>
                    <input type="text" name="phone" class="form-control">
                    {!! $errors->first('phone', '<span class="help-block error">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label>Địa chỉ <span class="text-danger">(*)</span></label>
                    <input type="text" name="address" class="form-control">
                    {!! $errors->first('address', '<span class="help-block error">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label>Mật khẩu <span class="text-danger">(*)</span></label>
                    <input type="password" name="password" class="form-control">
                    {!! $errors->first('password', '<span class="help-block error">:message</span>') !!}
                </div>

                <div class="form-group text-center">
                    <button class="btn btn-success">Đăng ký</button>
                </div>
                <hr>
                <p style="margin-bottom: 30px; text-align: center">Bạn đã có tài khoản 
                    <a href="{{ route('user.login') }}" style="color: blue">Đăng nhập ngay</a>
                </p>
            </div>
        </form>
    </div>
@endsection