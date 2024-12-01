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
                    <a itemprop="item"><span itemprop="name">Cập nhật thông tin cá nhân</span></a>
                    <meta itemprop="position" content="2">
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        @if (session('alert-success'))
            <div class="alert alert-success">{{ session('alert-success') }}</div>
        @endif
        @if (session('alert-error'))
            <div class="alert alert-danger">{{ session('alert-error') }}</div>
        @endif
        <form class="row" action="{{ route('user.updateProfile') }}" method="post">
            @csrf
            <div class="col-md-6" style="margin: 0 auto">
                <div class="form-group">
                    <label>Tên <span class="text-danger">(*)</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', auth()->guard('customer')->user()->name) }}">
                    {!! $errors->first('name', '<span class="help-block error">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label>Email <span class="text-danger">(*)</span></label>
                    <input type="email" name="email" class="form-control" readonly value="{{ old('email', auth()->guard('customer')->user()->email) }}">
                    {!! $errors->first('email', '<span class="help-block error">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label>Ngày sình <span class="text-danger">(*)</span></label>
                    <input type="date" name="birthday" class="form-control" value="{{ old('birthday', auth()->guard('customer')->user()->birthday) }}">
                    {!! $errors->first('birthday', '<span class="help-block error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label>Giới tính <span class="text-danger">(*)</span></label>
                    <div>
                        <input type="radio" name="sex" value="Nam" {{ auth()->guard('customer')->user()->sex == 'Nam' ? 'checked' : '' }}> Nam
                        <input type="radio" name="sex" value="Nữ" {{ auth()->guard('customer')->user()->sex == 'Nữ' ? 'checked' : '' }}> Nữ
                    </div>
                    {!! $errors->first('sex', '<span class="help-block error">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label>Sô điện thoại <span class="text-danger">(*)</span></label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', auth()->guard('customer')->user()->phone) }}">
                    {!! $errors->first('phone', '<span class="help-block error">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label>Địa chỉ <span class="text-danger">(*)</span></label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', auth()->guard('customer')->user()->address) }}">
                    {!! $errors->first('address', '<span class="help-block error">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" class="form-control">
                    {!! $errors->first('password', '<span class="help-block error">:message</span>') !!}
                </div>

                <div class="form-group text-center" style="margin-bottom: 30px;">
                    <button class="btn btn-success">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
@endsection