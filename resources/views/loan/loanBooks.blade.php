@extends('layout.default')
@section('title', 'Mượn sách')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Mượn sách</h1>

        @if ($errors->has('error'))
            <div class="alert alert-danger">
                {{ $errors->first('error') }}
            </div>
        @endif

        <form action="{{ route('loans.userLoanBooks') }}" method="POST">
            @csrf

            <div class="form-outline mb-4">
                <label class="form-label" for="book_title">Sách</label>
                <p class="form-control form-control-lg">{{ $book->title }}</p>
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="author">Tác giả</label>
                <p class="form-control form-control-lg">{{ $book->author }}</p>
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="category">Danh mục</label>
                <p class="form-control form-control-lg">{{ $book->category->name ?? 'N/A' }}</p>
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="uploaded_at">Ngày tải lên</label>
                <p class="form-control form-control-lg">{{ \Carbon\Carbon::parse($book->created_at)->format('d/m/Y') }}</p>
            </div>

            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <div class="form-outline mb-4">
                <label class="form-label" for="end_at">Ngày trả</label>
                <input type="datetime-local" id="end_at" name="end_at" class="form-control form-control-lg"/>
                @if ($errors->has('end_at'))
                    <span class="text-danger">{{ $errors->first('end_at') }}</span>
                @endif
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success btn-block btn-lg">Mượn sách</button>
            </div>
        </form>
    </div>
@endsection
