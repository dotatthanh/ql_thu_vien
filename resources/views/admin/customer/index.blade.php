@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <h1 class="title-admin">Danh sách khách hàng</h1>
    </div>

    <div class="container mt-5">
        <form action="{{ route('admin.customer.index') }}" method="GET" class="row mt-3">
            <div class="col-3">
                <input type="text" name="key" placeholder="Tên khách hàng" class="form-control w-100" value="{{ request()->key }}">
            </div>
            <div class="col-2">
                <button class="btn btn-success w-75">Tìm kiếm</button>
            </div>
        </form>
        <table class="table table-bordered table-striped mt-3 mb-5">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th style="min-width: 100px">Ngày tạo</th>
                    <th style="min-width: 155px">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @php ($stt = 1) @endphp
                @foreach ($customers as $item)
                <tr>
                    <td>{{ $stt++ }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ isset($item->birthday) ? date('d/m/Y', strtotime($item->birthday)) : '' }}</td>
                    <td>{{ $item->sex }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                    <td>
                        <a href="{{ route('admin.customer.edit', $item->id) }}" class="btn btn-warning text-white pull-left" style="margin-right: 3px;">
                            <span>Sửa</span>
                        </a>
                        <a href="{{ route('admin.customer.destroy', $item->id) }}">
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
            {{ $customers->appends(['key' => request()->key])->links() }}
        </div>
    </div>
@endsection