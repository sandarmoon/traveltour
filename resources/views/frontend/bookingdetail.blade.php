@extends('frontendTemplate')
@section('main')
<!-- Header-->
 @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
       <section>
           <div class="container mt-5">
               <div class="d-flex justify-content-between align-items-center">
                   <h2> Booking History </h2>       
               </div>
           </div>

           @foreach($bookings as $booking)

           <div class="row mt-3 mb-2">
               <div class="col-md-10 mx-auto">
                   <div class="card shadow">
                        <div class="card-header">
                            @php
                            $date=date_create($booking->booking_date);
                            $date= date_format($date,"d M Y");
                            @endphp
                            {{$date}}
                        </div>
                        <div class="card-body mx-0">
                            <div class="row mb-3">
                                <ul class="nav nav-tabs" id="tabs-icons-text" role="tablist">
                    
                                  <li class="nav-item">
                                      <a class="nav-link mb-sm-3 mb-md-0 active car_nav" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
                                         Car Booking
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link mb-sm-3 mb-md-0 hotel_nav" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">
                                         Hotel Booking
                                      </a>
                                  </li>
                              </ul>
                            </div>



                            <div class="tab-content" id="myTabContent">

                           {{-- main info --}}
                               <div class="tab-pane fade active show car_nav_tab" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
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
                                                        <span class="col-md-5">Booking Code :</span>
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



                               {{-- general info --}}
                               <div class="tab-pane fade hotel_nav_tab" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                  Hotel info
                               </div>
                               
                           </div>
                        </div>
                    </div>
                </div>
            </div>

           @endforeach
       </section>
@endsection
@section('script')
<script type="text/javascript">

</script>
@endsection