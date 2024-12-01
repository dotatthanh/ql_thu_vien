@extends('layout.app')

@section('content')
    <div class="container mt-5">
        @if(session('alert-success'))
            <span class="alert alert-success mt-2 d-block text-center" role="alert">{{ session('alert-success') }}</span>
        @endif

        @if(session('alert-error'))
            <span class="alert alert-danger mt-2 d-block text-center" role="alert">{{ session('alert-error') }}</span>
        @endif
        
        <h1 class="title-admin">Thêm khách hàng</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="row" action="{{ route('admin.customer.store') }}" method="post">
                    @csrf
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Tên <span class="text-danger">(*)</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    {!! $errors->first('name', '<span class="help-block error">:message</span>') !!}
                                </div>
            
                                <div class="form-group">
                                    <label>Email <span class="text-danger">(*)</span></label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                    {!! $errors->first('email', '<span class="help-block error">:message</span>') !!}
                                </div>

                                <div class="form-group">
                                    <label>Ngày sình <span class="text-danger">(*)</span></label>
                                    <input type="date" name="birthday" class="form-control" value="{{ old('birthday') }}">
                                    {!! $errors->first('birthday', '<span class="help-block error">:message</span>') !!}
                                </div>

                                <div class="form-group">
                                    <label>Giới tính <span class="text-danger">(*)</span></label>
                                    <div>
                                        <input type="radio" name="sex" value="Nam" {{ old('sex') == 'Nam' ? 'checked' : '' }}> Nam
                                        <input type="radio" name="sex" value="Nữ" {{ old('sex') == 'Nữ' ? 'checked' : '' }}> Nữ
                                    </div>
                                    {!! $errors->first('sex', '<span class="help-block error">:message</span>') !!}
                                </div>

                                <div class="form-group">
                                    <label>Số điện thoại <span class="text-danger">(*)</span></label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                    {!! $errors->first('phone', '<span class="help-block error">:message</span>') !!}
                                </div>

                                <div class="form-group">
                                    <label>Địa chỉ <span class="text-danger">(*)</span></label>
                                    <input type="text" name="address" class="form-control" value="{{ old('addressP') }}">
                                    {!! $errors->first('address', '<span class="help-block error">:message</span>') !!}
                                </div>
                                <div class="form-group">
                                    <label>Mật khẩu <span class="text-danger">(*)</span></label>
                                    <input type="password" name="password" class="form-control">
                                    {!! $errors->first('password', '<span class="help-block error">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @include('admin.includes.form-action', ['routeIndex' => route('admin.customer.index')])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
