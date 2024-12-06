@extends('layout.default')
@section('title', 'Tạo danh mục')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Tạo danh mục mới</h1>
        @if ($errors->has('error'))
            <div class="alert alert-danger">
                {{ $errors->first('error') }}
            </div>
        @endif
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            @if (session('success'))
                <div style="color: green;">
                    {{ session('success') }}
                </div>
            @endif
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="name" name="name" class="form-control form-control-lg"/>
                <div class="row">
                    <label class="form-label" for="name">Tên danh mục</label>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <a href="{{ route('categories.index') }}"
                   class="btn btn-primary btn-block btn-lg gradient-custom-4 text-body">Danh sách</a>
                <button type="submit" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Tạo danh mới mới
                </button>
            </div>
        </form>
    </div>
@endsection
