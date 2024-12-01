@extends('layout.app')

@section('content')
    <div class="container mt-5">
        @if(session('notificationAdd'))
            <span class="alert alert-success mt-2 d-block text-center" role="alert">{{ session('notificationAdd') }}</span>
        @endif
        @if(session('alert-success'))
            <span class="alert alert-success mt-2 d-block text-center" role="alert">{{ session('alert-success') }}</span>
        @endif
        @if($errors->has('title') || $errors->has('summary') || $errors->has('img') || $errors->has('content'))
            <span class="alert alert-danger mt-2 d-block text-center" role="alert">Thêm sách thất bại!</span>
        @endif
        @if($errors->has('titleupdate') || $errors->has('summaryupdate') || $errors->has('imgupdate') || $errors->has('contentupdate'))
            <span class="alert alert-danger mt-2 d-block text-center" role="alert">Sửa sách thất bại!</span>
        @endif
        
        <h1 class="title-admin">Danh sách nhân viên</h1>
    </div>

    <div class="container mt-5">
        <a href="{{ route('admin.member.create') }}" class="btn btn-success">Thêm nhân viên</a>
        <form action="{{ route('admin.member.index') }}" method="GET" class="row mt-3">
            <div class="col-3">
                <input type="text" name="key" placeholder="Tên nhân viên" class="form-control w-100" value="{{ request()->key }}">
            </div>
            <div class="col-2">
                <button class="btn btn-success w-75">Tìm kiếm</button>
            </div>
        </form>
        <table class="table table-bordered table-striped mt-3 mb-5">
            <thead>
                <tr class="text-center">
                    <th>STT</th>
                    <th>Mã</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th style="min-width: 100px">Ngày tạo</th>
                    <th>Vai trò</th>
                    <th style="min-width: 155px">Hành đồng</th>
                </tr>
            </thead>

            <tbody>
                @php ($stt =1) @endphp
                @foreach ($members as $item)
                <tr>
                    <td class="text-center">{{ $stt++ }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ date('d/m/Y', strtotime($item->birthday)) }}</td>
                    <td>{{ $item->sex }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>

                    @php 
                        $listRole = $item->roles()->pluck('name')
                    @endphp
                    <td>
                        @foreach ($listRole as $value)
                            <span class="badge badge-dark text-white">{{ $value }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.member.edit', $item->id) }}" class="btn btn-warning text-white pull-left" style="margin-right: 3px;">
                            <span>Sửa</span>
                        </a>
                        <a href="{{ route('admin.member.destroy', $item->id) }}">
                            <button class="btn btn-danger">
                                <span>Xóa</span>
                            </button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {{ $members->appends(['key' => request()->key])->links() }}
        </div>
    </div>
@endsection