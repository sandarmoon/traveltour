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

        .img_section{
            position: relative;
            /*background: linear-gradient(to bottom,rgba(0,0,0,0.4),rgba(255,255,255,0.8));*/
            border-radius: 15px 0px 0px 15px;
        }

        .img_section img{
            border-radius: 15px 0px 0px 15px;
            box-shadow: 3px 3px 3px 0px rgba(0, 0, 0, 0.2);
            height: 100%;

        }

        .text_header{
            position: absolute;
            display: inline-block;
            /*margin: 70px 40px 0px 40px;*/
            color: white;
            font-weight: 300;
            text-align: center;
            font-size: 30px;

        }

       /* .logo{
            width: 30px;
            position: absolute;
            margin: 25px 0px 0px 60px;
        }*/

        .form_div{
            margin-top: 8%;
            
        }

        .text_question{
           color: gray;
        }

        .text_question:hover{
           color: black;
        }

        

        body{
            background: linear-gradient(to right,rgba(250,158,27,0.7),rgba(141,79,255,0.7));
        }

        </style>

    </head>
    <body>

        <div class="container-fluid">
           <div class="row mt-4">
               <div class="col-md-8 mx-auto">
                  
                    <nav class="navbar navbar-expand-lg navbar-expand-sm navbar-dark ">
                        <div class="container-fluid">
                            <a href="{{route('frontend.index')}}" class="text-white nav-link">
                               <h4> Advance Agency </h4>
                            </a>

                            <ul class="navbar-nav d-flex">
                                <li class="nav-item">
                                    <a href="{{route('frontend.index')}}" class="nav-link font-weight-bold text-white"><h5>Home</h5></a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('login')}}" class="nav-link font-weight-bold text-white"><h5>Login</h5></a>
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
                                {{-- <h4 class="text_header">Travel around the Country with us!</h4> --}}
                                <img src="{{asset('frontend/img/travelsignup2.png')}}" class="img-fluid ">

                            </div>

                            <div class="col-md-7 form_div mx-0 px-0">
                               <h2 class="text-center">Sign Up</h2>
                               <div style="margin: 10px 5%;">
                                     <!-- Session Status -->
                                    <x-auth-session-status class="text-danger" :status="session('status')" />

                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="text-danger" :errors="$errors" />
                                    <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <!-- Name -->
                                    <div>
                                        <label for="name" class="form-control-label" >Name</label>

                                        <input id="name" class="block mt-1 w-full form-control" type="text" name="name" value="{{old('name')}}" required autofocus />
                                    </div>

                                    <!-- Email Address -->
                                    <div class="mt-4">
                                        <label for="email" >Email</label>

                                        <input id="email" class="block mt-1 w-full form-control" type="email" name="email" value="{{old('email')}}" required />
                                    </div>

                                    <!-- Password -->
                                    <div class="mt-4">
                                        <label for="password" class="form-control-label">Password</label>

                                        <input id="password" class="block mt-1 w-full form-control"
                                                        type="password"
                                                        name="password"
                                                        required autocomplete="new-password" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mt-4">
                                        <label for="password_confirmation" class="form-control-label">Confirm Password</label>

                                        <input id="password_confirmation" class="block mt-1 w-full form-control"
                                                        type="password"
                                                        name="password_confirmation" required />
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <a class="text-sm text_question" href="{{ route('login') }}">
                                            {{ __('Already registered?') }}
                                        </a>

                                        
                                    </div>

                                    <div class="d-grid gap-2 mx-3 my-3">
                                        <button class="ml-3 btn btn-outline-success d-block btn-block">
                                             {{ __('Register') }}
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