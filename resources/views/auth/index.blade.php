@extends('layout.default')
@section('title', 'Trang chủ admin')
@section('content')
    <h1>Trang Admin</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first('error') }}
        </div>
    @endif
@endsection
