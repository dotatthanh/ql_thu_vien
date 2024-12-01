@extends('layout.app')

@section('content')
    <div class="container mt-5">
        @if(session('alert-success'))
            <span class="alert alert-success mt-2 d-block text-center" role="alert">{{ session('alert-success') }}</span>
        @endif

        @if(session('alert-error'))
            <span class="alert alert-danger mt-2 d-block text-center" role="alert">{{ session('alert-error') }}</span>
        @endif
        
        <h1 class="title-admin">Thông tin cá nhân</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="row" action="{{ route('admin.update-profile') }}" method="post">
                    @csrf
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                                    {!! $errors->first('name', '<span class="help-block error">:message</span>') !!}
                                </div>
            
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                                    {!! $errors->first('email', '<span class="help-block error">:message</span>') !!}
                                </div>
            
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input type="password" name="password" class="form-control">
                                    {!! $errors->first('password', '<span class="help-block error">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @include('admin.includes.form-action', ['routeIndex' => route('admin.member.index')])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
