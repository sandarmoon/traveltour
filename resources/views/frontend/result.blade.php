<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>A Agency</title>
        @livewireStyles
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        

        <link href="{{asset('frontend/css/styles.css')}}" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <link href="{{ asset('multiform.css') }}" rel="stylesheet" id="bootstrap">
        <link href="{{asset('frontend/css/mystyle.css')}}" rel="stylesheet" />

    </head>
    <body>
        <!-- Navigation-->
        @include('layouts/nav')
       
        <section class="container">
        	<livewire:wizard :cars="$cars" :pickup="$pickup" :drop="$drop" :sdate="$s_date" :edate="$e_date" />
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
         <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
         <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
       
        <!-- Core theme JS-->
        
        <script src="js/scripts.js"></script>
        <script>
        $(document).ready(function() {
                $('.example_select2').select2();
            });
            
        </script>
        @livewireScripts
        @yield('script')
    </body>
</html>