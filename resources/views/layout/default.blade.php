<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'My app')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin') }}">Admin Page</a>
        @if (Auth::check())
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    @if(auth()->user()->role !== \App\Models\User::ROLE_USER)
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('books.index') }}">Sách</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('categories.index') }}">Danh mục</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('users.index') }}">Người dùng</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('loans.index') }}">Cho mượn</a>
                        </li>
                    @endif
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('users.edit') }}">Chỉnh sửa thông tin cá nhân</a>
                    </li>
                    @if (auth()->user()->role === \App\Models\User::ROLE_USER)
                        <li class="nav-item active mr-4">
                            <a class="nav-link" href="{{ route('books.index') }}">Sách</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('loans.userIndex') }}">Sách đã mượn</a>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
        <div class="d-flex">
            @if (Auth::check())
                <span class="navbar-text me-3">Chào, {{ Auth::user()->name }}!</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link">Logout</button>
                </form>
            @else
                <a class="btn btn-primary" href="{{ route('loginWeb') }}">Login</a>
                <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
            @endif
        </div>
    </div>
</nav>


<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>
