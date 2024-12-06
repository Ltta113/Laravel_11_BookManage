@extends('layout.default')
@section('title', 'Thông tin người dùng')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">{{ $user->name }}</h1>
        <p><strong>Tên người dùng:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Ngày tạo:</strong>
            {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') : 'N/A' }}</p>

        <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách người dùng</a>
    </div>
@endsection
