@extends('layout.default')
@section('title', 'Chỉnh sửa mượn sách')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Chỉnh sửa mượn sách</h1>
        @if ($errors->has('error'))
            <div class="alert alert-danger">
                {{ $errors->first('error') }}
            </div>
        @endif
        <form action="{{ route('loans.update', $loan->id) }}" method="POST">
            @csrf
            @method('PUT')

            @if (session('success'))
                <div style="color: green;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-outline mb-4">
                <select id="user_id" name="user_id" class="form-control form-control-lg">
                    <option value="">Chọn người mượn</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $loan->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                <label class="form-label" for="user_id">Người mượn</label>
                @if ($errors)
                    <span class="text-danger">{{ $errors->first('book_id') }}</span>
                @endif
            </div>

            <div class="form-outline mb-4">
                <select id="book_id" name="book_id" class="form-control form-control-lg">
                    <option value="">Chọn sách</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}" {{ $loan->book_id == $book->id ? 'selected' : '' }}>
                            {{ $book->title }}
                        </option>
                    @endforeach
                </select>
                <label class="form-label" for="book_id">Sách</label>
                @if ($errors->has('book_id'))
                    <span class="text-danger">{{ $errors->first('book_id') }}</span>
                @endif
            </div>

            <div class="form-outline mb-4">
                <input type="datetime-local" id="end_at" name="end_at" class="form-control form-control-lg"
                       value="{{ old('end_at', $loan->end_at ? \Carbon\Carbon::parse($loan->end_at)->format('Y-m-d\TH:i') : '') }}"/>
                <label class="form-label" for="end_at">Ngày trả</label>
                @if ($errors->has('end_at'))
                    <span class="text-danger">{{ $errors->first('end_at') }}</span>
                @endif
            </div>

            <div class="d-flex justify-content-center">
                <a href="{{ route('loans.index') }}" class="btn btn-primary btn-block btn-lg">Danh sách</a>
                <button type="submit" class="btn btn-success btn-block btn-lg">Cập nhật mượn sách</button>
            </div>
        </form>
    </div>
@endsection
