@extends('layout.default')
@section('title', 'Thông tin sách')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">{{ $book->title }}</h1>
        <p><strong>Tác giả:</strong> {{ $book->author }}</p>
        <p><strong>Danh mục:</strong> {{ $book->category->name }}</p>
        <p><strong>Ngày bắt đầu:</strong>
            {{ $book->created_at ? \Carbon\Carbon::parse($book->created_at)->format('d/m/Y') : 'N/A' }}</p>

        <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách sách</a>
    </div>
@endsection
