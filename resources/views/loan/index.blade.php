@extends('layout.default')
@section('title', 'Danh sách cho mượn')
@section('content')
    <div class="container mt-5">
        <div class="container mt-5">
            <h1 class="mb-4 d-inline">Danh sách cho mượn</h1>
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
            <a href="{{ route('loans.create') }}" class="btn btn-primary ml-5 mb-4">Cho mượn</a>
        </div>
        @if ($loans->isEmpty())
            <div class="alert alert-warning" role="alert">
                Không có sách nào.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Người mượn</th>
                        <th>Sách mượn</th>
                        <th>Ngày mượn</th>
                        <th>Ngày trả</th>
                        <th>Xem</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loans as $loan)
                        <tr>
                            <td>{{ $loan->user->name }}</td>
                            <td>{{ $loan->book->title }}</td>
                            <td>{{ $loan->start_at ? \Carbon\Carbon::parse($loan->start_at)->format('d/m/Y') : 'N/A' }}
                            </td>
                            <td>{{ $loan->end_at ? \Carbon\Carbon::parse($loan->end_at)->format('d/m/Y') : 'N/A' }}
                            </td>
                            <td><a href="{{ route('loans.show', $loan->id) }}" class="btn btn-success ml-5 mb-4">Xem</a>
                            </td>
                            <td><a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-primary ml-5 mb-4">Sửa</a>
                            </td>
                            <td>
                                <form action="{{ route('loans.destroy', $loan->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger ml-5 mb-4"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?');">
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $loans->links() }}
            </div>
        @endif
    </div>
@endsection
