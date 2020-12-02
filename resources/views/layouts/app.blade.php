<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.laravel = { csrfToken: '{{ csrf_token() }}' }</script>

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"><!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('assets/css/sb-admin.css') }}" rel="stylesheet">
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}

</head>
<body id="page-top">

    <div id="app">
        <navbar></navbar>
        {{-- <alert :show.sync="showTop" placement="top" duration="3000" type="danger" width="400px" dismissable>
          <span class="icon-info-circled alert-icon-float-left"></span>
          <strong>Heads up!</strong>
          <p>This alert needs your attention.</p>
        </alert> --}}

        
            <div id="wrapper">
                <sidebar></sidebar>

                <div id="content-wrapper">
                    <content-wrapper></content-wrapper>

                    <main class="py-4">
                        @yield('content')
                    </main>
                    <foot></foot>
                </div>
            </div>
    </div>


<script src="{{ asset('js/app.js') }}"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>




  <!-- Core plugin JavaScript-->
  <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Page level plugin JavaScript-->
  <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('assets/js/sb-admin.min.js') }}"></script>

  <!-- Demo scripts for this page-->
  <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
  <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>


</body>
</html>
