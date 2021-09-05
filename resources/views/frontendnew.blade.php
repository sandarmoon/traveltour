<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Advance Agency</title>

     @livewireStyles
        <link
            rel="icon"
            type="image/x-icon"
            href="{{ asset('frontend/assets/travel.svg') }}"
        />

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('frontnew/assets/img/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('frontnew/assets/img/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('frontnew/assets/img/favicons/favicon-16x16.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontnew/assets/img/favicons/favicon.ico')}}">
    <link rel="manifest" href="{{asset('frontnew/assets/img/favicons/manifest.json')}}">
    <meta name="msapplication-TileImage" content="{{asset('frontnew/assets/img/favicons/mstile-150x150.png')}}">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{asset('frontnew/assets/css/theme.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontnew/assets/css/mystyle.css')}}">

    <!-- Bootstrap icons-->
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
        {{-- <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet" /> --}}
        <link
            href="https://cdn.quilljs.com/1.3.6/quill.snow.css"
            rel="stylesheet"
        />
        <link
            href="{{ asset('multiform.css') }}"
            rel="stylesheet"
            id="bootstrap"
        />
        {{-- <link href="{{ asset('frontend/css/mystyle.css') }}" rel="stylesheet" /> --}}

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
        </style>
        @stack('style')

  </head>


  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      
        @include('layouts.navnew')
        @yield('header')

      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-0 overflow-hidden mt-5">

        @yield('main')
      
       
      <section class="py-0 overflow-hidden">

        <div class="container">

          <div class="row">

            
            
            <div class="col-6 col-8 col-lg-6 card shadow">

              <div class="py-8"><span class="fw-bold fs-4 text-primary ms-2">Contact Form</span>

                  <div class="p-3 py-5 p-md-3">
                    <div class="row">
                      
                      <div class="col-md-10 mx-auto card-body">
                        
                        <form action="" method="post">
                          <div class="form-group row my-3">
                            <label for="name" class="col-md-2 form-control-label">Name</label>
                            <div class="col-md-10">
                                <input type="text" name="name" id="name" class="form-control ">

                            </div>
                          </div>

                          <div class="form-group row my-3">
                            <label for="email" class="col-md-2 form-control-label">Email</label>
                            <div class="col-md-10">
                                <input type="email" name="email" id="email" class="form-control ">

                            </div>
                          </div>


                          <div class="form-group row my-3">
                            <label for="message" class="col-md-2 form-control-label">Message</label>
                            <div class="col-md-10">
                                <textarea class="form-control" id="message"></textarea>
                            </div>
                          </div>

                          <div class="form-group row my-3">
                          
                            <div class="col-md-12 d-grid gap-2">
                                <button class="btn btn-primary d-inline-block btn-lg">Send Message</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    
                    </div>
                  </div>
                </div>
                
              </div>

            



            <div class="col-6 col-sm-4 col-lg-6 bg-primary-gradient bg-offcanvas-right">
              <div class="py-7"><img class="d-inline-block mb-3" src="{{ asset('frontend/assets/travel.svg') }}" width="40" alt="logo" /><span class="fw-bold fs-4 text-light ms-2">Advance Agency</span>

                <div class="py-7 p-md-7">
                  <p class="text-light"><i class="fas fa-phone-alt me-3"></i><span class="text-light">+3930219390</span></p>
                  <p class="text-light"><i class="fas fa-envelope me-3"></i><span class="text-light">something@gmail.com</span></p>
                  <p class="text-light"><i class="fas fa-map-marker-alt me-3"></i><span class="text-light lh-lg">333, Lorem Street, Albania, Alifornia<br/>United States of America</span></p>
                  <div class="mt-6">

                    <a href="#!"> <img class="me-3" src="{{asset('frontnew/assets/img/icons/facebook.svg')}}" alt="..." /></a>

                    <a href="#!"> <img class="me-3" src="{{asset('frontnew/assets/img/icons/twitter.svg')}}" alt="..." /></a>

                    <a href="#!"> <img class="me-3" src="{{asset('frontnew/assets/img/icons/instagram.svg')}}" alt="..." /></a></div>

                  <p class="mt-3 text-light text-center text-md-start"> Made with&nbsp;
                    <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#EB6453" viewBox="0 0 16 16">
                      <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"></path>
                    </svg>&nbsp;by&nbsp;<a class="text-light" href="https://themewagon.com/" target="_blank">ThemeWagon </a>
                  </p>
                </div>  

              </div>
            </div>

          </div>
        </div>
        

      </section>
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
    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontnew/vendors/@popperjs/popper.min.js')}}"></script>

    <script src="{{asset('frontnew/vendors/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontnew/vendors/is/is.min.js')}}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{asset('frontnew/vendors/fontawesome/all.min.js')}}"></script>
    <script src="{{asset('frontnew/assets/js/theme.js')}}"></script>

    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300;400;600;700&amp;display=swap" rel="stylesheet">



    {{-- old --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script> --}}
      <script
          src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"
          integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg=="
          crossorigin="anonymous"
      ></script>

        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

     <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script src="{{ asset('frontend/js/scripts.js') }}}"></script>

        <script
            src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js"
            defer
        ></script>

     @livewireScripts @stack('script')

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
            });
        </script>
  </body>

</html>