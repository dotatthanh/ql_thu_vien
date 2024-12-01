@extends('layout.app')

@section('content')
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
            <span class="alert alert-danger mt-2 d-block text-center" role="alert">Thêm quyền thất bại!</span>
        @endif
        @if($errors->has('titleupdate') || $errors->has('summaryupdate') || $errors->has('imgupdate') || $errors->has('contentupdate'))
            <span class="alert alert-danger mt-2 d-block text-center" role="alert">Sửa quyền thất bại!</span>
        @endif
        
        <h1 class="title-admin">Danh sách quyền</h1>
    </div>

    <div class="container mt-5">
        <a href="{{ route('admin.permission.create') }}" class="btn btn-success">Thêm quyền</a>
        <form action="{{ route('admin.permission.index') }}" method="GET" class="row mt-3">
            <div class="col-3">
                <input type="text" name="key" placeholder="Tên quyền" class="form-control w-100" value="{{ request()->key }}">
            </div>
            <div class="col-2">
                <button class="btn btn-success w-75">Tìm kiếm</button>
            </div>
        </form>

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th style="min-width: 100px">Ngày tạo</th>
                                <th style="min-width: 155px">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <span>{{ $item->name }}</span>    
                                </td> 
                                <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                <td>
                                    <a href="{{ route('admin.permission.edit', $item->id) }}" class="btn btn-warning w-25 text-white pull-left" style="margin-right: 3px;">
                                        <span>Sửa</span>
                                    </a>
            
                                    <a href="{{ route('admin.permission.destroy', $item->id) }}">
                                        <button class="btn btn-danger w-25">
                                            <span>Xóa</span>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $permissions->appends(['key' => $key])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection