@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <h1 class="title-admin">Danh sách mượn trả sách</h1>
    </div>

    <div class="container mt-5">
        <a href="{{ route('book_loans.create') }}" class="btn btn-success">Tạo đơn mượn sách</a>
        <form action="{{ route('book_loans.index') }}" method="GET" class="row mt-3">
            <div class="col-3">
                <input type="text" name="search" placeholder="Tên khách hàng" class="form-control w-100"
                    value="{{ request()->key }}">
            </div>
            <div class="col-2">
                <button class="btn btn-success w-75">Tìm kiếm</button>
            </div>
        </form>
        <table class="table table-bordered table-striped mt-3 mb-5">
            <thead>
                <tr class="text-center">
                    <th class="text-center">STT</th>
                    <th>Tên</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Ngày bắt đầu thuê</th>
                    <th>Ngày kết thúc thuê</th>
                    <th>Trạng thái</th>
                    <th style="min-width: 155px">Hành đồng</th>
                </tr>
            </thead>

            <tbody>
                @php ($stt = 1) @endphp
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $stt }}</td>
                        <td>{{ $item->customer->name }}</td>
                        <td>{{ $item->customer->phone }}</td>
                        <td>{{ $item->customer->email }}</td>
                        <td class="text-center">
                            {{ date('d-m-Y', strtotime($item->from_date)) }}</td>
                        <td class="text-center">
                            {{ date('d-m-Y', strtotime($item->to_date)) }}</td>
                        <td>
                            @if ($item->status == 1)
                                <label class="btn btn-warning waves-effect waves-light font-size-12">Chờ duyệt</label>
                            @elseif ($item->status == 2)
                                <label class="btn btn-warning waves-effect waves-light font-size-12">Đang mượn</label>
                            @elseif ($item->status == 3)
                                <label class="btn btn-success waves-effect waves-light">Đã trả</label>
                            @endif
                        </td>
                        <td class="text-center">
                            <ul class="list-inline font-size-20 contact-links mb-0">
                                @if ($item->status == 1)
                                    <li class="list-inline-item px">
                                        <form method="post" action="{{ route('book_loans.approve', $item->id) }}">
                                            @csrf

                                            <button type="submit" class="btn btn-success text-white">Duyệt</button>
                                        </form>
                                    </li>
                                    <li class="list-inline-item px">
                                        <a href="{{ route('book_loans.edit', $item->id) }}" class="btn btn-warning text-white">Sửa</a>
                                    </li>
                                @endif
                                @if ($item->status == 2)
                                    <li class="list-inline-item px">
                                        <form method="post" action="{{ route('book_loans.return_book', $item->id) }}">
                                            @csrf

                                            <button type="submit" class="btn btn-success text-white">Trả sách</button>
                                        </form>
                                    </li>
                                @endif
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {{ $data->appends(['key' => request()->key])->links() }}
        </div>
    </div>
@endsection
