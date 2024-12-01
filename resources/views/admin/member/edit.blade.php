@extends('layout.app')

@section('content')
    <div class="container mt-5">
        @if(session('notificationAdd'))
            <span class="alert alert-success mt-2 d-block text-center" role="alert">{{ session('notificationAdd') }}</span>
        @endif
        @if($errors->has('title') || $errors->has('summary') || $errors->has('img') || $errors->has('content'))
            <span class="alert alert-danger mt-2 d-block text-center" role="alert">Thêm nhân viên thất bại!</span>
        @endif
        @if($errors->has('titleupdate') || $errors->has('summaryupdate') || $errors->has('imgupdate') || $errors->has('contentupdate'))
            <span class="alert alert-danger mt-2 d-block text-center" role="alert">Sửa nhân viên thất bại!</span>
        @endif
        
        <h1 class="title-admin">Sửa nhân viên</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="row" action="{{ route('admin.member.update', $user->id) }}" method="post">
                    @csrf
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body">
                                {{-- <div class="form-group">
                                    <label>Mã <span class="text-danger">(*)</span></label>
                                    <input type="text" name="code" class="form-control" value="{{ $user->code }}">
                                    {!! $errors->first('code', '<span class="help-block error">:message</span>') !!}
                                </div> --}}

                                <div class="form-group">
                                    <label>Tên <span class="text-danger">(*)</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                    {!! $errors->first('name', '<span class="help-block error">:message</span>') !!}
                                </div>

                                <div class="form-group">
                                    <label>Email <span class="text-danger">(*)</span></label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                    {!! $errors->first('email', '<span class="help-block error">:message</span>') !!}
                                </div>

                                <div class="form-group">
                                    <label>Ngày sình <span class="text-danger">(*)</span></label>
                                    <input type="date" name="birthday" class="form-control" value="{{ $user->birthday }}">
                                    {!! $errors->first('birthday', '<span class="help-block error">:message</span>') !!}
                                </div>

                                <div class="form-group">
                                    <label>Giới tính <span class="text-danger">(*)</span></label>
                                    <div>
                                        <input type="radio" name="sex" value="Nam" {{ $user->sex == 'Nam' ? 'checked' : '' }}> Nam
                                        <input type="radio" name="sex" value="Nữ" {{ $user->sex == 'Nữ' ? 'checked' : '' }}> Nữ
                                    </div>
                                    {!! $errors->first('sex', '<span class="help-block error">:message</span>') !!}
                                </div>

                                <div class="form-group">
                                    <label>Số điện thoại <span class="text-danger">(*)</span></label>
                                    <input type="number" name="phone" class="form-control" value="{{ $user->phone }}">
                                    {!! $errors->first('phone', '<span class="help-block error">:message</span>') !!}
                                </div>

                                <div class="form-group">
                                    <label>Địa chỉ <span class="text-danger">(*)</span></label>
                                    <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                                    {!! $errors->first('address', '<span class="help-block error">:message</span>') !!}
                                </div>
            
                                <div class='form-group'>
                                    <p class="mr-3">Vai trò</p>
                                    <select 
                                        name="roles[]" 
                                        id="addRole" 
                                        class="select2 select2Role form-control"
                                        multiple
                                    >
                                    @foreach ($roles as $item)
                                        <option 
                                        @if (in_array($item->id, $user->roles->pluck('id')->toArray()))
                                            selected
                                        @endif
                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach        
                                </select>
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
                        @include('admin.includes.form-action', ['routeIndex' => route('admin.member.index')])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
