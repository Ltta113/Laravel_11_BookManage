@extends('layout.default')
@section('title', 'Chỉnh sửa thông tin sách')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Chỉnh sửa sách</h1>
        @if ($errors->has('error'))
            <div class="alert alert-danger">
                {{ $errors->first('error') }}
            </div>
        @endif
        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')
            @if (session('success'))
                <div style="color: green;">
                    {{ session('success') }}
                </div>
            @endif
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="title" name="title" class="form-control form-control-lg"
                       value="{{ $book->title }}"/>
                <div class="row">
                    <label class="form-label" for="title">Tiêu đề</label>
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                </div>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="author" name="author" class="form-control form-control-lg"
                       value="{{ $book->author }}"/>
                <div class="row">
                    <label class="form-label" for="author">Tác giả</label>
                    @if ($errors->has('author'))
                        <span class="text-danger">{{ $errors->first('author') }}</span>
                    @endif
                </div>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="category_id">Chọn danh mục sản phẩm</label>
                <select id="category_id" name="category_id" class="form-control form-control-lg">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('category_id'))
                    <span class="text-danger">{{ $errors->first('category_id') }}</span>
                @endif
            </div>

            <div class="d-flex justify-content-center">
                <a href="{{ route('books.index') }}"
                   class="btn btn-primary btn-block btn-lg gradient-custom-4 text-body">Danh sách</a>
                <button type="submit" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Chỉnh sửa
                </button>
            </div>
        </form>
    </div>
@endsection
