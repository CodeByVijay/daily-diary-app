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
                    <a class="nav-link dropLink dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('profile')}}">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid mainDiv mt-4">
        @if (session()->get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ session()->get('success') }}</strong>
            </div>
        @endif

        <form action="{{ route('user.store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-header">Create Expense</div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="">Expense Date</label>
                                <input type="date" name="expense_date" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                                    placeholder="Expense Date" required>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="">Expense Description</label>
                                <input type="text" name="expense_desc" class="form-control"
                                    placeholder="Expense Description" required>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="">Expense Price</label>
                                <input type="number" name="expense_price" class="form-control"
                                    placeholder="Expense Price eg - 20" required>
                            </div>
                        </div>

                        <div class="btn w-100">
                            <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure save this expense. You can`t change this.')">Save</button>
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
