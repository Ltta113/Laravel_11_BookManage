@extends('layout.default')
@section('title', 'Danh sách các sách')
@section('content')
    <div class="container mt-5">
        <div class="container mt-5">
            <h1 class="mb-4 d-inline">Danh sách các sách</h1>
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

            @if (auth()->user()->role !== \App\Models\User::ROLE_USER)
                <a href="{{ route('books.create') }}" class="btn btn-primary ml-5 mb-4">Thêm Sách</a>
            @endif
        </div>

        @if ($books->isEmpty())
            <div class="alert alert-warning" role="alert">
                Không có sách nào.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Tác giả</th>
                    <th>Danh mục</th>
                    <th>Ngày tải lên</th>
                    <th>Xem</th>
                    @if (auth()->user()->role !== \App\Models\User::ROLE_USER)
                        <th>Sửa</th>
                        <th>Xóa</th>
                    @else
                        <th>Mượn Sách</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->category->name ?? 'N/A' }}</td>
                        <td>{{ $book->created_at ? \Carbon\Carbon::parse($book->created_at)->format('d/m/Y') : 'N/A' }}</td>
                        <td><a href="{{ route('books.show', $book->id) }}" class="btn btn-success ml-5 mb-4">Xem</a>
                        </td>

                        @if (auth()->user()->role !== \App\Models\User::ROLE_USER)
                            <td><a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary ml-5 mb-4">Sửa</a>
                            </td>
                            <td>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                      style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger ml-5 mb-4"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa sách này?');">
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        @else
                            <td><a href="{{ route('loans.loanBooksView', $book->id) }}"
                                   class="btn btn-warning ml-5 mb-4">Mượn Sách</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $books->links() }}
            </div>
        @endif
    </div>
@endsection
