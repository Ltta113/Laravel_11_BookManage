@extends('layout.default')
@section('title', 'Danh sách người dùng')
@section('content')
    <div class="container mt-5">
        <div class="container mt-5">
            <h1 class="mb-4 d-inline">Danh sách người dùng</h1>
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
        </div>
        @if ($users->isEmpty())
            <div class="alert alert-warning" role="alert">
                Không có người dùng nào.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th>Ngày tạo</th>
                    <th>Xem</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') : 'N/A' }}
                        </td>
                        <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-success ml-5 mb-4">Xem</a>
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                  style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger ml-5 mb-4"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
