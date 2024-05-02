@extends('index')
@section('title', 'Dashboard Admin')
@section('content')
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol><!-- End breadcrumb -->
    </div>
    <div class="row ">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-body p-4 text-dark">
                    <div class="statistics-info">
                        <div class="row text-center">
                            <div class="col-lg-3 col-md-6 mt-4 mb-4">
                                <div class="counter-status">
                                    <div class="counter-icon text-danger">
                                        <i class="si si-people"></i>
                                    </div>
                                    <p class="mb-2">Employees</p>
                                    <h2 class="counter text-primary mb-0">2569</h2>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mt-4 mb-4">
                                <div class="counter-status">
                                    <div class="counter-icon border-danger">
                                        <i class="si si-rocket text-danger"></i>
                                    </div>
                                    <p class="mb-2">Total Sales</p>
                                    <h2 class="counter text-danger mb-0">1765</h2>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6  mt-4 mb-4">
                                <div class="counter-statuss">
                                    <div class="counter-icon border-success">
                                        <i class="si si-docs text-success"></i>
                                    </div>
                                    <p class="mb-2">Total Projects</p>
                                    <h2 class="counter text-success mb-0">846</h2>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mt-4 mb-4">
                                <div class="counter-status">
                                    <div class="counter-icon border-info">
                                        <i class="si si-graph text-info"></i>
                                    </div>
                                    <p class="mb-2">Growth</p>
                                    <h2 class="counter text-info mb-0">7253</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
