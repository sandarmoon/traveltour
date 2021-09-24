@extends('frontendnew')
@section('main-content')
<!-- Header-->

       <div class="container-fluid style_height" style="height: 100vh;">

           <div class="container mt-5">
               <div class="d-flex justify-content-between align-items-center">
                @if($view == 1)
                   <h2> Booking History </h2>       
                @elseif($view == 2)
                    <h2>Car Booking</h2>
                    <a href="{{route('bookinghistory')}}" class="mr-5 float-right btn btn-info text-white"><i class="fas fa-arrow-left"></i> Back</a>
                @elseif($view == 3)
                    <h2>Hotel Booking</h2>
                    <a href="{{route('bookinghistory')}}" class="mr-5 float-right btn btn-info text-white"><i class="fas fa-arrow-left"></i> Back</a>
                @elseif($view == 4)
                    <h2>Package Booking</h2>
                    <a href="{{route('bookinghistory')}}" class="mr-5 float-right btn btn-info text-white"><i class="fas fa-arrow-left"></i> Back</a>
                @endif
                    
               </div>
           </div>

          

           <div class="row mt-3 mb-2" >
               <div class="col-md-10 mx-auto">



                    {{-- booking history --}}

                   <div class="card shadow bookinghistory">
                    @if($view == 1 && count($bookings) > 0 || count($booking_historys) > 0 || count($packages_booking) > 0 )
                        <div class="card-header">
                            

                            <div class="row">
                                

                              <nav>
                                  <div class="nav nav-tabs" id="nav-tab" role="tablist">

                                    @if(count($bookings) > 0)

                                    <button class="nav-link @if(count($bookings) > 0) active @endif car_nav" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                                        Car Booking
                                    </button>

                                    @endif

                                    @if(count($booking_historys) > 0)

                                    <button class="nav-link hotel_nav @if(count($booking_historys) > 0 && count($bookings) == 0 ) active @endif" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                                         Hotel Booking
                                    </button>
                                    @endif

                                    @if(count($packages_booking) > 0)

                                    <button class="nav-link package_nav @if(count($packages_booking) > 0 && count($bookings) == 0 && count($booking_historys) == 0) 
                                        active @endif" id="nav-package-tab" data-bs-toggle="tab" data-bs-target="#nav-package" type="button" role="tab" aria-controls="nav-package" aria-selected="false">
                                         Package Booking
                                    </button>

                                    @endif


                                  </div>
                                </nav>

                            </div>
                        </div>
                        <div class="card-body mx-0">
                            
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-content" id="nav-tabContent">
                                    {{-- car info --}}
                                  <div class="tab-pane fade @if(count($bookings) > 0)  show active @endif car_nav_tab" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="row">
                                        <div class="col-md-12 mx-auto table-bordered table-responsive">
                                           <table class="table ">
                                               <thead class="bg-dark text-white">
                                                   <tr>
                                                       <th>No.</th>
                                                       <th>Codeno</th>
                                                       <th>Email</th>
                                                       <th>Car Name</th>
                                                       <th>Brand / Model</th>
                                                       <th>Booking Date</th>
                                                       <th>Status</th>
                                                       <th>Action</th>
                                                   </tr>
                                               </thead>
                                               <tbody>
                                                @php
                                                $i=1;
                                                @endphp

                                                @if(count($bookings) > 0)
                                                @foreach($bookings as $booking)
                                                   <tr>
                                                       <td>{{$i++}}.</td>
                                                       <td>{{$booking->booking_code}}</td>
                                                       {{-- <td>{{$booking->user->name}}</td> --}}
                                                       <td>{{$booking->user->email}}</td>
                                                       <td>{{$booking->car->name}}</td>
                                                       <td>{{$booking->car->brand->name}} / {{$booking->car->model}}</td>
                                                       <td>
                                                            {{$booking->booking_date}}
                                                       </td>
                                                       <td>
                                                          
                                                            @if($booking->status == 1)

                                                            <span class="col-md-7 text-primary">Pending</span>

                                                            @elseif($booking->status == 2)

                                                            <span class="col-md-7 text-success">Confirm</span>

                                                            @elseif($booking->status == 3)
                                                            <span class="col-md-7 text-danger">Cancel</span>

                                                            @endif
                                                       </td>
                                                       <td>
                                                            <a href="{{route('bookingdetail',$booking->id)}}" class="btn btn-info text-white">
                                                               Detail
                                                            </a>
                                                       </td>

                                                   </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="8" class="text-center my-5 py-4">
                                                        <h４ class="text-danger font-weight-bold">There is no car bookings</h4>
                                                    </td>
                                                </tr>
                                                @endif
                                               </tbody>
                                           </table> 
                                        </div>
                                    </div>
                                  </div>


                                  {{-- hotel info --}}
                                  <div class="tab-pane fade @if(count($booking_historys) > 0 && count($bookings) == 0 ) show active @endif hotel_nav_tab" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                      
                                    <div class="row">
                                        <div class="col-md-12 mx-auto table-bordered table-responsive">
                                            <table class="table table-responsive">
                                               <thead class="bg-dark text-white">
                                                   <tr>
                                                       <th>No.</th>
                                                       <th>Codeno</th>
                                                       <th>Email</th>
                                                       <th>Room</th>
                                                       <th>Check in/out</th>
                                                       <th>Booking Date</th>
                                                       <th>Status</th>
                                                       <th>Action</th>
                                                   </tr>
                                               </thead>
                                               <tbody>
                                                @php
                                                $i=1;
                                                @endphp
                                                @if(count($booking_historys) > 0)
                                                @foreach($booking_historys as $booking_date => $booking_history)
                                        
                                                   <tr>
                                                       
                                                       <td>{{$i++}}.</td>
                                                       <td>{{$booking_history[0]->codeno}}</td>
                                                       
                                                       <td>
                                                            {{$booking_history[0]->user->email}}

                                                        </td>
                                                       <td>
                                                           {{count($booking_history)}}
                                                       </td>

                                                       
                                                       <td>
                                                           {{$booking_history[0]->check_in}} - {{$booking_history[0]->check_out}}
                                                       </td>

                                                       <td>
                                                        @php
                                                            $b_date = date_create($booking_date);
                                                            $date= date_format($b_date,"m/d/Y ");
                                                        @endphp
                                                           {{$booking_date}}
                                                       </td>
                                                       <td>
                                                          
                                                            @if($booking_history[0]->status == 1)

                                                            <span class="col-md-7 text-primary">Pending</span>

                                                            @elseif($booking_history[0]->status == 2)

                                                            <span class="col-md-7 text-success">Confirm</span>

                                                            @elseif($booking_history[0]->status == 3)
                                                            <span class="col-md-7 text-danger">Cancel</span>

                                                            @endif
                                                       </td>
                                                       <td>
                                                            <a href="{{route('roombookingdetail',$booking_date)}}" class="btn btn-info text-white">
                                                               Detail
                                                            </a>
                                                       </td>

                                                   </tr>


                                                @endforeach
                                                @endif
                                               </tbody>
                                            </table> 
                                        </div>
                                    </div>


                                  </div>




                                  {{-- Package info --}}
                                  <div class="tab-pane fade 
                                        @if(count($packages_booking) > 0 && count($bookings) == 0 && count($booking_historys) == 0) 
                                            show active @endif
                                         package_nav_tab" id="nav-package" role="tabpanel" aria-labelledby="nav-package-tab">
                                      
                                    <div class="row">
                                        <div class="col-md-12 mx-auto table-bordered table-responsive">
                                            <table class="table table-responsive">
                                               <thead class="bg-dark text-white">
                                                   <tr>
                                                       <th>No.</th>
                                                       <th>Code</th>
                                                       <th>Package</th>
                                                       <th>Departuer / Arrival Date</th>
                                                       <th>Hotel</th>
                                                       <th>Car</th>
                                                       <th>Booking Date</th>
                                                       <th>Status</th>
                                                       <th>Action</th>
                                                   </tr>
                                               </thead>
                                               <tbody>
                                                @php
                                                $i=1;
                                                @endphp
                                                @if(count($packages_booking) > 0)
                                                @foreach($packages_booking as $booking_date => $package_booking)
                                        
                                                   <tr>
                                                       
                                                       <td>{{$i++}}.</td>
                                                       <td>{{$package_booking->codeno}}</td>
                                                       <td>
                                                        
                                                           {{$package_booking->package->name}}
                                                           <br>
                                                           {{$package_booking->package->days}}
                                                           @if($package_booking->package->days > 1)
                                                           days @else day @endif Package
                                                       
                                                       </td>
                                                       
                                                       
                                                       <td>
                                                            @php
                                                                $date = date_create($package_booking->package->start);
                                                                $start = date_format($date,'d.m.Y');
                                                            @endphp

                                                            @php
                                                                $date = date_create($package_booking->package->end);
                                                                $end = date_format($date,'d.m.Y');
                                                            @endphp
                                                           {{$start}} - {{$end}}
                                                       </td>

                                                       <td>
                                                           {{$package_booking->package->hotel->name}}
                                                       </td>

                                                       <td>
                                                           {{$package_booking->package->car->name}}
                                                       </td>

                                                       <td>
                                                        @php
                                                            $b_date = date_create($package_booking->created_at);
                                                            $date= date_format($b_date,"d.m.Y ");
                                                        @endphp
                                                           {{$date}}
                                                       </td>
                                                       <td>
                                                          
                                                            @if($package_booking->status == 1)

                                                            <span class="col-md-7 text-primary">Pending</span>

                                                            @elseif($package_booking->status == 2)

                                                            <span class="col-md-7 text-success">Confirm</span>

                                                            @elseif($package_booking->status == 3)
                                                            <span class="col-md-7 text-danger">Cancel</span>

                                                            @endif
                                                       </td>
                                                       <td>
                                                            <a href="{{route('frontend_pacakgebooking_detail',$package_booking->id)}}" class="btn btn-info text-white">
                                                               Detail
                                                            </a>
                                                       </td>

                                                   </tr>


                                                @endforeach
                                                @endif
                                               </tbody>
                                            </table> 
                                        </div>
                                    </div>


                                  </div>

                                 
                                </div>

                           
                           </div>
                        </div>
                    @elseif($view == 1)
                        <div class="text-center my-3">
                            <h2 class="text-center mt-4"> O o p s ... There is no booking  </h2>
                            <p> Your car or hotel booking will appear here. </p>
                            <p> What will your first book be? </p>
                            <img src="{{asset('frontend/img/empty_booking_history.gif')}}" width="40%" height="50%" class="img-fluid">
                        </div>
                        
                    @endif
                   </div>



                    {{-- car bookingdetail --}}
                    <div class="card shadow car_bookingdetail">
                        @if($view == 2 && $booking)

                        <div class="card-header">
                            <h5 class="d-inline mr-4">{{$booking->booking_date}}</h5>
                            
                            @if($booking->status == 1)
                            ( <span class="mx-2 text-primary"> Pending </span> )

                            @elseif($booking->status == 2)

                            ( <span class="mx-2 text-success"> Confirm </span> )

                            @elseif($booking->status == 3)
                            ( <span class="mx-2 text-danger"> Cancel </span> )

                            @endif
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="card-body">
                                    
                                
                                <div class="col-md-4 mx-auto">
                                    @php
                                        $car=(object)$booking->car;
                                       
                                        $photos=json_decode($car->photo,true);

                                        $cover=$photos['cover'];
                                    @endphp 
                                    <img src="{{asset('storage/'.$cover)}}" class="rounded-circle img-fluid mb-4" >
                                </div>

                                <div class="col-md-8 mx-auto border">
                                    
                                    <div class="row mx-4 mt-4">
                                        <div class="col-md-6">
                                            <h5>Booking</h5>


                                            <table class="table">
                                                <tr>
                                                    <td> Code :</td>
                                                    <td>{{$booking->booking_code}}</td>
                                                </tr>

                                                <tr>
                                                    <td>  From - To City :</td>
                                                    <td>{{$booking->from->name}} - {{$booking->to->name}}

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td> Time :</td>
                                                    <td>
                                                        {{$booking->pickup_time}}
                                                    </td>
                                                </tr>



                                                <tr>
                                                    <td> Detaure Date  :</td>
                                                    <td>
                                                        @php
                                                        // $departure_date=date_create($booking->departure_date);
                                                        // $departure_date= date_format($departure_date,"d / M / Y");
                                                        @endphp
                                                       {{$booking->departure_date}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td> Arrival Date  :</td>
                                                    <td>
                                                        @php
                                                        // $arrival_date=date_create($booking->arrival_date);
                                                        // $arrival_date= date_format($arrival_date,"d / M / Y");
                                                        @endphp
                                                       {{$booking->arrival_date}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td> Day :</td>
                                                    <td>
                                                        {{$booking->day}}@if($booking->day==1)day
                                                        @elseif($booking->day != 0)
                                                        days
                                                        @endif
                                                    </td>
                                                </tr>
                                                @if($booking->pickup)

                                                <tr>
                                                    <td> Location :</td>
                                                    <td>
                                                        {{$booking->pickup->name}},{{$booking->pickup->name}},{{$booking->pickup->parent->name}}
                                                    </td>
                                                </tr>
                                                
                                                @endif

                                               
                                            </table>


                                        </div>

                                        <div class="col-md-6">
                                            <h5>Car Info</h5>


                                            <table class="table">
                                                <tr>
                                                    <td> Name :</td>
                                                    <td>{{$booking->car->name}}</td>
                                                </tr>

                                                <tr>
                                                    <td>  Brand :</td>
                                                    <td>{{$booking->car->brand->name}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td> Car Model :</td>
                                                    <td>
                                                        {{$booking->car->model}}
                                                    </td>
                                                </tr>



                                                <tr>
                                                    <td>Type :</td>
                                                    <td>
                                                       {{$booking->car->type->name}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td> Seats  :</td>
                                                    <td>
                                                        {{$booking->car->seats}} @if($booking->car->seats == 1)Seat @elseif($booking->car->seats != 0) Seats @endif
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td> Doors :</td>
                                                    <td>
                                                        {{$booking->car->doors}} @if($booking->car->doors == 1)Door @elseif($booking->car->doors != 0) Doors @endif
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td> Air Bag :</td>
                                                    <td>
                                                        {{$booking->car->bags}} @if($booking->car->bags == 1)Bag @elseif($booking->car->bags != 0) Bags @endif
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td> Air Con :</td>
                                                    <td>
                                                        @if($booking->car->aircon == 0)
                                                            <span class="text-danger">No</span>
                                                        @elseif($booking->car->aircon == 1)
                                                            <span class="text-success">Yes</span>

                                                        @endif
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td>  Price Per Day :</td>
                                                    <td>
                                                        ${{$booking->car->priceperday}}
                                                    </td>
                                                </tr>
                                               

                                               
                                            </table>



                                        </div>
                                       
                                    </div>
                                </div>


                                </div>
                                
                            </div>
                            
                        </div>
                        
                        @endif
                    </div>


                    {{-- hotel booking --}}
                    <div class="card shadow hotel_bookingdetail">
                        @if($view == 3 && $hotelbooking)

                        <div class="card-header mb-4 py-3">
                            <h5 class="d-inline mr-4">{{$hotelbooking[0]->booking_date}}</h5>
                            
                            @if($hotelbooking[0]->status == 1)
                            ( <span class="mx-2 text-primary"> Pending </span> )

                            @elseif($hotelbooking[0]->status == 2)

                            ( <span class="mx-2 text-success"> Confirm </span> )

                            @elseif($hotelbooking[0]->status == 3)
                            ( <span class="mx-2 text-danger"> Cancel </span> )

                            @endif
                            
                        </div>


                        <div class="card-body">

                            <div class="row">
                                
                                <div class="card-body">
                                    
                                
                                
                                <div class="col-md-3 mx-auto ">
                                   <div class="mb-4">
                                       <img src="{{asset('storage/'.$hotelbooking[0]->room->company->logo)}}" class="rounded circle img-fluid">
                                   </div>
                                    
                                </div>

                                <div class="col-md-8 mx-auto border">
                                    
                                    <div class="row mt-3 mx-5 mt-4">
                                        <div class="col-md-6 col-lg-6 col-sm-12 ">
                                            <h5>Booking</h5>
                                            <table class="table">
                                                <tr>
                                                    <td> Code :</td>
                                                    <td>{{$hotelbooking[0]->codeno}}</td>
                                                </tr>

                                                <tr>
                                                    <td>  Day :</td>
                                                    <td>{{$hotelbooking[0]->days}}@if($hotelbooking[0]->days==1)day
                                                        @else 
                                                        days
                                                        @endif
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td> Check in Date :</td>
                                                    <td>
                                                        {{$hotelbooking[0]->check_in}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td> Check out Date :</td>
                                                    <td>
                                                        {{$hotelbooking[0]->check_out}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td> Hotel Name :</td>
                                                    <td>
                                                        {{$hotelbooking[0]->room->company->name}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td> Hotel Phone :</td>
                                                    <td>
                                                        {{$hotelbooking[0]->room->company->phone}}
                                                    </td>
                                                </tr>

                                                <tr >
                                                    <td width="46%"> Hotel Address :</td>
                                                    <td width="100%">
                                                        {{$hotelbooking[0]->room->company->addresss}}{{$hotelbooking[0]->room->company->city->name}}
                                                    </td>
                                                    
                                                </tr>
                                               
                                            </table>

                                            
                                        </div>

                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <h5>Traveller Info</h5>

                                            <table class="table">
                                                <tr>
                                                    <td>Total Traveller :</td>
                                                    <td>@php
                                                            $traveller = 0;
                                                        @endphp
                                                        @foreach($hotelbooking as $data)
                                                            @php
                                                                $traveller += $data->adult + $data->child;
                                                            @endphp
                                                        @endforeach
                                                        {{$traveller}} @if($traveller == 1)person @else people @endif 
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td> Adult / Child: </td>
                                                    <td>
                                                        @php
                                                            $adult = 0;
                                                            $child = 0;
                                                        @endphp
                                                        @foreach($hotelbooking as $data)
                                                            @php
                                                                $adult += $data->adult;
                                                                $child += $data->child;
                                                            @endphp
                                                        @endforeach
                                                        {{$adult}} @if($adult == 1)person @else people @endif / 
                                                        {{$child}} @if($child == 1)person @elseif($child != 0) people @endif
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td width="30%">Message :</td>
                                                    <td width="100%">{{$hotelbooking[0]->msg}}</td>
                                                </tr>
                                            </table>

                                            <div class="accordion accordionExample" >
                                                <h5>Room Info</h5>
                                                @foreach($hotelbooking as $key=>$data)
                                                  <div class="accordion-item">

                                                    <h2 class="accordion-header heading{{$key}}">
                                                      <button class="accordion-button text-dark collapsed" type="button" data-bs-toggle="collapse" data-bs-target=".collapse{{$key}}" 
                                                      @if($key==0) aria-expanded="true"  @endif
                                                       aria-controls="collapse{{$key}}">
                                                        {{$data->room->type->name}} - {{$data->room->name}}
                                                      </button>
                                                    </h2>

                                                    <div class="collapse{{$key}} accordion-collapse collapse " aria-labelledby="heading{{$key}}" data-bs-parent=".accordionExample">
                                                      <div class="accordion-body">
                                                        
                                                        <ul>
                                                            
                                                            <li class="my-2">
                                                                <span >Price per night : </span>
                                                                <span class="mx-4">
                                                                   $ {{$data->room->pricepernight}}
                                                                </span>
                                                                
                                                            </li>

                                                            <li class="my-2">
                                                                <span >Wide : </span>
                                                                <span class="mx-4">
                                                                    {{$data->room->wide}}
                                                                </span>
                                                                
                                                            </li>

                                                            <li class="my-2">
                                                                <span >Sleep : </span>
                                                                <span class="mx-4">
                                                                    {{$data->room->ppl}}
                                                                </span>
                                                                
                                                            </li>

                                                            <li class="my-2">
                                                                <div class="row">
                                                                    
                                                                
                                                                <div class="col-md-3">Bed :</div>
                                                                <div class="col-md-9">
                                                                    @if($data->room->single)
                                                                       ( Single - {{$data->room->single}} )
                                                                    @endif

                                                                    @if($data->room->double)
                                                                        ( Double - {{$data->room->double}} )
                                                                    @endif

                                                                    @if($data->room->king)
                                                                       ( King : {{$data->room->king}} )
                                                                    @endif

                                                                    @if($data->room->queen)
                                                                       ( Queen : {{$data->room->queen}} )
                                                                    @endif

                                                                </div>
                                                                </div>
                                                                
                                                            </li>
                                                        </ul>
                                                      </div>
                                                    </div>
                                                  </div>
                                                @endforeach

                                            </div>


                                                {{-- <ul>
                                                    <li class="my-2">
                                                        <span >Total Traveller :</span>
                                                        <span class="mx-4">
                                                            @php
                                                                $traveller = 0;
                                                            @endphp
                                                            @foreach($hotelbooking as $data)
                                                                @php
                                                                    $traveller += $data->adult + $data->child;
                                                                @endphp
                                                            @endforeach
                                                            {{$traveller}} @if($traveller == 1)person @else people @endif
                                                        </span>
                                                    </li>

                                                    <li class="my-2">
                                                        <span >Adult :</span>
                                                        <span class="mx-4">
                                                            @php
                                                                $adult = 0;
                                                            @endphp
                                                            @foreach($hotelbooking as $data)
                                                                @php
                                                                    $adult += $data->adult;
                                                                @endphp
                                                            @endforeach
                                                            {{$adult}} @if($adult == 1)person @else people @endif
                                                        </span>
                                                    </li>

                                                    <li class="my-2">
                                                        <span >Child :</span>
                                                        <span class="mx-4">
                                                            @php
                                                                $child = 0;
                                                            @endphp
                                                            @foreach($hotelbooking as $data)
                                                                @php
                                                                    $child += $data->child;
                                                                @endphp
                                                            @endforeach
                                                            {{$child}} @if($child == 1)person @elseif($child != 0) people @endif
                                                        </span>
                                                    </li>

                                                    <li class="my-2">
                                                        <span>Message</span>
                                                        <p class="mt-2 mx-3">
                                                            {{$hotelbooking[0]->msg}} 
                                                        </p>
                                                    </li>

                                                     <li class="my-2">
                                                        <span >Address :</span>
                                                        <span class="mx-4">
                                                            {{$hotelbooking[0]->address}} 
                                                        </span>
                                                    </li>
                                                </ul> --}}
                                                
                                            
                                        </div>
                                       
                                    </div>
                                    
                                    {{-- <div class="row">
                                        <div class="col-md-12 col-lg-12 col-sm-12">
                                            <h5 class="text-center">Room Info</h5>

                                            <div class="row mt-3">
                                                
                                            
                                                @foreach($hotelbooking as $data)
                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                <h6 class="font-weight-normal">Room Number {{$data->room->name}}</h6>
                                                <ul class="border">
                                                    <li class="my-2">
                                                        <span >Room Type : </span>
                                                        <span class="mx-4">

                                                            {{$data->room->type->name}}
                                                           
                                                        </span>
                                                        
                                                    </li>

                                                    <li class="my-2">
                                                        <span >Price per night : </span>
                                                        <span class="mx-4">
                                                            $ {{$data->room->pricepernight}}
                                                        </span>
                                                        
                                                    </li>

                                                    <li class="my-2">
                                                        <span >Wide : </span>
                                                        <span class="mx-4">
                                                            {{$data->room->wide}}
                                                        </span>
                                                        
                                                    </li>

                                                    <li class="my-2">
                                                        <span >Sleep : </span>
                                                        <span class="mx-4">
                                                            {{$data->room->ppl}}
                                                        </span>
                                                        
                                                    </li>

                                                    <li class="my-2">
                                                        <div class="row">
                                                            
                                                        
                                                        <div class="col-md-3">Bed :</div>
                                                        <div class="col-md-9">
                                                            @if($data->room->single)
                                                               ( Single - {{$data->room->single}} )
                                                            @endif

                                                            @if($data->room->double)
                                                                ( Double - {{$data->room->double}} )
                                                            @endif

                                                            @if($data->room->king)
                                                               ( King : {{$data->room->king}} )
                                                            @endif

                                                            @if($data->room->queen)
                                                               ( Queen : {{$data->room->queen}} )
                                                            @endif

                                                        </div>
                                                        </div>
                                                        
                                                    </li>
                                                </ul>
                                                </div>
                                                
                                                @endforeach

                                            </div> --}}
                                        </div>
                                    </div>
                                </div>

                                </div>

                                
                                
                            </div>
                            
                        </div>
                        
                        @endif
                    </div>



                    {{-- package booking --}}
                    <div class="card shadow package_bookingdetail">
                        @if($view == 4 && $package_booking)

                        <div class="card-header mb-4 py-3">
                            <h5 class="d-inline mr-4">{{$package_booking->package->name}}</h5>
                            <span>({{$package_booking->package->days}} @if($package_booking->package->days==1)day
                                @else 
                                days
                            @endif Package)</span>
                            
                            @if($package_booking->status == 1)
                            ( <span class="mx-2 text-primary"> Pending </span> )

                            @elseif($package_booking->status == 2)

                            ( <span class="mx-2 text-success"> Confirm </span> )

                            @elseif($package_booking->status == 3)
                            ( <span class="mx-2 text-danger"> Cancel </span> )

                            @endif
                            
                        </div>


                        <div class="card-body">

                            <div class="row">
                                

                                <div class="col-md-10 mx-auto border">
                                    
                                    <div class="row mt-3">

                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <h5>Booking</h5>

                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item" style="font-size: 1.135rem;"><i class="fas fa-code me-2"></i> 
                                                    {{$package_booking->codeno}}
                                                </li>
                                                <li class="list-group-item" style="font-size: 1.135rem;"><i class="fas fa-user me-2"></i>
                                                   {{$package_booking->ppl}} @if($package_booking->ppl > 1) Travellers @elseif($package_booking->ppl !=0)Traveller @endif
                                                    
                                                </li>

                                                <li class="list-group-item" style="font-size: 1.135rem;">
                                                   <i class="fas fa-money-bill-wave me-2"></i> 
                                                  
                                                   {{$package_booking->total}} $  for total travellers.
                                                </li>

                                                <li class="list-group-item" style="font-size: 1.135rem;">
                                                   <i class="fas fa-phone me-2"></i>{{$package_booking->phone}} 
                                                </li>

                                                <li class="list-group-item" style="font-size: 1.135rem;">
                                                   <i class="fas fa-location-arrow me-2"></i>{{$package_booking->address}} 
                                                </li>

                                                
                                                <li class="list-group-item" style="font-size: 1.135rem;">
                                                    <div class="row">
                                                        <div class="col-md-1 mx-0">
                                                             <i class="fas fa-envelope "></i>
                                                        </div>
                                                        <p class="col-md-10 mx-0">
                                                            {{$package_booking->msg}}
                                                        </p>
                                                    </div>
                                                    
                                                </li>
                                               
                                            </ul>

                                        </div>



                                        <div class="col-md-6 mx-auto">
                                            <h5>Package</h5>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item" style="font-size: 1.135rem;"><i class="fas fa-map-marker-alt me-2"></i> 

                                                    From <span class="text-dark">{{$package_booking->package->depart->name}}</span>  - 
                                                    To <span class="text-dark">{{$package_booking->package->destination->name}}</span>
                                                </li>
                                                <li class="list-group-item" style="font-size: 1.135rem;"><i class="fas fa-calendar me-2"></i>
                                                    @php
                                                        $date = date_create($package_booking->package->start);
                                                        $start = date_format($date,'d.m.Y');
                                                    @endphp

                                                    @php
                                                        $date = date_create($package_booking->package->end);
                                                        $end = date_format($date,'d.m.Y');
                                                    @endphp
                                                    {{$start}} - {{$end}} 
                                                    
                                                </li>

                                                <li class="list-group-item" style="font-size: 1.135rem;">
                                                   <i class="fas fa-money-bill-wave me-2"></i> {{$package_booking->package->priceperperson}}$  for one traveller.
                                                </li>

                                                <li class="list-group-item" style="font-size: 1.135rem;">
                                                   <i class="fas fa-users me-2"></i>Total ( {{$package_booking->package->ppl}} ) Travellers
                                                </li>

                                                <li class="list-group-item" style="font-size: 1.135rem;">
                                                   <i class="fas fa-hotel"></i><a href="" class="nav-link"> {{$package_booking->package->hotel->name}} </a>
                                                </li>

                                                 <li class="list-group-item" style="font-size: 1.135rem;">
                                                   <i class="fas fa-car me-2"></i> {{$package_booking->package->car->name}} - {{$package_booking->package->car->type->name}} {{$package_booking->package->car->model}} 
                                                </li>


                                               
                                                <li class="list-group-item" style="font-size: 1.135rem;">
                                                    <div class="row">
                                                        <div class="col-md-1 mx-0">
                                                             <i class="fas fa-toolbox "></i>
                                                        </div>
                                                        <p class="col-md-10 mx-0">
                                                            {{$package_booking->package->desc}}
                                                        </p>
                                                    </div>
                                                    
                                                </li>
                                               
                                            </ul>
                                            
                                        </div>



                                       
                                    </div>
                                    
                                    
                                </div>
                            </div>

                            <div class="row mt-4">
                                

                                <div class="col-md-10 mx-auto border py-4 px-4">

                                    <h5>Tour Direction</h5>

                                    {{-- tour --}}
                                    <div class="accordion accordionExample" >
                                        
                                        @foreach($package_booking->package->tours as $key=>$data)
                                          <div class="accordion-item my-2  shadow">

                                            <h2 class="accordion-header heading{{$key}}">
                                              <button class="accordion-button text-dark collapsed font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target=".collapse{{$key}}" 

                                              @if($key==0) aria-expanded="true"  @endif
                                               aria-controls="collapse{{$key}}" style="font-size: 20px;">
                                                {{$data->title}} - ( {{$data->city->name}} )
                                              </button>

                                            </h2>


                                            <div class="collapse{{$key}} accordion-collapse collapse " aria-labelledby="heading{{$key}}" data-bs-parent=".accordionExample">
                                              <div class="accordion-body">
                                                <div class="row fixed_container">

                                                    <div class="col-md-6 " >
                                                        {!! $data->desc !!}
                                                    </div>

                                                    <div class="col-md-6  ">

                                                        @php
                                                        $s=0;
                                                        $photo = [];
                                                       
                                                        $photos=json_decode($data->photo,true);
                                                        foreach($photos as $p){
                                                            array_push($photo,$p);
                                                        }
                                                       
                                                        
                                                        
                                                        @endphp
                                                        <div id="carouselExampleSlidesOnly" class="carousel slide " data-bs-ride="carousel ">
                                                          <div class="carousel-inner ">
                                                            @foreach($photos as $k=>$p)
                                                            <div class="carousel-item {{($s==$k) ? 'active':''}}">
                                                              <img src="{{asset("storage/$p")}}" class="d-block w-100" alt="...">
                                                            </div>
                                                            @endforeach
                                                          </div>
                                                        </div>

                                                    </div>


                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        @endforeach

                                    </div>
                                    
                                    
                                    
                                </div>
                            </div>

                             

                        </div>
                                
                    </div>


                </div>
                                
            </div>
                            
        </div>
                        
            @endif
        </div>
    </div>
</div>

          
       </div>
    @include('layouts.foot')
@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function(){
        var view = {{$view}};

        if(view == 1){
            $('.bookinghistory').show();
            $('.car_bookingdetail').hide();
            $('.hotel_bookingdetail').hide();
            $('.package_bookingdetail').hide();



        }else if(view == 2){

            $('.bookinghistory').hide();
            $('.car_bookingdetail').show();
            $('.hotel_bookingdetail').hide();
            $('.package_bookingdetail').hide();
            $('.style_height').removeAttr('style');



        }else if(view == 3){

            $('.bookinghistory').hide();
            $('.car_bookingdetail').hide();
            $('.hotel_bookingdetail').show();
            $('.package_bookingdetail').hide();
            $('.style_height').removeAttr('style');



        }else if(view == 4){

            $('.bookinghistory').hide();
            $('.car_bookingdetail').hide();
            $('.hotel_bookingdetail').hide();
            $('.package_bookingdetail').show();

            $('.style_height').removeAttr('style');
        }

        
    })
</script>
@endpush

