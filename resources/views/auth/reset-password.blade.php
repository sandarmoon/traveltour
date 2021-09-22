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
           color: black;
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

        .btn_submit{
             border: 1px solid #FE7A15;
             color: #000;
        }
        .btn_submit:hover{
            background-color: #FE7A15;
            color: #fff;
            
        }

     

        </style>

    </head>
    <body>

        <div class="container-fluid ">
            
           <div class="row mt-4 ">
               <div class="col-md-8 mx-auto ">
                   

                    <nav class="navbar navbar-expand-lg navbar-dark ">
                        <div class="container-fluid">
                            <a href="{{route('frontend.index')}}" class="text-white nav-link">
                               <h4> Lucky Seven </h4>
                            </a>

                           
                        </div>
                        
                    </nav>
                </div>

            </div>
            

            <div class="row mt-5">

            <div class="text-center mt-5 mb-0">
                <a href="{{route('frontend.index')}}">
                    <img src="{{asset('frontend/assets/travel.svg')}}" width="50px">
                </a>
            </div>
                
                <div class="col-md-5 col-sm-12 mx-auto mt-5 form_img_div ">
                    
                    <div class="row mt-5">
                        <div class="col-md-11 mx-auto">
                            
                       

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4 text-danger" :status="session('status')" />

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4 text-danger" :errors="$errors" />

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <div class="row">
                                    
                                
                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                    <!-- Email Address -->
                                    <div>
                                        <label for="email" >Email</label>

                                        <input id="email" class="block mt-1 w-full form-control" type="email" name="email" value="{{old('email', $request->email)}}" required autofocus />
                                    </div>

                                    <!-- Password -->
                                    <div class="mt-4">
                                        <label for="password">Password</label>

                                        <input id="password" class="block mt-1 w-full form-control" type="password" name="password" required />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mt-4">
                                        <label for="password_confirmation">Confirm Password </label>

                                        <input id="password_confirmation" class="block mt-1 w-full form-control"
                                                            type="password"
                                                            name="password_confirmation" required />
                                    </div>

                                    <div class="d-flex items-center  justify-content-end mt-2">

                                        <button class="btn btn_submit my-4 px-3">
                                            {{ __('Reset Password') }}
                                        </button>
                                        
                                    </div>

                                </div>
                            </form>
                            
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