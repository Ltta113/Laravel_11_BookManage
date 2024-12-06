@extends('layout.default')
@section('title', 'Thông tin danh mục')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">{{ $category->name }}</h1>
        <p><strong>Ngày tạo:</strong>
            {{ $category->created_at ? \Carbon\Carbon::parse($category->created_at)->format('d/m/Y') : 'N/A' }}</p>

        <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách danh mục</a>
    </div>
@endsection
