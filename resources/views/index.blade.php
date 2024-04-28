<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="Sparic– Creative Admin Multipurpose Responsive Bootstrap5 Dashboard HTML Template" name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords"
        content="html admin template, bootstrap admin template premium, premium responsive admin template, admin dashboard template bootstrap, bootstrap simple admin template premium, web admin template, bootstrap admin template, premium admin template html5, best bootstrap admin template, premium admin panel template, admin template">

    <!-- Favicon -->
    <link rel="icon" href="{{ url('/assets') }}/images/brand/icon1.png" type="image/x-icon">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('/assets') }}/images/brand/icon1.png">

    <!-- Title -->
    <title>{{ config('app.name') }} | @yield('title')</title>

    @include('template.component.style_css')
    @yield('css')

</head>

<body class="app sidebar-mini ltr">

    <!--Global-Loader-->
    <div id="global-loader">
        <img src="{{ url('/assets') }}/images/icon1.svg" style="width: 150px; height: auto;" alt="loader">
    </div>

    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            @include('template.header')
            <!-- app-Header -->

            <!--News Ticker-->
            <div class="contain er-fluid bg-white news-ticker">
                <div class="bg-white">
                    <div class="best-ticker" id="newsticker">
                        <div class="bn-news">
                            <ul>
                                <li class="text-muted fs-13 fw-semibold">
                                    <span class="fa fa-users bg-danger-transparent text-danger mx-1"></span>
                                    <span class="d-inline-block">Total Users</span>
                                    <span class="bn-positive me-4">1,653</span>
                                </li>
                                <li class="text-muted fs-13 fw-semibold">
                                    <span class="fa fa-signal bg-info-transparent text-info mx-1"></span>
                                    <span class="d-inline-block">Total Leads</span>
                                    <span class="bn-negative me-4">639</span>
                                </li>
                                <li class="text-muted fs-13 fw-semibold">
                                    <span class="fa fa-briefcase bg-success-transparent text-success mx-1"></span>
                                    <span class="d-inline-block"> Total Trials </span>
                                    <span class="bn-negative me-4">12,765</span>
                                </li>
                                <li class="text-muted fs-13 fw-semibold">
                                    <span class="fa fa-trophy bg-warning-transparent text-warning mx-1"></span>
                                    <span class="d-inline-block">Total Wins</span>
                                    <span class="bn-positive me-4">24</span>
                                </li>
                                <li class="text-muted fs-13 fw-semibold">
                                    <span class="fa fa-envelope bg-primary-transparent text-primary mx-1"></span>
                                    <span class="d-inline-block">Active Email Accounts</span>
                                    <span class="bn-positive me-4">74,526</span>
                                </li>
                                <li class="text-muted fs-13 fw-semibold">
                                    <span class="fa fa-check-circle bg-danger-transparent text-danger mx-1"></span>
                                    <span class="d-inline-block">Active Requests</span>
                                    <span class="bn-positive me-4">14,526</span>
                                </li>
                                <li class="text-muted fs-13 fw-semibold">
                                    <span class="fa fa-envelope bg-secondary-transparent text-secondary mx-1"></span>
                                    <span class="d-inline-block">Deactive Email Accounts</span>
                                    <span class="bn-positive me-4">7,325 </span>
                                </li>
                                <li class="text-muted fs-13 fw-semibold">
                                    <span class="fa fa-times-circle bg-info-transparent text-info mx-1"></span>
                                    <span class="d-inline-block">Deactive Requests</span>
                                    <span class="bn-positive me-4"> 1,425 </span>
                                </li>
                                <li class="text-muted fs-13 fw-semibold">
                                    <span class="fa fa-usd bg-success-transparent text-success mx-1"></span>
                                    <span class="d-inline-block">Total Balance</span>
                                    <span class="bn-negative me-4">$1,52,654</span>
                                </li>
                                <li class="text-muted fs-13 fw-semibold">
                                    <span class="fa fa-shopping-cart bg-danger-transparent text-danger mx-1"></span>
                                    <span class="d-inline-block">Total Sales</span>
                                    <span class="bn-negative me-4">23,15,2654</span>
                                </li>
                                <li class="text-muted fs-13 fw-semibold">
                                    <span class="fa fa-money bg-warning-transparent text-warning"></span>
                                    <span class="d-inline-block">Total Purchase</span>
                                    <span class="bn-positive me-4">$7,483</span>
                                </li>
                                <li class="text-muted fs-13 fw-semibold">
                                    <span class="fa fa-usd bg-danger-transparent text-danger mx-1"></span>
                                    <span class="d-inline-block">Total Cost Reduction</span>
                                    <span class="bn-negative me-4">$23,567</span>
                                </li>
                                <li class="text-muted fs-13 fw-semibold">
                                    <span class="fa fa-money bg-primary-transparent text-primary mx-1"></span>
                                    <span class="d-inline-block">Total Cost Savings</span>
                                    <span class="bn-negative me-4">15.2%</span>
                                </li>
                                <li class="text-muted fs-13 fw-semibold">
                                    <span class="fa fa-briefcase bg-info-transparent text-info mx-1"></span>
                                    <span class="d-inline-block">Total Projects</span>
                                    <span class="bn-positive me-4">3,456</span>
                                </li>
                                <li class="text-muted fs-13 fw-semibold">
                                    <span class="fa fa-users bg-success-transparent text-success mx-1"></span>
                                    <span class="d-inline-block">Total Employes</span>
                                    <span class="bn-positive me-4">4,738</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--/News Ticker-->

            <!--App-Sidebar-->
            @include('template.sidebar')
            <!--/App-Sidebar-->

            <!-- app-content-->
            <div class="main-content app-content">
                <div class="side-app">

                    <!-- container -->
                    <div class="main-container container-fluid">

                        <!-- page-header -->
                        {{-- <div class="page-header d-sm-flex d-block">
                            <ol class="breadcrumb mb-sm-0 mb-3">
                                <!-- breadcrumb -->
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard01</li>
                            </ol><!-- End breadcrumb -->
                            <div class="ms-auto">
                                <div>
                                    <a href="#" class="btn bg-secondary-transparent text-secondary btn-sm"
                                        data-bs-toggle="tooltip" title="" data-bs-placement="bottom"
                                        data-bs-original-title="Rating">
                                        <span>
                                            <i class="fa fa-star"></i>
                                        </span>
                                    </a>
                                    <a href="lockscreen.html"
                                        class="btn bg-primary-transparent text-primary mx-2 btn-sm"
                                        data-bs-toggle="tooltip" title="" data-bs-placement="bottom"
                                        data-bs-original-title="lock">
                                        <span>
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </a>
                                    <a href="#" class="btn bg-warning-transparent text-warning btn-sm"
                                        data-bs-toggle="tooltip" title="" data-bs-placement="bottom"
                                        data-bs-original-title="Add New">
                                        <span>
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div> --}}
                        <!-- End page-header -->
                        @yield('content')
                    </div>
                    <!-- container end -->

                </div>
            </div>
            <!-- End app-content-->
        </div>

        <!--footer-->
        @include('template.footer')
        <!-- End Footer-->

    </div>
    <!-- End Page -->

    <!-- Back to top -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    @include('template.component.style_js')
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script type="text/javascript">
            Swal.fire({
                title: "Berhasil",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endif
    @if (session('error'))
        <script type="text/javascript">
            Swal.fire({
                title: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endif
    @yield('script')

</body>

</html>
