@extends('frontendTemplate')
@section('main')
<!-- Header-->
 @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
       <div class="container-fluid" style="height: 100vh;">

           <div class="container mt-5">
               <div class="d-flex justify-content-between align-items-center">
                @if($view == 1)
                   <h2> Booking History </h2>       
                @elseif($view == 2)
                    <h2>Car Booking</h2>
                    <a href="{{route('bookinghistory')}}" class="mr-5 float-right btn btn-info text-white"><i class="fas fa-arrow-left"></i> Back</a>
                @endif
                    
               </div>
           </div>

          

           <div class="row mt-3 mb-2">
               <div class="col-md-10 mx-auto">



                    {{-- booking history --}}

                   <div class="card shadow bookinghistory">
                    @if($view ==1 && count($bookings) > 0)
                        <div class="card-header">
                            

                            <div class="row">
                                

                              <nav>
                                  <div class="nav nav-tabs" id="nav-tab" role="tablist">

                                    {{-- @if(Auth::user()->bookings) --}}

                                    <button class="nav-link active car_nav" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                                        Car Booking
                                    </button>
                                    {{-- @else --}}

                                    <button class="nav-link hotel_nav" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                                         Hotel Booking
                                    </button>

                                    {{-- @endif --}}
                                  </div>
                                </nav>

                            </div>
                        </div>
                        <div class="card-body mx-0">
                            
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-content" id="nav-tabContent">
                                    {{-- car info --}}
                                  <div class="tab-pane fade show active car_nav_tab" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="row">
                                        <div class="col-md-12 mx-auto table-bordered">
                                           <table class="table table-responsive">
                                               <thead class="bg-dark text-white">
                                                   <tr>
                                                       <th>No.</th>
                                                       <th>Name</th>
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
                                                @foreach($bookings as $booking)
                                                   <tr>
                                                       <td>{{$i++}}.</td>
                                                       <td>{{$booking->user->name}}</td>
                                                       <td>{{$booking->user->email}}</td>
                                                       <td>{{$booking->car->name}}</td>
                                                       <td>{{$booking->car->brand->name}} / {{$booking->car->model}}</td>
                                                       <td>
                                                            @php
                                                            $date=date_create($booking->booking_date);
                                                            $date= date_format($date,"d M Y");
                                                            @endphp
                                                            {{$date}}
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
                                               </tbody>
                                           </table> 
                                        </div>
                                    </div>
                                  </div>


                                  {{-- hotel info --}}
                                  <div class="tab-pane fade hotel_nav_tab" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                      

                                    <table class="table table-responsive">
                                       <thead class="bg-dark text-white">
                                           <tr>
                                               <th>No.</th>
                                               <th>Name</th>
                                               <th>Email</th>
                                               <th>Room</th>
                                               <th>Travellers</th>
                                               <th>Booking Date</th>
                                               <th>Status</th>
                                               <th>Action</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                        @php
                                        $i=1;
                                        @endphp
                                        @foreach($bookings as $booking)
                                           <tr>
                                               <td>{{$i++}}.</td>
                                               <td>{{$booking->user->name}}</td>
                                               <td>{{$booking->user->email}}</td>
                                               <td>{{$booking->car->name}}</td>
                                               <td>{{$booking->car->brand->name}} / {{$booking->car->model}}</td>
                                               <td>
                                                    @php
                                                    $date=date_create($booking->booking_date);
                                                    $date= date_format($date,"d M Y");
                                                    @endphp
                                                    {{$date}}
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
                                       </tbody>
                                   </table> 


                                  </div>

                                 
                                </div>

                           
                           </div>
                        </div>
                    @else
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

                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-4">
                                    @php
                                        $car=(object)$booking->car;
                                       
                                        $photos=json_decode($car->photo,true);

                                        $cover=$photos['cover'];
                                    @endphp 
                                    <img src="{{asset('storage/'.$cover)}}" class="rounded-circle img-fluid" width="360px" height="295px">
                                </div>

                                <div class="col-md-8 mx-auto">
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Booking</h5>
                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5 ">Booking Code :</span>
                                                <span class="col-md-7">{{$booking->booking_code}}</span>
                                            </div>

                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5">Booking Date :</span>
                                                <span class="col-md-7">{{$booking->booking_date}}</span>
                                            </div>

                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5">From - To City :</span>
                                                <span class="col-md-7">{{$booking->from->name}} - {{$booking->to->name}}</span>
                                            </div>

                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5">Day : </span>
                                                <span class="col-md-7">{{$booking->day}}</span>
                                            </div>

                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5">Pickup : </span>
                                                <span class="col-md-7">{{$booking->pickup->name}},{{$booking->pickup->parent->name}}</span>
                                            </div>

                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5">Time : </span>
                                                <span class="col-md-7">{{$booking->pickup_time}}</span>
                                            </div>

                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5">Detaure Date : </span>

                                                @php
                                                $departure_date=date_create($booking->departure_date);
                                                $departure_date= date_format($departure_date,"d / M / Y");
                                                @endphp
                                               
                                                <span class="col-md-7">{{$departure_date}}</span>
                                            </div>

                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5">Arrival Date : </span>

                                                @php
                                                $arrival_date=date_create($booking->arrival_date);
                                                $arrival_date= date_format($arrival_date,"d / M / Y");
                                                @endphp
                                               
                                                <span class="col-md-7">{{$arrival_date}}</span>
                                            </div>

                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5">Status : </span>
                                                @if($booking->status == 1)

                                                <span class="col-md-7 text-primary">Pending</span>

                                                @elseif($booking->status == 2)

                                                <span class="col-md-7 text-success">Confirm</span>

                                                @elseif($booking->status == 3)
                                                <span class="col-md-7 text-danger">Cancel</span>

                                                @endif
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <h5>Car Info</h5>
                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5">Name :</span>
                                                <span class="col-md-7">{{$booking->car->name}}</span>
                                            </div>

                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5">Brand : </span>

                                                
                                                <span class="col-md-7">{{$booking->car->brand->name}}</span>
                                            </div>

                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5">Car Model :</span>
                                                <span class="col-md-7">{{$booking->car->model}}</span>
                                            </div>

                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5">Type : </span>

                                                
                                                <span class="col-md-7">{{$booking->car->type->name}}</span>
                                            </div>

                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5">Seats :</span>
                                                <span class="col-md-7">{{$booking->car->seats}} </span>
                                            </div>

                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5">Doors : </span>
                                                <span class="col-md-7">{{$booking->car->doors}}</span>
                                            </div>

                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5">Air Bag : </span>
                                                <span class="col-md-7">{{$booking->car->bags}}</span>
                                            </div>

                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5">Aircon : </span>
                                                <span class="col-md-7">
                                                    @if($booking->car->aircon == 0)
                                                        <span>No</span>
                                                    @elseif($booking->car->aircon == 1)
                                                        <span>Yes</span>

                                                    @endif
                                                </span>
                                            </div>

                                            <div class="row row-cols-10 mt-2">
                                                <span class="col-md-5">Price Per Day: </span>
                                                <span class="col-md-7">${{$booking->car->priceperday}}</span>
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
@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function(){
        var view = {{$view}};

        if(view == 1){
            $('.bookinghistory').show();
            $('.car_bookingdetail').hide();

        }else if(view == 2){

            $('.bookinghistory').hide();
            $('.car_bookingdetail').show();

        }
    })
</script>
@endpush

