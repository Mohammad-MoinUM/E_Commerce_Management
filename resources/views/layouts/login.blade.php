<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts (minimal for auth pages) -->
    <script src="/admino/vendors/base/vendor.bundle.base.js"></script>
    <script src="/admino/js/off-canvas.js"></script>
    <script src="/admino/js/hoverable-collapse.js"></script>
    <script src="/admino/js/template.js"></script>
    <script src="/admino/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <!-- Fonts -->


    <!-- CSS -->
    <link rel="stylesheet" href="/admino/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/admino/vendors/base/vendor.bundle.base.css">
    <link rel="stylesheet" href="/admino/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/admino/css/style.css">
    <!-- Admin overrides: keep last to win specificity -->
    <link rel="stylesheet" href="/admino/css/admin-overrides.css">
    <link rel="stylesheet" href="/admino/css/tableStyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="shortcut icon" href="/admino/images/favicon.png" />

    <style>
        div.dataTables_wrapper div.dataTables_length select {
            width: auto;
            display: inline-block;
        }
    </style>

    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</head>

<body>
    @yield('content')
    <script>
        @if (Session::has('message'))
            toastr.{{ Session::get('alert-type', 'info') }}("{{ Session::get('message') }}");
        @endif
    </script>
</body>

</html>
