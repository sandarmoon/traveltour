<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>A Agency</title>
        <!-- Favicon-->
        @livewireStyles
        <link rel="icon" type="image/x-icon" href="{{asset('frontend/assets/travel.svg')}}" />

        {{-- <link rel="icon" type="image/x-icon" href="{{asset('frontend/assets/car.svg')}}" /> --}}
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('frontend/css/styles.css')}}" rel="stylesheet" />
         <link href="{{ asset('multiform.css') }}" rel="stylesheet" id="bootstrap">
        <link href="{{asset('frontend/css/mystyle.css')}}" rel="stylesheet" />
          <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        
       
        
  
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

        .ql-editor{
                min-height:200px;
            }
        </style>
    </head>
    <body>
        <!-- Navigation-->
        @include('layouts.nav')
        <!-- Header-->
        
            <!-- div for search div -->
           
        
        
        <!-- Section-->
        
        @yield('main')
       
        
        <!-- Footer-->
        <footer class="py-5 bg-dark align-bottom">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
         <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js" integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg==" crossorigin="anonymous"></script>

         <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
             <script src="{{asset('frontend/js/scripts.js')}}}"></script>


             <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js" defer></script>
            
            <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

          
        @livewireScripts


        @stack('script')
       
        <script>
        $(document).ready(function() {
                //domain editng start
                var dtToday = new Date();

                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();
                if (month < 10)
                    month = '0' + month.toString();
                if (day < 10)
                    day = '0' + day.toString();

                var maxDate = year + '-' + month + '-' + day;

                // or instead:
                // var maxDate = dtToday.toISOString().substr(0, 10);

                //  alert(maxDate);
                $('input[type="date"]').prop('min', maxDate);
                // domain editing end
            
                $('.example_select2').select2(); 
              
            });
            
        </script>
        


    </body>
</html>