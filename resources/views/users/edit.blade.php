@extends('layout.default')
@section('title', 'Chỉnh sửa thông tin sách')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Chỉnh sửa thông tin cá nhân</h1>
        @if ($errors->has('error'))
            <div class="alert alert-danger">
                {{ $errors->first('error') }}
            </div>
        @endif
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            @if (session('success'))
                <div style="color: green;">
                    {{ session('success') }}
                </div>
            @endif
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="name" name="name" class="form-control form-control-lg"
                       value="{{ $user->name }}"/>
                <div class="row">
                    <label class="form-label" for="name">Tên</label>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <a href="{{ route('admin') }}"
                   class="btn btn-primary btn-block btn-lg gradient-custom-4 text-body">Trang chủ</a>
                <button type="submit" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Chỉnh sửa
                </button>
            </div>
        </form>
    </div>
@endsection
