@extends('backendTemplate')
@section('main-content')



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-7">
      <div class="container-fluid">
        <div class="my-ct-page-title text-white">
          <h1 class="ct-title text-white d-inline-block" id="content">
            Partnership Detail Information 
          </h1>
          @if ($message = Session::get('success'))
              <div class="alert alert-success">
                  <p>{{ $message }}</p>
              </div>
          @endif
          <a class="ct-example text-white float-right border-0" href="{{route('car.create')}}">
            <i class="fas fa-arrow-left me-1"></i>
                <span class="error-name">back</span>
          </a>
          
        </div>
        
      </div>
    </div>
    <div class="container-fluid mt--7">
      <div class="my-card">
        <div class="card-body p-0">
         <input type="hidden" name="tag" class="tag" value="">
          {{-- start here --}}
          <div class="row " >
             <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                   <div class="card-header bg-white border-0">
                      <div class="row align-items-center">
                         <div class="col-8">
                            {{-- <img src="" width="60" class="rounded-circle float-left d-inline-block mr-4 mt-3"> --}}
                           {{--  <h6 class="small text-muted mb-4">Company-Name: </h6> --}}
                           <h3 class=" p-0 pr-4 mt-3 ">{{$company->name}} 
                              @if($company->status == 1)
                                 <span class="text-success font-weight-bold"> ( Active )</span>

                              @elseif($company->status == 2)
                                 <span class="text-danger font-weight-bold"> ( Inactive )</span>

                              @endif
                           </h3>
                            
                         </div>
                         @role('Admin')
                         <div class="col-4 text-right">
                            <a href="" class="btn btn-sm btn-primary">Edit Profile</a>
                         </div>
                         @endrole
                      </div>
                   </div>

                  <div class="card-header pb-0">
                      
                      <ul class="nav nav-tabs" id="tabs-icons-text" role="tablist">
                        
                          <li class="nav-item">
                              <a class="nav-link mb-sm-3 mb-md-0  main_nav" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
                                 Main Info
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link mb-sm-3 mb-md-0 general_nav" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">
                                 General Info
                              </a>
                          </li>
                          
                      </ul>
                  </div>
                  <div class="card-body">
                     <div class="card-body mx-0">

                        <div class="tab-content" id="myTabContent">

                           {{-- main info --}}
                           <div class="tab-pane fade active show main_nav_tab" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">

                              <div class="row">

                                 <div class="col-md-2">
                                    
                                    <div class="row row-cols-12">
                                     
                                       <img src="{{asset('/storage/'.$company->logo)}}" class="rounded-circle " width="150px" height="150px">

                                       <form method="post" id="upload_company_logo" enctype="multipart/form-data">
                                          @csrf
                                        <div class="row">
                                          <span class="text-center mt-2">Comapny Logo</span>
                                           <div class="col-md-4 mt-2  mx-auto">
                                                
                                                <input type="hidden" name="company_id" value="{{$company->id}}" class="company_id">
                                                <input type="hidden" name="old_image" value="{{$company->logo}}">
                                                <input type="file" name="file" id="file" class="inputfile" />
                                                <label for="file">
                                                    <i class="fas fa-edit"></i>
                                                </label>
                                              
                                           </div>
                                        </div>
                                       </form>
                                    </div>

                                    <div class="row row-cols-12">
                                   
                                       <img src="{{asset('/storage/'.$company->photo)}}" class="rounded circle " width="200px" height="220px">

                                       <form method="post" id="upload_company_photo" enctype="multipart/form-data">
                                          @csrf
                                        <div class="row">
                                          <span class="text-center ml-3 mt-2">Comapny License</span>

                                           <div class="col-md-2 mt-3 mx-auto">
                                                <input type="hidden" name="company_id" value="{{$company->id}}" class="company_id">
                                                <input type="hidden" name="old_photo" value="{{$company->photo}}">
                                                <input type="file" name="photo" id="photo" class="inputfile " />
                                                <label for="photo">
                                                    <i class="fas fa-edit"></i>
                                                </label>
                                              
                                           </div>
                                        </div>
                                       </form>

                                        
                                    </div>

                                     
                                 </div>
                                 
                                 
                                 <div class="col-md-10">
                                    <div class="row">
                                       
                                       <div class="col-md-6 mx-auto main_info_update">
                                          
                                          <div class="row form-group">
                                             <label class="form-control-label col-md-4 mt-2 ml-3" for="ceo_name">Ceo Name</label>

                                             <div class="col-md-6 ">
                                                <input type="text" class="form-control ceo_name text-dark" readonly value="{{$company->ceo_name}}" name="ceo_name">
                                             </div>
                                          
                                          </div>

                                          <div class="row form-group">
                                             <label class="form-control-label col-md-4 mt-2 ml-3" for="company_name">Company Name</label>

                                             <div class="col-md-6 ">
                                                <input type="text" class="form-control company_name text-dark" readonly value="{{$company->name}}" name="company_name">
                                             </div>
                                          
                                          </div>

                                          <div class="row form-group">
                                             <label class="form-control-label col-md-4 mx-0 mt-2 ml-3" for="user_name">User Name</label>

                                             <div class="col-md-6">
                                                <input type="text" class="form-control user_name text-dark" readonly value="{{$company->user->name}}" name="user_name">
                                             </div>
                                          
                                          </div>

                                          <div class="row form-group">
                                             <label class="form-control-label col-md-4 mx-0 mt-2 ml-3" for="email">Email</label>

                                             <div class="col-md-6 mx-0">
                                                <input type="text" class="form-control email text-dark" readonly value="{{$company->user->email}}" name="email">
                                             </div>
                                          
                                          </div>

                                          <div class="row form-group">
                                             <label class="form-control-label col-md-4 mx-0 mt-2 ml-3" for="phone">Phone</label>

                                             <div class="col-md-6 mx-0">
                                                <input type="text" class="form-control phone text-dark" readonly value="{{$company->phone}}" name="phone">
                                             </div>
                                       
                                          </div>


                                       </div>


                                       <div class="col-md-6 mx-auto main_info_update">
                                          
                                          <div class="row form-group">
                                             <label class="form-control-label col-md-4 mx-0 mt-2 ml-3" for="incharge_name">Incharge Name</label>

                                             <div class="col-md-6 mx-0">
                                                <input type="text" class="form-control incharge_name text-dark" readonly value="{{$company->incharge_name}}" name="incharge_name">
                                             </div>
                                          
                                          </div>

                                          <div class="row form-group">
                                             <label class="form-control-label col-md-4 mx-0 mt-2 ml-3" for="incharge_phone">Incharge Phone</label>

                                             <div class="col-md-6 mx-0">
                                                <input type="text" class="form-control incharge_phone text-dark" readonly value="{{$company->incharge_phone}}" name="incharge_phone">
                                             </div>
                                          
                                          </div>

                                          <div class="row form-group">
                                             <label class="form-control-label col-md-4 mx-0 mt-2 ml-3" for="incharge_position">Incharge Position</label>

                                             <div class="col-md-6 mx-0">
                                                <input type="text" class="form-control incharge_position text-dark" readonly value="{{$company->incharge_position}}">
                                             </div>
                                          
                                          </div>


                                          <div class="row form-group">
                                             <label class="form-control-label col-md-4 mx-0 ml-3" for="email">Register Date</label>

                                             <div class="col-md-6 mx-0">
                                                 @php
                                                 $date=date_create($company->created_at);
                                                 $date= date_format($date,"Y M dS ");
                                                 @endphp
                                                 
                                                <span class="text-dark font-weight-normal">{{$date}}</span>
                                                
                                             </div>
                                          
                                          </div>
                                         
                                       </div>

                                       <div class="row form-group main_info_update">
                                          <label class="form-control-label col-md-2 mx-0 mt-2 ml-3" for="incharge_position">Address</label>

                                          <div class="col-md-8 mx-0">
                                            
                                             <textarea class="form-control text-dark address" readonly name="info">{{$company->addresss}}</textarea>
                                          </div>
                                       
                                       </div>
                                    </div>
                                 </div>

                              </div>



                              <div class="row">
                                 <div class="col-md-5 mx-auto">
                                    <button class="btn btn-success btn-block btn_submit">
                                       Submit
                                    </button>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-md-5 mx-auto">
                                    <button class="btn btn-warning btn-block btn_edit">
                                      Click Here!If you want edit your profile.
                                    </button>
                                 </div>
                              </div>

                           </div>



                           {{-- general info --}}
                           <div class="tab-pane fade general_nav_tab" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                              <div class="row">


                                 {{-- <span class="text-danger mb-4">
                                     <i class="fas fa-exclamation-triangle text-warning"></i>If you want edit your general Info, <h4 class="d-inline-block text-danger">click text</h4> .
                                 </span> --}}



                                 <div class="accordion accordion-flush" id="accordionFlushExample">


                                   <div class="accordion-item">
                                     {{-- <h2 class="accordion-header" id="flush-headingOne"> --}}
                                       <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                         Service Label One
                                       </button>
                                     {{-- </h2> --}}
                                     <div id="flush-collapseOne" class="accordion-collapse show collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                       <div class="accordion-body">

                                          <div class="row">
                                             <div class="row">
                                                <div class="col-md-3">


                                                   {{-- <h2 class="mt-2 service_label_one_label" for="service_label_one">
                                                   {{$company->service_label_one}}
                                                   </h2> --}}

                                                   <h2 class="service_label_one_label" for="service_label_one">
                                                   {{$company->service_label_one}}
                                                   <i class="fas fa-edit btn btn-sm btn-warning mb-5 btn_service_label_one_label"></i>
                                                   </h2>
                                                   

                                                   


                                                   <div class=" service_label_one_input">
                                                      <div class="input-group">
                                                         
                                                      
                                                         <input type="text" name="service_label_one" value="{{$company->service_label_one}}" class="form-control service_label_one_data text-dark" aria-describedby="basic-addon1">
                                                         {{-- <button class="input-group-text text-dark service_label_one_input_close" id="basic-addon1">
                                                            x
                                                         </button> --}}
                                                      </div>
                                                      <div class="row row-cols-6  mx-auto mt-2">
                                                         <button class="btn btn-success btn-block btn-sm btn_service_label_one_data">
                                                            Submit
                                                         </button>
                                                      </div>

                                                      <div class="row row-cols-6  mx-auto mt-2">
                                                         <button class="btn btn-danger btn-block btn-sm service_label_one_input_close">
                                                            Cancel
                                                         </button>
                                                      </div>

                                                   </div>
                                                   
                                                   
                                                </div>

                                             <div class="col-md-9">

                                                <div class="service_desc_one_para">
                                                  
                                                   <p >
                                                      {!! $company->service_desc_one !!}
                                                   </p>

                                                   <div class="row row-cols-8 offset-1 mx-auto mt-2">
                                                      <button class="btn btn-warning btn-block btn_service_desc_one_para">
                                                         Edit Service Description!!
                                                      </button>
                                                   </div>
                                                </div>

                                                <div class="service_desc_one_input">
                                                   <div class="row row-cols-1 offset-11 mr-3">
                                                      <button class="btn btn-danger btn-sm service_desc_one_input_close">
                                                         x
                                                      </button>
                                                   </div>

                                                  
                                                   <div class="service_desc_one_data summernote">

                                                      {!! $company->service_desc_one !!}
                                                      
                                                   </div >

                                                   <div class="row row-cols-8 offset-1 mx-auto mt-2">
                                                      <button class="btn btn-success btn-block btn_service_desc_one_data">
                                                         Submit
                                                      </button>
                                                   </div>
                                                   
                                                   
                                                </div>
                                                
                                                
                                             </div>
                                          </div>


                                       </div>
                                     </div>
                                   </div>


                                   <div class="accordion-item">
                                     {{-- <h2 class="accordion-header" id="flush-headingTwo"> --}}
                                       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                         Service Label Two
                                       </button>
                                     {{-- </h2> --}}
                                     <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                       <div class="accordion-body">

                                          <div class="row">
                                             
                                             <div class="row">
                                                <div class="col-md-3">
                                                   <h2 class="service_label_two_label" for="service_label_two">
                                                   {{$company->service_label_two}}
                                                   <i class="fas fa-edit btn btn-sm btn-warning mb-5 btn_service_label_two_label"></i>
                                                </h2>

                                                   <div class=" service_label_two_input">
                                                      <div class="input-group">
                                                        
                                                         <input type="text" name="service_label_two" value="{{$company->service_label_two}}" class="form-control service_label_two_data text-dark" aria-describedby="basic-addon2">
                                                         {{-- <button  class="input-group-text text-dark service_label_two_input_close" id="basic-addon2">
                                                            x
                                                         </button> --}}
                                                      </div>

                                                         <div class="row row-cols-6  mx-auto mt-2">
                                                            <button class="btn btn-success btn-block btn-sm btn_service_label_two_data">
                                                               Submit
                                                            </button>
                                                         </div>

                                                         <div class="row row-cols-6  mx-auto mt-2">
                                                            <button class="btn btn-danger btn-block btn-sm service_label_two_input_close">
                                                               Cancel
                                                            </button>
                                                         </div>
                                                      </div>

                                                   </div>

                                               

                                             <div class="col-md-9">

                                                <div class="service_desc_two_para">
                                                  
                                                   <p >
                                                      {!! $company->service_desc_two !!}
                                                   </p>

                                                   <div class="row row-cols-8 offset-1 mx-auto mt-2">
                                                      <button class="btn btn-warning btn-block btn_service_desc_two_para">
                                                         Edit Service Description!!
                                                      </button>
                                                   </div>
                                                </div>

                                                <div class="service_desc_two_input">
                                                   
                                                
                                                   <div class="row row-cols-1 offset-11 mr-3">
                                                      <button class="btn btn-danger btn-sm service_desc_two_input_close">
                                                         x
                                                      </button>
                                                   </div>


                                                   <div class="service_desc_two_data summernote">

                                                      {!! $company->service_desc_two !!}
                                                   </div>

                                                   <div class="row row-cols-8 offset-1 mx-auto mt-2">
                                                      <button class="btn btn-success btn-block btn_service_desc_two_data">
                                                         Submit
                                                      </button>
                                                   </div>

                                                </div>

                                             </div>
                                          </div>

                                       </div>
                                     </div>
                                   </div>
                                  </div>


                                   <div class="accordion-item">
                                     {{-- <h2 class="accordion-header" id="flush-headingThree"> --}}
                                       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                         Service Label Three
                                       </button>
                                     {{-- </h2> --}}
                                     <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                       <div class="accordion-body">
                                          
                                          <div class="row">
                                             <div class="col-md-3">
                                                <h2 class="service_label_three_label" for="service_label_one">
                                                {{$company->service_label_three}}
                                                <i class="fas fa-edit btn btn-sm btn-warning mb-5 btn_service_label_three_label"></i>
                                             </h2>

                                                <div class=" service_label_three_input">

                                                   <div class="input-group">
                                                      
                                                   
                                                   <input type="text" name="service_label_three" value="{{$company->service_label_three}}" class="form-control service_label_three_data text-dark" aria-describedby="basic-addon3">

                                                  {{--  <button class="input-group-text text-dark service_label_three_input_close" id="basic-addon3">
                                                      x
                                                   </button> --}}
                                                   </div>

                                                   <div class="row row-cols-6  mx-auto mt-2">
                                                      <button class="btn btn-success btn-block btn-sm btn_service_label_three_data">
                                                         Submit
                                                      </button>
                                                   </div>

                                                   <div class="row row-cols-6  mx-auto mt-2">
                                                      <button class="btn btn-danger btn-block btn-sm service_label_three_input_close">
                                                         Cancel
                                                      </button>
                                                   </div>
                                                   

                                                </div>

                                             </div>
                                             
                                             <div class="col-md-9">

                                                <div class="service_desc_three_para">
                                                  
                                                   <p >
                                                      {!! $company->service_desc_three !!}
                                                   </p>

                                                   <div class="row row-cols-8 offset-1 mx-auto mt-2">
                                                      <button class="btn btn-warning btn-block btn_service_desc_three_para">
                                                         Edit Service Description!!
                                                      </button>
                                                   </div>
                                                </div>
                                                <div class="service_desc_three_input">
                                                   
                                                
                                                  <div class="row row-cols-1 offset-11 mr-3">
                                                      <button class="btn btn-danger btn-sm service_desc_three_input_close">
                                                         x
                                                      </button>
                                                   </div>

                                                   <div class="form-control service_desc_three_data summernote">

                                                      {!! $company->service_desc_three !!}
                                                   </div>

                                                   <div class="row row-cols-8 offset-1 mx-auto mt-2">
                                                      <button class="btn btn-success btn-block btn_service_desc_three_data">
                                                         Submit
                                                      </button>
                                                   </div>

                                                </div>


                                             </div>
                                          </div>

                                       </div>
                                     </div>
                                   </div>
                                 </div>



                                 
                                
                                {{--  <div class="col-md-5 mx-auto general_info_update">
                                    
                                       <div class="row form-group">
                                          <label class="form-control-label col-md-4 mt-2 ml-5" for="service_label_one">Service Label One</label>

                                          <div class="col-md-6 ">
                                             <input type="text" class="form-control service_label_one text-dark" readonly value="{{$company->service_label_one}}" name="service_label_one">
                                          </div>
                                       
                                       </div>

                                       <div class="row form-group">
                                          <label class="form-control-label col-md-4 mt-2 ml-5" for="service_label_two">Service label Two</label>

                                          <div class="col-md-6 ">
                                             <input type="text" class="form-control service_label_two text-dark" readonly value="{{$company->service_label_two}}" name="service_label_two">
                                          </div>
                                       
                                       </div>

                                       <div class="row form-group">
                                          <label class="form-control-label col-md-4 mx-0 mt-2 ml-5" for="service_label_three">Service Label Three</label>

                                          <div class="col-md-6">
                                             <input type="text" class="form-control service_label_three text-dark" readonly value="{{$company->service_label_three}}" name="service_label_three">
                                          </div>
                                       
                                       </div>

                                 </div>


                                 <div class="col-md-5 mx-auto general_info_update">

                                       <div class="row form-group">
                                          <label class="form-control-label col-md-4 mx-0 mt-2 ml-3" for="service_desc_one">Service Desc One</label>

                                          <div class="col-md-6 mx-0">
                                             <input type="text" class="form-control service_desc_one text-dark" readonly value="{{$company->service_desc_one}}" name="service_desc_one">
                                          </div>
                                       
                                       </div>

                                       <div class="row form-group">
                                          <label class="form-control-label col-md-4 mx-0 mt-2 ml-3" for="service_desc_two">Service Desc Two</label>

                                          <div class="col-md-6 mx-0">
                                             <input type="text" class="form-control service_desc_two text-dark" readonly value="{{$company->service_desc_two}}" name="service_desc_two">
                                          </div>
                                    
                                       </div>

                                       

                                       <div class="row form-group">
                                          <label class="form-control-label col-md-4 mx-0 ml-3" for="service_desc_three">Service Desc Three</label>

                                          <div class="col-md-6 mx-0">
                                             <input type="text" class="form-control service_desc_three text-dark" readonly value="{{$company->service_desc_three}}" name="service_desc_three">
                                          </div>
                                       
                                       </div>

                                       <div class="row form-group">
                                          <label class="form-control-label col-md-4 mx-0 ml-3" for="info">Info</label>

                                          <div class="col-md-6 mx-0">
                                             <textarea class="form-control info text-dark" readonly name="info">{{$company->info}}</textarea>
                                             
                                          </div>
                                       
                                       </div>
                                       
                                    </div>
                                    

                                 </div> --}}

                                 {{-- <div class="row">
                                    <div class="col-md-5 mx-auto">
                                       <button class="btn btn-success btn-block btn_submit_general">
                                          Submit
                                       </button>
                                    </div>
                                 </div>

                                 <div class="row">
                                    <div class="col-md-5 mx-auto">
                                       <button class="btn btn-warning btn-block btn_edit_general">
                                          Click Here!If you want edit your general Info.
                                       </button>
                                    </div>
                                 </div> --}}
                                 

                              </div>
                           </div>
                           
                       </div>
                   </div>
                  </div>
                </div>
             </div>
          </div>
          {{-- end. here --}}
      </div>
      <!-- Footer -->
      <x-footer-component/>
      {{-- footer end --}}
      {{-- modal start --}}
      
    </div>
