@extends('layout.default')
@section('title', 'Thông tin cho mượn sách')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Cho mượn</h1>
        <p><strong>Người mượn:</strong> {{ $loan->user->name }}</p>
        <p><strong>Sách:</strong> {{ $loan->book->title }}</p>
        <p><strong>Ngày mượn:</strong>
            {{ $loan->start_at ? \Carbon\Carbon::parse($loan->start_at)->format('d/m/Y') : 'N/A' }}</p>
        <p><strong>Ngày trả:</strong>
            {{ $loan->end_at ? \Carbon\Carbon::parse($loan->end_at)->format('d/m/Y') : 'N/A' }}</p>

        <a href="{{ route('loans.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách cho mượn</a>
    </div>
@endsection
