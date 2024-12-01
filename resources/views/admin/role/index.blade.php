@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <div class="container mt-5">
            @if(session('notificationAdd'))
                <span class="alert alert-success mt-2 d-block text-center" role="alert">{{ session('notificationAdd') }}</span>
            @endif
            @if(session('notificationUpdate'))
                <span class="alert alert-success mt-2 d-block text-center" role="alert">{{ session('notificationUpdate') }}</span>
            @endif
            @if(session('notificationDelete'))
                <span class="alert alert-success mt-2 d-block text-center" role="alert">{{ session('notificationDelete') }}</span>
            @endif
            @if($errors->has('title') || $errors->has('summary') || $errors->has('img') || $errors->has('content'))
                <span class="alert alert-danger mt-2 d-block text-center" role="alert">Thêm vai trò thất bại!</span>
            @endif
            @if($errors->has('titleupdate') || $errors->has('summaryupdate') || $errors->has('imgupdate') || $errors->has('contentupdate'))
                <span class="alert alert-danger mt-2 d-block text-center" role="alert">Sửa vai trò thất bại!</span>
            @endif
            
            <h1 class="title-admin">Danh sách vai trò</h1>
        </div>
    </div>
    <div class="container mt-5">
        <a href="{{ route('admin.role.create') }}" class="btn btn-success">Thêm vai trò</a>
        <form action="{{ route('admin.role.index') }}" method="GET" class="row mt-3">
            <div class="col-3">
                <input type="text" name="key" placeholder="Tên quyền" class="form-control w-100" value="{{ request()->key }}">
            </div>
            <div class="col-2">
                <button class="btn btn-success w-75">Tìm vai trò</button>
            </div>
        </form>

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>Vai trò</th>
                                <th>Quyền hạn</th>
                                <th style="min-width: 100px">Ngày tạo</th>
                                <th style="min-width: 155px">Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php ($stt = 1) @endphp
                            @foreach ($roles as $role)
                            <tr>
                                <td class="text-center">{{ $stt++ }}</td>
                                <td>
                                    <span>{{ $role->name }}</span>
                                </td>

                                @php
                                    $listPermission = $role->permissions()->pluck('name')
                                @endphp
                                <td>
                                    @if ($role->name === 'admin')
                                        <span class="badge text-white" style="background: #7f29ab;">all permission</span>
                                    @else
                                        @foreach ($listPermission as $value)
                                            <span class="badge text-white" style="background: #7f29ab;">{{ $value }}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ date('d/m/Y', strtotime($role->created_at)) }}</td>
                                <td>
                                    <a href="{{ route('admin.role.edit', $role->id) }}" class="btn btn-warning w-25 text-white pull-left" style="margin-right: 3px;">
                                        <span>Sửa</span>
                                    </a>
                                    @if (!($role->name == 'admin'))
                                        <a href="{{ route('admin.role.destroy', $role->id) }}">
                                            <button class="btn btn-danger w-25">
                                                <span>Xóa</span>
                                            </button>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $roles->appends(['key' => $key])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