@endsection

@section('script')
<script type="text/javascript">
   $(document).ready(function(){

      $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $('.btn_submit').hide();
      $('.btn_submit_general').hide();

      $('.service_label_one_input').hide();
      $('.service_label_two_input').hide();
      $('.service_label_three_input').hide();

      $('.service_desc_one_input').hide();
      $('.service_desc_two_input').hide();
      $('.service_desc_three_input').hide();


      // service label one
      $('.btn_service_label_one_label').click(function() {
         $('.service_label_one_input').show();
         $('.service_label_one_label').hide();
      })

      $('.service_label_one_input_close').click(function() {
         $('.service_label_one_input').hide();
         $('.service_label_one_label').show();
      })


      // service lable two
      $('.service_label_two_label').click(function() {
         $('.service_label_two_input').show();
         $('.service_label_two_label').hide();
      })

      $('.service_label_two_input_close').click(function() {
         $('.service_label_two_input').hide();
         $('.service_label_two_label').show();
      })

      // service label three
      $('.service_label_three_label').click(function() {
         $('.service_label_three_input').show();
         $('.service_label_three_label').hide();
      })

      $('.service_label_three_input_close').click(function() {
         $('.service_label_three_input').hide();
         $('.service_label_three_label').show();
      })



      // service desc one
      $('.btn_service_desc_one_para').click(function() {
         $('.service_desc_one_input').show();
         $('.service_desc_one_para').hide();
      })

      $('.service_desc_one_input_close').click(function() {
         $('.service_desc_one_input').hide();
         $('.service_desc_one_para').show();
      })

      // service desc two
      $('.btn_service_desc_two_para').click(function() {
         $('.service_desc_two_input').show();
         $('.service_desc_two_para').hide();
      })

      $('.service_desc_two_input_close').click(function() {
         $('.service_desc_two_input').hide();
         $('.service_desc_two_para').show();
      })


      // service desc three
      $('.btn_service_desc_three_para').click(function() {
         $('.service_desc_three_input').show();
         $('.service_desc_three_para').hide();
      })

      $('.service_desc_three_input_close').click(function() {
         $('.service_desc_three_input').hide();
         $('.service_desc_three_para').show();
      })


      // service update process

      $('.btn_service_label_one_data').click(function() {
         var id = $('.company_id').val();
         var service_label_one_data = $('.service_label_one_data').val();
         var value = {};
         value['id'] = id;
         value['service_label_one_data'] = service_label_one_data;
         var array = new Array;
         array.push(value);
         service_data_update(value);
      })

      $('.btn_service_label_two_data').click(function() {
         var id = $('.company_id').val();
         var service_label_two_data = $('.service_label_two_data').val();
         var value = {};
         value['id'] = id;
         value['service_label_two_data'] = service_label_two_data;
         var array = new Array;
         array.push(value);
         service_data_update(value);
      })

      $('.btn_service_label_three_data').click(function() {
         var id = $('.company_id').val();
         var service_label_three_data = $('.service_label_three_data').val();
         var value = {};
         value['id'] = id;
         value['service_label_three_data'] = service_label_three_data;
         var array = new Array;
         array.push(value);
         service_data_update(value);
      })


      



      // service_desc_ update process

      $('.btn_service_desc_one_data').click(function() {
         var id = $('.company_id').val(); 
         var service_desc_one_data =$('.service_desc_one_data').summernote('code');

         var value = {};
         value['id'] = id;
         value['service_desc_one_data'] = service_desc_one_data;
         var array = new Array;
         array.push(value);
         service_data_update(value);

      })

      $('.btn_service_desc_two_data').click(function() {
         var id = $('.company_id').val(); 
         var service_desc_two_data =$('.service_desc_two_data').summernote('code');
         
         var value = {};
         value['id'] = id;
         value['service_desc_two_data'] = service_desc_two_data;
         var array = new Array;
         array.push(value);
         service_data_update(value);

      })

      $('.btn_service_desc_three_data').click(function() {
         var id = $('.company_id').val(); 
         var service_desc_three_data =$('.service_desc_three_data').summernote('code');
         
         var value = {};
         value['id'] = id;
         value['service_desc_three_data'] = service_desc_three_data;
         var array = new Array;
         array.push(value);
         service_data_update(value);

      })


      function service_data_update(result) {
         console.log(result);
         $.ajax({
            url:'/ajax/edit_company_service_info',
            type:"POST",
            data:result,
           
            success:function(data){
               location.reload();
               showtag();
            },
            error:function(err){
              console.log(err);
            }
          })
      }










      showtag();

      $('a[data-toggle="tab"]').click(function (e) {
         e.preventDefault();
         $(this).tab('show');

      });

      $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
          localStorage.setItem('currentActiveTab', $(e.target).attr('id'));
      });

      var selectedlocal = localStorage.getItem('currentActiveTab');
      if(selectedlocal == null){
         var selectedTab = "tabs-icons-text-1-tab";
      }
      
         var data = ('#'+selectedTab);
         $(data).tab('show'); 
         console.log(selectedTab);
         if(selectedTab == "tabs-icons-text-1-tab"){

            tag = 0;
            showtag(tag);

         }else{

            tag = 1;
            showtag(tag);
         }
         
      

      function showtag(data) {
         
         if(data){
            console.log(data);
            tab = 1;
         }else{
            tab = 0;
         }

         if(tab == 1){
            $('.general_nav_tab').addClass('active show');
            $('.general_nav').addClass('active');
            $('.main_nav').removeClass('active');
            $('.main_nav_tab').removeClass('active show');

         }else{

            $('.general_nav_tab').removeClass('active show');
            $('.general_nav').removeClass('active');
            $('.main_nav').addClass('active');
            $('.main_nav_tab').addClass('active show');
         }
      }

      

      $('#upload_company_logo').change(function(e){

         e.preventDefault();
         let formData = new FormData(this);

         $.ajax({
            url:'/ajax/edit_company_logo',
            type:"POST",
            data:formData,
            contentType: false,
            processData: false,
            success:function(data){
               location.reload();
               showtag(data);

            },
            error:function(err){
              console.log(err);
            }
          })
         
      })


      $('#upload_company_photo').change(function(e){

         e.preventDefault();
         let formData = new FormData(this);

         $.ajax({
            url:'/ajax/edit_company_photo',
            type:"POST",
            data:formData,
            contentType: false,
            processData: false,
            success:function(data){
               location.reload();
               showtag(data);
            },
            error:function(err){
              console.log(err);
            }
          })
         
      })

      $('.btn_edit').click(function() {
         $('.btn_edit').hide(1000);
         $('.btn_submit').show(1000);

         $('.main_info_update input').attr('readonly',false);
         $('.main_info_update textarea').attr('readonly',false);

      })


      $('.btn_submit').click(function(e){

         var id = $('.company_id').val();
         var username = $('.user_name').val();
         var company_name = $('.company_name').val();
         var ceo_name = $('.ceo_name').val();
         var email = $('.email').val();
         var phone = $('.phone').val();
         var incharge_name = $('.incharge_name').val();
         var incharge_phone = $('.incharge_phone').val();
         var incharge_position = $('.incharge_position').val();
         var address = $('.address').val();
         var info = $('.info').val();

         // console.log(username,ceo_name,email,phone,incharge_name,incharge_phone,incharge_position,address)


         $.ajax({
            url:'/ajax/edit_main_info',
            type:"POST",
            data:{id:id,username:username,company_name:company_name,ceo_name:ceo_name,email:email,phone:phone,incharge_name:incharge_name,incharge_phone:incharge_phone,incharge_position:incharge_position,address:address,info:info},
            
            success:function(data){
               location.reload();
               showtag(data);

            },
            error:function(err){
              console.log(err);
            }
          })
         
      })

      

   })
</script>
@endsection
