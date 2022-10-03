<?php ?>
@extends('partials.app')
@section('title', 'Expense')
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
        <a class="navbar-brand" href="#"> <img src="{{ asset('assets/images/icons/favicon.png') }}" width="30"
                height="30" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('user.home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.expense') }}">Get Expense <span
                            class="sr-only">(current)</span></a>
                </li>


            </ul>
            <ul class="my-2 my-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropLink dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
        @if (session()->get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ session()->get('success') }}</strong>
            </div>
        @endif

        <div class="card">

            <div class="card-header">
                <form action="{{ route('user.filterExpense') }}" method="post">
                    @csrf
                    <div class="row">

                        <div class="col-sm-5 col-md-5 col-lg-5">
                            <div class="form-group">
                                <label for="">Expense Start Date</label>
                                <input type="date" name="expense_start_date" class="form-control"
                                    placeholder="Expense Start Date" required>
                            </div>
                        </div>

                        <div class="col-sm-5 col-md-5 col-lg-5">
                            <div class="form-group">
                                <label for="">Expense End Date</label>
                                <input type="date" name="expense_end_date" class="form-control"
                                    placeholder="Expense Description" required>
                            </div>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2">
                            <div class="btn w-100">
                                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Desc.</th>
                                <th>Expense</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($expenses as $expense)
                                <tr>
                                    <td scope="row">{{ \Carbon\Carbon::parse($expense->date)->format('d M Y')}}</td>
                                    <td>{{$expense->expense_desc}}</td>
                                    <td>{{$expense->expense}}</td>
                                </tr>
                            @empty
                                <h3 class="text-center">No Data Found.</h3>
                            @endforelse
                            <tr>
                                <td colspan="2" class="text-right"><b>Total Expense</b></td>
                                <td><b>&#8377; {{$expenseSum}}</b></td>
                                
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="footer mt-4">
            <div class="foot">
                <h6>&copy; 2022 - <?= date('Y') ?> <a href="#">Vicky Digital Solutions</a></h6>
            </div>
        </div>
    </div>
@endsection
