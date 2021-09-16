<!DOCTYPE html>
<html lang="en-US" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- ===============================================-->
        <!--    Document Title-->
        <!-- ===============================================-->
        <title>Lucky 7</title>
        
        <link rel="stylesheet" href="{{asset('js/sweetalert2.min.css')}}">
        @livewireStyles
        <link
            rel="icon"
            type="image/x-icon"
            href="{{ asset('frontend/assets/travel.svg') }}"
        />


        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">

        <!-- ===============================================-->
        <!--    Favicons-->
        <!-- ===============================================-->
        {{-- <link
            rel="apple-touch-icon"
            sizes="180x180"
            href="{{
                asset('frontnew/assets/img/favicons/apple-touch-icon.png')
            }}"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="32x32"
            href="{{ asset('frontnew/assets/img/favicons/favicon-32x32.png') }}"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="{{ asset('frontnew/assets/img/favicons/favicon-16x16.png') }}"
        />
        <link
            rel="shortcut icon"
            type="image/x-icon"
            href="{{ asset('frontnew/assets/img/favicons/favicon.ico') }}"
        /> --}}
        <link
            rel="manifest"
            href="{{ asset('frontnew/assets/img/favicons/manifest.json') }}"
        />
        <meta
            name="msapplication-TileImage"
            content="{{
                asset('frontnew/assets/img/favicons/mstile-150x150.png')
            }}"
        />
        <meta name="theme-color" content="#ffffff" />
    <link rel="manifest" href="{{asset('frontnew/assets/img/favicons/manifest.json')}}">
    <meta name="msapplication-TileImage" content="{{asset('frontnew/assets/img/favicons/mstile-150x150.png')}}">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{asset('frontnew/assets/css/theme.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontnew/assets/css/mystyle.css')}}">

  
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
            rel="stylesheet"
        />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
            rel="stylesheet"
        />
        <link
            href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
            rel="stylesheet"
        />
        <link
            href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css"
            rel="stylesheet"
        />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- Core theme CSS (includes Bootstrap)-->
        {{--
        <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet" />
        --}}
        <link
            href="https://cdn.quilljs.com/1.3.6/quill.snow.css"
            rel="stylesheet"
        />
        <link
            href="{{ asset('multiform.css') }}"
            rel="stylesheet"
            id="bootstrap"
        />

        <link rel="stylesheet"  href="{{asset('frontnew/assets/owlcarousel/owl.carousel.min.css')}}">

        <link rel="stylesheet" href="{{asset('frontnew/assets/owlcarousel/owl.theme.default.min.css')}}">


        <link href="{{ asset('frontend/css/mystyle.css') }}" rel="stylesheet" />


        {{-- google font --}}


        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500&display=swap" rel="stylesheet">

        <style>
            .select2-selection__rendered {
                line-height: 35px !important;
            }
            .select2-container .select2-selection--single {
                height: 40px !important;
            }
            .select2-selection__arrow {
                height: 34px !important;
            }

            .note-group-select-from-files {
                display: none;
            }

            .ql-editor {
                min-height: 200px;
            }

            .font_lucky_7{
                font-family: 'Caveat', cursive;
                font-size: 30px;
            }
        </style>
        
        @stack('style')
        
    </head>

    <body>
        <!-- ===============================================-->
        <!--    Main Content-->
        <!-- ===============================================-->
        <main class="main" id="top">
            @include('layouts.navnew') @yield('header')

            <!-- ============================================-->
            <!-- <section> begin ============================-->
            <section class="py-0 overflow-hidden mt-5">
                @yield('main-content')

               
                <!-- <section> close ============================-->
                <!-- ============================================-->
            </section>
        </main>
        <!-- ===============================================-->
        <!--    End of Main Content-->
        <!-- ===============================================-->

        <!-- ===============================================-->
        <!--    JavaScripts-->
        <!-- ===============================================-->
        <script src="{{asset('assets/js/plugins/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{
                asset('frontnew/vendors/@popperjs/popper.min.js')
            }}"></script>

        <script src="{{
                asset('frontnew/vendors/bootstrap/bootstrap.min.js')
            }}"></script>
        <script src="{{ asset('frontnew/vendors/is/is.min.js') }}"></script>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
        <script src="{{
                asset('frontnew/vendors/fontawesome/all.min.js')
            }}"></script>
        <script src="{{ asset('frontnew/assets/js/theme.js') }}"></script>
        <script src="{{ asset('frontnew/assets/owlcarousel/owl.carousel.min.js') }}"></script>


        <link
            href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300;400;600;700&amp;display=swap"
            rel="stylesheet"
        />

        {{-- old --}}
        {{--
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        --}}
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"
            integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg=="
            crossorigin="anonymous"
        ></script>

        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        

        <script
            src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js"
            defer
        ></script>
        <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>

        @livewireScripts 
        @stack('script')

        <script>
            $(document).ready(function () {
                //domain editng start
                var dtToday = new Date();

                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();
                if (month < 10) month = "0" + month.toString();
                if (day < 10) day = "0" + day.toString();

                var maxDate = year + "-" + month + "-" + day;

                // or instead:
                // var maxDate = dtToday.toISOString().substr(0, 10);

                //  alert(maxDate);
                $('input[type="date"]').prop("min", maxDate);
                // domain editing end

                $(".example_select2").select2();


                // for clicking booking of package
                

                
                
            });
        </script>

    </body>
</html>
