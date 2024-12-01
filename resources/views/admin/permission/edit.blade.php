@extends('layout.app')

@section('content')
    <div class="container mt-5">
        @if(session('notificationAdd'))
            <span class="alert alert-success mt-2 d-block text-center" role="alert">{{ session('notificationAdd') }}</span>
        @endif
        @if($errors->has('title') || $errors->has('summary') || $errors->has('img') || $errors->has('content'))
            <span class="alert alert-danger mt-2 d-block text-center" role="alert">Thêm quyền thất bại!</span>
        @endif
        @if($errors->has('titleupdate') || $errors->has('summaryupdate') || $errors->has('imgupdate') || $errors->has('contentupdate'))
            <span class="alert alert-danger mt-2 d-block text-center" role="alert">Sửa quyền thất bại!</span>
        @endif
        
        <h1 class="title-admin">Sửa quyền</h1>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <form class="row" action="{{ route('admin.permission.update', $permission->id) }}" method="post">
                    @csrf
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Tên <span class="text-danger">(*)</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ $permission->name }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @include('admin.includes.form-action', ['routeIndex' => route('admin.permission.index')])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
