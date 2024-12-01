@extends('layout.app')

@section('content')
    <div class="container mt-5">
        @if(session('notificationAdd'))
            <span class="alert alert-success mt-2 d-block text-center" role="alert">{{ session('notificationAdd') }}</span>
        @endif
        @if($errors->has('titleupdate') || $errors->has('summaryupdate') || $errors->has('imgupdate') || $errors->has('contentupdate'))
            <span class="alert alert-danger mt-2 d-block text-center" role="alert">Sửa vai trò thất bại!</span>
        @endif
        
        <h1 class="title-admin">Cập nhật vai trò</h1>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <form class="row" action="{{ route('admin.role.update', $role->id) }}" method="post">
                    @csrf
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Tên <span class="text-danger">(*)</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ $role->name }}">
                                    {!! $errors->first('name', '<span class="help-block error">:message</span>') !!}
                                </div>
                                <div class="form-group">
                                    <p>Quyền hạn *</p>
                                    <div class="row">
                                        @foreach ($permissions as $permission)
                                            <div class="col-md-4">
                                                <label class="checkbox-success">
                                                    <input 
                                                        type="checkbox" 
                                                        class="listPermission"
                                                        id="permission{{ $permission->id }}"
                                                        value="{{ $permission->id }}" name="permissions[]"
                                                        @if($role->permissions->contains($permission->id)) checked=checked @endif
                                                    >
                                                    <span></span>
                                                </label>
                                                <label for="permission{{ $permission->id }}"
                                                    class="lbl-checkbox-success">{{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @include('admin.includes.form-action', ['routeIndex' => route('admin.role.index')])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
