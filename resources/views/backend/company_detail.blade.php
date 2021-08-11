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
                           <h3 class=" p-0 pr-4 mt-3 ">{{$company->name}}</h3>
                            
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
                                   
                                    <img src="{{asset('/storage/'.$company->logo)}}" class="rounded-circle " width="150px" height="150px">

                                    <form method="post" id="upload_company_logo" enctype="multipart/form-data">
                                       @csrf
                                     <div class="row">
                                        <div class="col-md-4 mt-3 mx-auto">
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
                                 {{-- <form method="post" action="" class="main_info_update"> --}}
                                 <div class="col-md-5 mx-auto main_info_update">
                                    
                                       <div class="row form-group">
                                          <label class="form-control-label col-md-4 mt-2 ml-3" for="ceo_name">Ceo Name</label>

                                          <div class="col-md-6 ">
                                             <input type="text" class="form-control ceo_name text-dark" readonly value="{{$company->ceo_name}}" name="ceo_name">
                                          </div>
                                       
                                       </div>

                                       <div class="row form-group">
                                          <label class="form-control-label col-md-4 mt-2 ml-3" for="company_name">Comapny Name</label>

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

                                       

                                       <div class="row form-group">
                                          <label class="form-control-label col-md-4 mx-0 ml-3" for="email">Status</label>

                                          <div class="col-md-6 mx-0">
                                             @if($company->status == 1)
                                                <span class="text-success font-weight-bold">active</span>
                                             @endif
                                          </div>
                                       
                                       </div>
                                    

                                 </div>


                                 <div class="col-md-5 mx-auto main_info_update">
                                    {{-- <form method="post" action="" class="main_info_update"> --}}

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
                                          <label class="form-control-label col-md-4 mx-0 mt-2 ml-3" for="incharge_position">Address</label>

                                          <div class="col-md-6 mx-0">
                                             <textarea class="form-control address text-dark" rows="3" readonly>
                                                {{$company->addresss}}
                                             </textarea>
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
                                    {{-- </form> --}}

                                 </div>
                                 {{-- </form> --}}

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

                                 <div class="col-md-2">
                                   
                                    <img src="{{asset('/storage/'.$company->photo)}}" class="rounded circle " width="200px" height="220px">

                                    <form method="post" id="upload_company_photo" enctype="multipart/form-data">
                                       @csrf
                                     <div class="row">
                                        <div class="col-md-4 mt-3 mx-auto">
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
                                
                                 <div class="col-md-5 mx-auto general_info_update">
                                    
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
                                    {{-- <form method="post" action="" class="main_info_update"> --}}

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
                                             <textarea class="form-control info text-dark" readonly name="info">
                                                {{$company->info}}
                                             </textarea>
                                             
                                          </div>
                                       
                                       </div>
                                       
                                    </div>
                                    

                                 </div>

                                 <div class="row">
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
                                 </div>
                                 

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
      $('.btn_submit').hide();
      $('.btn_submit_general').hide();

      showtag();

      $('a[data-toggle="tab"]').click(function (e) {
         e.preventDefault();
         $(this).tab('show');

      });

      $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
          localStorage.setItem('currentActiveTab', $(e.target).attr('id'));
      });

      var selectedTab = localStorage.getItem('currentActiveTab');
      
         var data = ('#'+selectedTab);
         $(data).tab('show'); 

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

      $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

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

         $('.btn_edit_general').click(function() {
            $('.btn_edit_general').hide(1000);
            $('.btn_submit_general').show(1000);

            $('.general_info_update input').attr('readonly',false);
            $('.general_info_update textarea').attr('readonly',false);

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



      $('.btn_submit_general').click(function(e){

         var id = $('.company_id').val();
         var service_label_one = $('.service_label_one').val();
         var service_label_two = $('.service_label_two').val();
         var service_label_three = $('.service_label_three').val();
         var service_desc_one = $('.service_desc_one').val();
         var service_desc_two = $('.service_desc_two').val();
         var service_desc_three = $('.service_desc_three').val();
         

         $.ajax({
            url:'/ajax/edit_general_info',
            type:"POST",
            data:{id:id,
                  service_label_one:service_label_one,
                  service_label_two:service_label_two,
                  service_label_three:service_label_three,
                  service_desc_one:service_desc_one,
                  service_desc_two:service_desc_two,
                  service_desc_three:service_desc_three},
            
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
