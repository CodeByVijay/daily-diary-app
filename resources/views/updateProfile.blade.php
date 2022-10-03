@extends('partials.app')
@section('title', 'Home')
@section('content')
    @push('style')
        <style>
            .dropLink {
                display: block !important;
                padding: 0.5rem 4rem !important;
            }

            .mainDiv {
                position: absolute;
            }

            .footer {
                position: sticky;
                bottom: 0;
                text-align: center;
                padding: 10px;
                background-color: antiquewhite
            }

            .form-control:focus {
                color: #495057 !important;
                background-color: #fff !important;
                border-color: #80bdff !important;
                outline: 0 !important;
            }

            #pass1,
            #pass2 {
                display: none;
            }
        </style>
    @endpush
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"> <img src="{{ asset('public/assets/images/icons/favicon.png') }}" width="30"
                height="30" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('user.home') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.expense') }}">Get Expense</a>
                </li>


            </ul>
            <ul class="my-2 my-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropLink dropdown-toggle" href="{{ route('profile') }}" id="navbarDropdown"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid mainDiv mt-4">


        @error('pass')
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @enderror

        <form action="{{ route('user.profile') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
            <div class="card">
                <div class="card-header">Update Profile</div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name"
                                    value="{{ $profile->name }}" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4" id="pass1">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="pass" autocomplete="off" class="form-control" placeholder="Password">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4" id="pass2">
                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input type="password" name="con_pass" class="form-control" placeholder="Confirm Password" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div id="passUpdate">
                                <button type="button" class="btn btn-info">Password Change</button>
                            </div>
                        </div>

                        <div class="btn w-100">
                            <button type="submit" class="btn btn-success mt-5">Update</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

        <div class="footer mt-4">
            <div class="foot">
                <h6>&copy; 2022 - <?= date('Y') ?> <a href="#">Vicky Digital Solutions</a></h6>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            //
            $('#passUpdate').on('click', function() {
                $('#pass1').toggle();
                $('#pass2').toggle();
            })
        });
    </script>
@endpush
