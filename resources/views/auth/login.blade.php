<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Lucky Seven</title>
        <!-- Favicon-->
        @livewireStyles
        <link rel="icon" type="image/x-icon" href="{{asset('frontend/assets/travel.svg')}}" />
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


        .form_img_div{
            margin-top: 2%;
            border: solid 1px black;
            box-shadow: 10px 10px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            background: white;
        }

        .img_section img{
            border-radius: 15px 0px 0px 15px;
            box-shadow: 3px 3px 3px 0px rgba(0, 0, 0, 0.2);

        }

        .img_section{
            position: relative;
        }

        .text_header{
            position: absolute;
            display: inline-block;
            margin: 70px 40px 0px 40px;
            color: white;
            font-weight: 300;
            text-align: center;
            font-size: 30px;

        }

        .text_question{
           color: gray;
        }

        .text_question:hover{
           color: black;
        }

       /* .logo{
            width: 30px;
            position: absolute;
            margin: 25px 0px 0px 60px;
        }*/

        .form_div{

            margin-top: 8%;
        }

        body{
            background: linear-gradient(to right,rgba(250,158,27,0.8),rgba(48, 17, 188,0.9));
        }

        </style>

    </head>
    <body>

        <div class="container-fluid">
           <div class="row mt-4">
               <div class="col-md-8 mx-auto">
                  
                    <nav class="navbar navbar-expand-lg navbar-dark justify-content-end">
                        <div class="container-fluid">
                            <a href="{{route('frontend.index')}}" class="text-white nav-link">
                               <h4> Advance Agency </h4>
                            </a>

                            <ul class="navbar-nav d-flex">
                                <li class="nav-item">
                                    <a href="{{route('frontend.index')}}" class="nav-link font-weight-bold text-white"><h5>Home</h5></a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('register')}}" class="nav-link font-weight-bold text-white"><h5>Sign Up</h5></a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>

            </div>
            

            <div class="row">
                
                <div class="col-md-8 col-sm-12 mx-auto">
                    
                        <div class="row form_img_div ">
                            
                            <div class="col-md-5 img_div px-0 py-0 img_section"> 
                                <!-- <img src="{{asset('frontend/assets/travel.svg')}}" class="logo"> -->
                                <h4 class="text_header">Travel around the Country with us!</h4>
                                <img src="{{asset('frontend/img/travel_tour.jpeg')}}" class="img-fluid ">

                            </div>

                            <div class="col-md-7 form_div ml-5">
                               <h2 class="text-center">Login</h2>
                               <div style="margin: 0px 5% 0px 5%;">
                                     <!-- Session Status -->
                                    <x-auth-session-status class="text-danger" :status="session('status')" />

                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="text-danger" :errors="$errors" />
                                    <form method="POST" action="{{ route('login') }}" class="text">
                                        @csrf

                                        <!-- Email Address -->
                                        <div class="row form-group">
                                            <label for="email" class="form-control-label col-md-2">Email</label>

                                            <input id="email" class=" col-md-6 form-control mt-1 w-full" type="email" name="email" value="{{old('email')}}" placeholder="Enter email" required autofocus />
                                        </div>

                                        <!-- Password -->
                                        <div class="mt-4 form-group row">
                                            <label for="password" class="form-control-label col-md-2">Password</label>

                                            <input id="password" class="block form-control col-md-6 mt-1 w-full"
                                                            type="password"
                                                            name="password"
                                                            placeholder="Enter password" 
                                                            required autocomplete="current-password" />
                                        </div>

                                        <!-- Remember Me -->
                                        {{-- <div class="block mt-4">
                                            <label for="remember_me" class="inline-flex items-center">
                                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                                <span class="ml-2 text-sm text-gray-600 ">{{ __('Remember me') }}</span>
                                            </label>
                                        </div> --}}

                                        <div class="flex items-center justify-end mt-4">
                                            @if (Route::has('password.request'))
                                                <a class="underline text-sm text_question" href="{{ route('password.request') }}">
                                                    {{ __('Forgot your password?') }}
                                                </a>
                                            @endif

                                            
                                        </div>
                                        <div class="row  my-3">
                                            <button class="btn btn-outline-primary d-block btn-block">
                                                {{ __('Log in') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                </div>

            </div>
            
        </div>



    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js" integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg==" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="{{asset('frontend/js/scripts.js')}}}"></script>


    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js" defer></script>
        
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    
       
    <script>
    $(document).ready(function() {
            $('.example_select2').select2(); 
          
        });
        
    </script>
        


    </body>
</html>