<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        .: {{ config('app.name') }} - @yield("title") :.
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="{{ url('/css/bootstrap.min.css') }}" rel="stylesheet">

        <style>
            .nav-link {
                color: white;
                font-weight: bold;
            }

            footer {
                padding: 20px 0px;
            }
        </style>
</head>

<body>

    @include("landing-page.partials.header")

    @stack("content-page")

    @include("landing-page.partials.footer")

    <script src="{{ url('/js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
