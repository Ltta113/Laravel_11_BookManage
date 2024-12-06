@extends('layout.default')
@section('title', 'Đăng ký tài khoản')
@section('content')
    <div class="container h-70">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center mb-5">Đăng nhập Admin</h2>
                        @if ($errors->has('error'))
                            <div class="alert alert-danger">
                                {{ $errors->first('error') }}
                            </div>
                        @endif
                        <form action="{{ route('loginWeb.post') }}" method="POST">
                            @csrf
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="email" name="email" class="form-control form-control-lg" />
                                <div class="row">
                                    <label class="form-label" for="email">Email của bạn</label>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="password" name="password"
                                    class="form-control form-control-lg" />
                                <div class="row">
                                    <label class="form-label" for="password">Mật khẩu</label>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Đăng nhập</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
