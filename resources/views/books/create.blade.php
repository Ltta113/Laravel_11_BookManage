@extends('layout.default')
@section('title', 'Tạo sách')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Tạo sách mới</h1>
        @if ($errors->has('error'))
            <div class="alert alert-danger">
                {{ $errors->first('error') }}
            </div>
        @endif
        <form action="{{ route('books.store') }}" method="POST">
            @csrf
            @if (session('success'))
                <div style="color: green;">
                    {{ session('success') }}
                </div>
            @endif
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="title" name="title" class="form-control form-control-lg"/>
                <div class="row">
                    <label class="form-label" for="title">Tiêu đề</label>
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                </div>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="author" name="author" class="form-control form-control-lg"/>
                <div class="row">
                    <label class="form-label" for="author">Tác giả</label>
                    @if ($errors->has('author'))
                        <span class="text-danger">{{ $errors->first('author') }}</span>
                    @endif
                </div>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <select id="category_id" name="category_id" class="form-control form-control-lg">
                    <option value="">Chọn danh mục sản phẩm</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="row">
                    <label class="form-label" for="category_id">Chọn danh mục sản phẩm</label>
                    @if ($errors->has('category_id'))
                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <a href="{{ route('books.index') }}"
                   class="btn btn-primary btn-block btn-lg gradient-custom-4 text-body">Danh sách</a>
                <button type="submit" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Tạo sách mới
                </button>
            </div>
        </form>
    </div>
@endsection
