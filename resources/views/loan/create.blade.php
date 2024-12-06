@extends('layout.default')
@section('title', 'Cho mượn sách')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Cho mượn sách</h1>
        @if ($errors->has('error'))
            <div class="alert alert-danger">
                {{ $errors->first('error') }}
            </div>
        @endif
        <form action="{{ route('loans.store') }}" method="POST">
            @csrf
            @if (session('success'))
                <div style="color: green;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-outline mb-4">
                <select id="user_id" name="user_id" class="form-control form-control-lg">
                    <option value="">Chọn người mượn</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <label class="form-label" for="user_id">Người mượn</label>
                @if ($errors->has('user_id'))
                    <span class="text-danger">{{ $errors->first('user_id') }}</span>
                @endif
            </div>

            <div class="form-outline mb-4">
                <select id="book_id" name="book_id" class="form-control form-control-lg">
                    <option value="">Chọn sách</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                </select>
                <label class="form-label" for="book_id">Sách</label>
                @if ($errors->has('book_id'))
                    <span class="text-danger">{{ $errors->first('book_id') }}</span>
                @endif
            </div>

            <div class="form-outline mb-4">
                <input type="datetime-local" id="end_at" name="end_at" class="form-control form-control-lg"/>
                <label class="form-label" for="end_at">Ngày trả</label>
                @if ($errors->has('end_at'))
                    <span class="text-danger">{{ $errors->first('end_at') }}</span>
                @endif
            </div>

            <div class="d-flex justify-content-center">
                <a href="{{ route('loans.index') }}" class="btn btn-primary btn-block btn-lg">Danh sách</a>
                <button type="submit" class="btn btn-success btn-block btn-lg">Tạo mượn sách</button>
            </div>
        </form>
    </div>
@endsection
