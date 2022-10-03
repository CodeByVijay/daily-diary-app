<?php
use App\Models\Expense;
?>
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
            #filterForm{
                display: none;
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

        <div class="card">

            <div class="card-header">
                <a href="#" class="btn btn-warning" id="filter"><i class="fa fa-search"></i> Filter Expense</a>

                <div id="filterForm" class="mt-2">
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

            </div>
            <div class="card-body">
<h4 class="text-center text-success mb-4">Dear, <b>{{auth()->user()->name}}</b>! Your Total Expense Report.</h4>
                <div class="table-responsive">
                    <table class="display table table-bordered table-hover text-center" id="myTab" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Desc.</th>
                                <th>Expense</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($expenses as $expense)

                                <?php
                                $expenseData = Expense::where('user_id', auth()->user()->id)
                                    ->where('date', $expense->date)
                                    ->orderBy('date', 'asc')
                                    ->get();
                                $expenseCount = Expense::where('user_id', auth()->user()->id)
                                    ->where('date', $expense->date)
                                    ->count();
                                ?>

                                <tr>
                                    <td rowspan="{{ $expenseCount + 1 }}" align="center" style="vertical-align: middle;">
                                        {{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}</td>

                                </tr>
                                @foreach ($expenseData as $data)
                                    <tr>
                                        <td>{{ $data->expense_desc }}</td>
                                        <td>&#8377; {{ $data->expense }}.00</td>
                                    </tr>
                                @endforeach
                                {{-- <tr>
                                    <td scope="row" rowspan="{{$expenseCount}}">{{ \Carbon\Carbon::parse($expense->date)->format('d M Y')}}</td>
                                    <td>{{$expense->expense_desc}}</td>
                                    <td>{{$expense->expense}}</td>
                                </tr> --}}

                            @empty
                                <h3 class="text-center">No Data Found.</h3>
                            @endforelse
                            <tr>
                                <td colspan="2" class="text-right"><b>Total Expense</b></td>
                                <td><b>&#8377; {{ $expenseSum }}.00</b></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right"><a href="#" onclick="window.print()"
                                        class="btn btn-primary"><i class="fa fa-download"></i> Download</a></td>

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

@push('script')
    <script>
        $(document).ready(function() {
            $('#filter').on('click',function(){
                $('#filterForm').toggle();
            })
        });
    </script>
@endpush
