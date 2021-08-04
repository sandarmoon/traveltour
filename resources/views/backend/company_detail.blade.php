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
                         @role('Admin|Doctor')
                         <div class="col-4 text-right">
                            <a href="" class="btn btn-sm btn-primary">Edit Profile</a>
                         </div>
                         @endrole
                      </div>
                   </div>
                   <div class="card-body">
                    <div class="row" >
                         <div class="col-xl-7 col-lg-7 col-md-6 col-sm-6 col-xs-6 col-6 ">
                            <h6 class="heading-small text-muted mb-4">General information</h6>
                            <div class="row  p-lg-2 p-md-2 p-sm-0 p-sx-0 p-0" >
                               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 col-12 mt-lg-0 mt-md-3 mt-sm-3 mt-xs-3 mt-3">
                                  <p class="description mb-0 ">Company Name:</p>
                                  <h5 class="heading-my ml-3 " style="transform: none;">{{$company->name}}</h5>
                               </div>
                               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 col-12 mt-lg-0 mt-md-3 mt-sm-3 mt-xs-3 mt-3">
                                  <p class="description mb-0 ">Status:</p>
                                  
                                    @if($company->status ==1)
                                    <h5 class="heading-my text-success ml-3 " style="transform: none;">active
                                    @else
                                    <h5 class="heading-my text-danger ml-3 " style="transform: none;">inactive
                                    @endif
                                  </h5>
                               </div>
                            </div>
                            <div class="row mt-3  p-lg-2 p-md-2 p-sm-0 p-sx-0 p-0">
                               <div class="col-xl-6 col-lg-6  col-md-12 col-sm-12 col-xs-12 col-12 mt-lg-0 mt-md-3 mt-sm-3 mt-xs-3 mt-3">
                                  <p class="description mb-0 ">Ceo_name:</p>
                                  <h5 class="heading-my ml-3 " style="transform: none;">{{$company->ceo_name}}</h5>
                               </div>
                               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 col-12 mt-lg-0 mt-md-3 mt-sm-3 mt-xs-3 mt-3">
                                  <p class="description mb-0 ">Phone:</p>
                                  <h5 class="heading-my ml-3 " style="transform: none;">{{$company->phone}}</h5>
                               </div>
                            </div>
                            <div class="row mt-3  p-lg-2 p-md-2 p-sm-0 p-sx-0 p-0">
                               <div class="col-xl-6 col-lg-6  col-md-12 col-sm-12 col-xs-12 col-12 mt-lg-0 mt-md-3 mt-sm-3 mt-xs-3 mt-3">
                                  <p class="description mb-0 ">Address:</p>
                                  <h5 class="heading-my ml-3 my-td " style="transform: none;">
                                     {{$company->addresss}}
                                  </h5>
                               </div>
                               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 col-12 mt-lg-0 mt-md-3 mt-sm-3 mt-xs-3 mt-3">
                                  <p class="description mb-0 ">Register Date:</p>
                                  <h5 class="heading-my ml-3 my-td " style="transform: none;">
                                     @php
                                     $date=date_create($company->created_at);
                                     $date= date_format($date,"Y M dS ");
                                     @endphp
                                     {{$date}}
                                  </h5>
                               </div>
                            </div>
                            
                         </div>
                         <!-- user information -->
                         <div class="col-xl-5 col-lg-5 col-md-6 col-sm-6 col-xs-6 col-6 ">
                            <h6 class="heading-small text-muted mb-4">InCharge Person Information</h6>
                            <div class="row  p-lg-2 p-md-2 p-sm-0 p-sx-0 p-0" >
                               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 mt-lg-0 mt-md-3 mt-sm-3 mt-xs-3 mt-3">
                                  <p class="description mb-0 ">Name:</p>
                                  <h5 class="heading-my ml-3 " style="transform: none;">{{$company->incharge_name}}</h5>
                               </div>
                               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 mt-lg-0 mt-md-3 mt-sm-3 mt-xs-3 mt-3">
                                  <div id="preview-certificate"  data-img=""><span class="description">Position:</span>
                                     {{-- @if(!empty($doctor->certificate))
                                     <?php $array=json_decode($doctor->certificate,true);
                                        foreach($array as $k=>$a):?>
                                     <img src="{{asset($a)}}" class="showimg"  data-id="{{$k}}" data-img="{{$doctor->certificate}}" width="40" height="40">
                                     <?php endforeach; ?>
                                     @endif
                                     --}}
                                  </div>
                                   <h5 class="heading-my ml-3 " style="transform: none;">{{$company->incharge_position}}</h5> 
                               </div>
                               <!-- <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 col-12 mt-lg-0 mt-md-3 mt-sm-3 mt-xs-3 mt-3">
                                  <p class="description mb-0 ">Password:</p>
                                          <h5 class="heading-my ml-3 " style="transform: none;">*********</h5>
                                        </div> -->
                            </div>
                            <div class="row mt-3  p-lg-2 p-md-2 p-sm-0 p-sx-0 p-0">
                               <div class="col-xl-12 col-lg-12  col-md-12 col-sm-12 col-xs-12 col-12 mt-lg-0 mt-md-3 mt-sm-3 mt-xs-3 mt-3">
                                  <div id="preview-license" class="mt-4" data-img=""><span class="description">Phone:</span>
                                     {{-- @if(!empty($doctor->license))
                                     <?php $array=json_decode($doctor->license,true);
                                        foreach($array as $k=>$a):?>
                                     <img src="{{asset($a)}}" class="showimg" data-id="{{$k}}"   width="40" height="40">
                                     <?php endforeach; ?>
                                     @endif --}}
                                  </div>
                                   <h5 class="heading-my ml-3 " style="transform: none;">{{$company->incharge_phone}}</h5>
                               </div>
                               <!-- <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 col-12 mt-lg-0 mt-md-3 mt-sm-3 mt-xs-3 mt-3">
                                  <p class="description mb-0 ">NRC NO:</p>
                                            <h5 class="heading-my ml-3 " style="transform: none;">9/AHMAZA(N)0987665</h5>
                                        </div> -->
                            </div>
                            
                         </div>
                      </div>
                      @if(!empty($company->service_label_one))
                      <div class="row" >
                         <h6 class="heading-small text-muted mb-4">More Information</h6>
                         <table class="table-bordered border-collapse">
                          
                           <tr>
                             <td class="p-2 "><h5 class="heading-my ml-3 " style="transform: none;">{{$company->service_label_one}}</h5></td>
                             <td class="p-2 "><h5 class="heading-my ml-3 " style="transform: none;"></h5>{{$company->service_desc_one}}</td>
                           </tr>
                           <tr>
                             <td class="p-2 "><h5 class="heading-my ml-3 " style="transform: none;">{{$company->service_label_two}}</h5></td>
                             <td class="p-2 "><h5 class="heading-my ml-3 " style="transform: none;"></h5>{{$company->service_desc_two}}</td>
                           </tr>
                           <tr>
                             <td class="p-2 "><h5 class="heading-my ml-3 " style="transform: none;">{{$company->service_label_three}}</h5></td>
                             <td class="p-2 "><h5 class="heading-my ml-3 " style="transform: none;"></h5>{{$company->service_desc_three}}</td>
                           </tr>
                         </table>
                      </div>
                      @endif
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
