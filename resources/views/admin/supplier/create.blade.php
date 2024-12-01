@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <h1 class="title-admin">Thêm nhà cung cấp</h1>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <form class="form-supplier" action="{{ route('suppliers.store') }}" method="POST" novalidate>
                    @csrf
                    @include('admin.supplier._form', ['routeType' => 'create'])
                </form>
            </div>
        </div>
    </div>
@endsection
