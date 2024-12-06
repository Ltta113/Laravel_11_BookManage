@extends('layout.default')
@section('title', 'Danh sách danh mục')
@section('content')
    <div class="container mt-5">
        <div class="container mt-5">
            <h1 class="mb-4 d-inline">Danh sách danh mục</h1>
            @if (session('Log'))
                <div class="alert alert-success">
                    {{ session('Log') }}
                </div>
            @endif

            @if ($errors->has('error'))
                <div class="alert alert-danger">
                    {{ $errors->first('error') }}
                </div>
            @endif
            <a href="{{ route('categories.create') }}" class="btn btn-primary ml-5 mb-4">Thêm Danh mục</a>
        </div>
        @if ($categories->isEmpty())
            <div class="alert alert-warning" role="alert">
                Không có danh mục nào.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Tên danh mục</th>
                    <th>Xem</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td><a href="{{ route('categories.show', $category->id) }}" class="btn btn-success ml-5 mb-4">Xem</a>
                        </td>
                        <td><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary ml-5 mb-4">Sửa</a>
                        </td>
                        <td>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                  style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger ml-5 mb-4"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa danh này và tất cả các sách có danh mục này?');">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection
