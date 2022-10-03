@extends('partials.app')
@section('title', 'Register')
@section('content')
    <div class="limiter">
        <div class="container-login100" style="background-image: url('public/assets/images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form class="login100-form validate-form" action="{{ route('user.register') }}" method="POST">
                    @csrf
                    <span class="login100-form-title p-b-49">
                        Register
                    </span>
                    @if (session()->get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ session()->get('error') }}</strong>
                        </div>
                    @endif
                    @error('pass')
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Name is reauired">
                        <span class="label-input100">Name</span>
                        <input class="input100" type="text" name="name" placeholder="Name" autocomplete="off">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Email is reauired">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="text" name="username" placeholder="Email" autocomplete="off">
                        <span class="focus-input100" data-symbol="&#xf180;"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="pass" placeholder="Password" autocomplete="off">
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-31" data-validate="Confirm Password is required">
                        <span class="label-input100">Confirm Password</span>
                        <input class="input100" type="password" name="con_pass" placeholder="Confirm Password" autocomplete="off">
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>


                    {{-- <div class="text-right p-t-8 p-b-31">
                        <a href="#">
                            Forgot password?
                        </a>
                    </div> --}}

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Register
                            </button>
                        </div>
                    </div>

                    <div class="flex-col-c">
                        <span class="txt1 p-t-54">
                            Or Sign In Using
                        </span>

                        <a href="{{ route('login') }}" class="txt2">
                            Sign In
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>
@endsection
