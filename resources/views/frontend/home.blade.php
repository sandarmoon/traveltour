@extends('frontendnew') @section('header')

<x-searchingnew ></x-searchingnew>




@endsection @section('main-content')
<!-- Header-->

@if (session()->has('message'))
<div class="alert alert-success">
 {{ session("message") }}
</div>
@endif



<div class="d-none">
 <div class="container mt-0 my-3">
  <div class="row">
   @foreach($rooms as $room) @php
   $photos=json_decode($room->photos,true); $s=0; @endphp
   <div class="col-md-4">
    <div class="card">
     <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
       @foreach($photos as $k=>$p)
       <div class="carousel-item {{
                                    $s == $k ? 'active' : ''
                                }}">
        <img src="{{ asset("storage/$p") }}" class="d-block w-100" alt="...">
       </div>
       @endforeach
      </div>
     </div>
     <div class="card-body">
      <h6 class="mb-0">
       {{$room->type->name}},
       {{($room->single == null) ?  '':$room->single." Single"}}
       {{($room->double == null) ?  '':$room->double." Double"}}
       {{($room->king == null) ?  '':$room->king." King"}}
       {{($room->queen == null) ?  '':$room->queen." Queen"}}
       Beds, Non Smoking
      </h6>
      <p class="small text-muted">{{$room->wide}}Sqft</p>
      {{-- accordian start --}}
      <ul class="list-unstyled">
       <li>
        <i class="fas fa-user-friends"></i>
        Sleep{{$room->ppl}}
       </li>
       <li>
        <i class="fas fa-bed"></i>
        {{($room->single == null) ?  '':$room->single." Single"}}
        {{($room->double == null) ?  '':$room->double." Double"}}
        {{($room->king == null) ?  '':$room->king." King"}}
        {{($room->queen == null) ?  '':$room->queen." Queen"}}
        Bed
       </li>
       <li>
        <i class="fas fa-check"></i> Reserve Now,Pay
        Later
       </li>
       <li>
        <a href="{{route('room.show',$room->id)}}" class="text-decoration-none">More Details ></a>
       </li>
      </ul>
      <hr class="mx-2" />
      <div class="d-flex justify-content-between">
       <div>
        <h4 class="mb-0">${{$room->pricepernight}}</h4>
        <span class="price-desc small mb-2 text-muted">per night</span>
        <span class="total-desc small mb-2 text-dark">{{$room->pricepernight+ 10}} total</span><br />

        <span class="fee-include small mb-2 text-dark">includes tax and fees</span>
       </div>
       <div>
        <span class="left-msg small mb-2 text-danger">We have 4 left!</span>
        <a href="#" class="btn btn-primary mt-3">Reserve Now!</a>
       </div>
      </div>
      {{-- accordian end --}}
     </div>
    </div>
   </div>
   @endforeach
  </div>
 </div>
</div>



<section class="py-0">
    <div class="container mt-5">
        <div class="row shadow">
            <div class="col-md-4 col-sm-12 col-lg-4  py-3 px-3 bg-light">
                
                <h4> <i class="fas fa-tag text-secondary d-inline me-2" style="font-size: 20px;"></i> Best Price</h4>
                <p class="py-3 ms-4" style="font-size: 17px;">You can find the cheapest price among many car or hotel and package.</p>
            </div>

            <div class="col-md-4 col-sm-12 col-lg-4  py-3 px-3 bg-light">
                
                
                <h4><i class="fas fa-save d-inline me-2 text-secondary" style="font-size: 20px;"></i> Easy & Secure</h4>
                <p class="py-3 ms-4" style="font-size: 17px;">
                    Booking and Payment process is totally protected and secured.
                </p>
            </div>


            <div class="col-md-4 col-sm-12 col-lg-4  py-3 px-3 bg-light">
                <i class="fas fa-clock text-secondary d-inline me-2" style="font-size: 20px;"></i>
                <h4 class=" d-inline">24/7 Support</h4>
                <p class="py-3 ms-4" style="font-size: 17px;">
                    We are support you at any moment of your needs.
                </p>
            </div>


        </div>
    </div>
</section>


{{-- popular packages --}}

<section class="py-0">
 <div class="container mt-5">
  <div class="row justify-content-center pb-4">
   <div class="
                    col-md-12
                    heading-section
                    text-center
                    ftco-animate
                    fadeInUp
                    ftco-animated
                ">
    <h2 class="mb-4">Popular Packages</h2>
   </div>
  </div>

  <div class="row">

   @foreach($packages as $package)

   @php
   $s=0;
   $tours=$package->tours;
   $photos=[];
   foreach($tours as $t){
   $places=json_decode($t->photo,true);
   foreach($places as $v){
   array_push($photos,$v);
   }
   }
   @endphp

   <div class="col-md-4 ftco-animate fadeInUp ftco-animated">
    <div class="project-wrap">
     <!-- <a
                        href="#"
                        class="img"
                        style="background-image:url({{
                            url('frontnew/assets/img/file/myanmar.jpeg')
                        }})"
                    >
                        <span class="price">$550/person</span>
                    </a> -->
     <div class="my-img">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
       <div class="carousel-inner">
        @foreach($photos as $k=>$p)
        <div class="carousel-item {{
                                        $s == $k ? 'active' : ''
                                    }}">
         <img src="{{ asset('storage/'.$p) }}" class="d-block w-100" alt="..." />
        </div>
        @endforeach
       </div>
       <button class="carousel-control-prev visually-hidden" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
       </button>
       <button class="carousel-control-next visually-hidden" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
       </button>
      </div>
      <span class="packageprice">${{$package->priceperperson}}/person</span>
     </div>
     <div class="text p-4">
      <span class="days">{{$package->days}} Days Tour</span>
      <h3 class="mb-2"><a href="#">{{$package->name}}</a></h3>
      <p class="location">
       <span class="fa fa-map-marker"></span>
       @php $len=count($package->tours);
       $lastindex=$len-1;
       $places='';


       foreach($package->tours as $k=>$tours) {
       if($k == $lastindex)
       $places.=$tours->title;
       else
       $places.=$tours->title.',';
       }
       @endphp
       {{$places}}
      </p>

      <p><i class="fas fa-car fa_car_icon"></i> {{$package->car->name}} ({{$package->car->model}}-{{$package->car->type->name}}) </p>
      <p><i class="fas fa-hotel fa_hotel_icon"></i> {{$package->hotel->name}}</p>
      <ul class="text-center">

       <li class="">
        <a href="{{route('frontend_package_detail',$package->id)}}"><span class="flaticon-mountains"></span>More info</a>
       </li>
      </ul>
      @php
      $booked_ppl=$package->pbookings->sum('ppl');

      @endphp
      @if(Auth::check())
      <button data-id="{{$package->id}}" class="package-booking-btn btn btn-secondary form-control my-2 {{$booked_ppl == $package->ppl ? 'disabled':''}}">{{$booked_ppl == $package->ppl ? 'Full Booking':'Book Now'}}!</button>
      @else
      <a href="/login" class=" btn btn-secondary form-control my-2 {{$booked_ppl == $package->ppl ? 'disabled':''}}">{{$booked_ppl == $package->ppl ? 'Full Booking':'Book Now'}}!</a>
      @endif
     </div>
    </div>
   </div>

   @endforeach
  </div>
 </div>
</section>



{{-- popular aco written cars --}}
<section class="py-0">
 <div class="container mt-5">
  <div class=" justify-content-start ">
   <div class="
                    col-md-12
                    heading-section
                    text-center
                    ftco-animate
                    fadeInUp
                    ftco-animated
                ">
    <h2 class="mb-4">Popular Cars</h2>
   </div>
  </div>
  <div class="row">

   {{-- @php
   $car_arry =[];
   @endphp
   @foreach($cars as $car)


   @php
   $rating = 0;
   foreach($car->rating as $data){
   $rating += $data->rate;

   }

   $car_arry[$rating] = $car;


   @endphp

   @endforeach

   @php
   if(count($car->rating) > 0){
   krsort($car_arry);
   }else{
   $car_arry = $cars;
   }




   @endphp --}}

   @foreach($car_arry_data as $car)


   @php

   // $car=(object)$booking->car;

   $photos=json_decode($car[1]->photo,true);

   $cover=$photos['cover'];
   @endphp
   <div class="col-md-4">
    <div class="project-wrap">
     <!-- <a
                        href="#"
                        class="img"
                        style="background-image:url(http://localhost:8000/frontnew/assets/img/file/myanmar.jpeg)"
                    >
                        <span class="price">$550/person</span>
                    </a> -->
     <div class="my-img">
      <div class=" " style="height:280px;max-height: 260px;width: 100%;overflow: hidden;">
       <img src="{{asset('storage/'.$cover)}}" class="img-fluid " alt="photo">

      </div>
      <span class="packageprice">$50/person</span>
     </div>

     <div class="text p-4" style="background-color: #e8e8e866;box-shadow: 0px 10px 23px -8px rgb(0 0 0 / 33%);">
      <span class="text-muted  d-block text-center text-uppercase">{{$car[1]->company->name}}</span>
      <h3 class="text-center my-2">{{$car[1]->name}}/{{$car[1]->model}}<span style="font-size: 2rem; color: #f15d30;padding-left: 5px;">{{$car[1]->priceperday}}$</span></h3>
      <hr style="border:1px solid #f15d30 ;">
      <!-- start strart here  -->



      <p class="rating text-center">
       <i class="fas fa-star-half-alt"></i>
       @php
       $rating = 0;
       foreach($car[1]->rating as $data){
       $rating += $data->rate;
       }

       @endphp
       {{$rating}}
       Stars

      </p>

      <ul class="text-center">
       <div class="@if(Auth::check()) rating-input @else rating_login @endif" data-car_id="{{$car[1]->id}}" data-type_id="{{$car[1]->type->parent_id}}">



        <span class="starone">
         <i class="fas fa-star star_one star_blank 
                                    @foreach($car[1]->rating as $rate)
                                        @if($rate->user_id == Auth::id())
                                            @if($rate->rate >= 1)
                                                star_color
                                            @endif
                                        @endif
                                    @endforeach" data-value="1" title="One Star"></i>
        </span>

        <span class="startow" title="Two Star"><i class="fas fa-star star_two star_blank
                                    @foreach($car[1]->rating as $rate)
                                        @if($rate->user_id == Auth::id())
                                            @if($rate->rate >= 2)
                                                star_color
                                            @endif
                                        @endif
                                    @endforeach
                                    
                                    
                                    " data-value="2"></i></span>

        <span class="starthree" title="Three Star"><i class="fas fa-star star_three star_blank
                                    @foreach($car[1]->rating as $rate)
                                        @if($rate->user_id == Auth::id())
                                            @if($rate->rate >= 3)
                                                star_color
                                            @endif
                                        @endif
                                    @endforeach" data-value="3"></i></span>

        <span class="starfour" title="Four Star"><i class="fas fa-star star_four star_blank
                                    @foreach($car[1]->rating as $rate)
                                        @if($rate->user_id == Auth::id())
                                            @if($rate->rate >= 4)
                                                star_color
                                            @endif
                                        @endif
                                    @endforeach" data-value="4"></i></span>

        <span class="starfive" title="Five Star"><i class="fas fa-star star_five star_blank
                                    @foreach($car[1]->rating as $rate)
                                        @if($rate->user_id == Auth::id())
                                            @if($rate->rate == 5)
                                                star_color
                                            @endif
                                        @endif
                                    @endforeach" data-value="5"></i></span>

        <br>
        {{-- <p class="bg-success text-white d-inline-block px-1 py-1 mt-1 star_text"></p> --}}
       </div>



      </ul>
      <!-- start end here  -->
      <p class="text-center mb-0"><a href="" class="btn-car-detail" data-id="{{$car[1]->id}}"><span class="flaticon-mountains"></span>More info</a></p>
      @if(Auth::check())
      <button data-id="" class="package-booking-btn btn {{$car[1]->status ==1 ? 'btn-secondary':'btn-danger'}} form-control my-2 {{$car[1]->status ==1 ? '':'disabled'}}">{{$car[1]->status == 1 ? 'Book Now':'Booked'}}</button>
      @else
      <a href="/login" class=" btn {{$car[1]->status ==1 ? 'btn-secondary':'btn-danger'}} form-control my-2 {{$car[1]->status ==1 ? '':'disabled'}}">{{$car[1]->status == 1 ? 'Book Now':'Booked'}}</a>
      @endif
     </div>
    </div>
   </div>

   @endforeach
  </div>
 </div>
</section>
<!-- popular car aco end  -->





{{-- tip and guide --}}


<section class="py-0">
    <div class="container mt-5">
        <div class=" justify-content-start ">
            <div class="
                    col-md-12
                    heading-section
                    text-center
                    ftco-animate
                    fadeInUp
                    ftco-animated
                ">
                <h2 class="mb-4">
                    Tips And Guides
                    @if(count($tours_carousel) > 0)
                    <span class="text-danger text-center d-block my-2" style="font-size: 15px;">Pull left or right for more data</span>
                    @endif
                </h2>

            </div>
        </div>

            <div class="your-class">

                @foreach($tours_carousel as $tour)
                <div>


                    <div class="card" style="width: 18rem;">
                      @php
                        $photo = json_decode($tour->photo);

                        $photo_array = array_rand($photo,1);
                      @endphp  

                      <div style="overflow: hidden; width: auto ; height: 180px;">

                          <img src="{{asset('storage/'.$photo[$photo_array])}}" class="card-img-top img-fluid" alt="..." >

                      </div>
                      
                      <div class="card-body">
                        <h4 class=" text-center">{{$tour->title}}</h4>
                        <h6 class="card-text text-center font-weight-normal text-uppercase my-2" style="font-size: 17px; color: #f15d30">{{$tour->city->name}}</h6>
                        <a href="{{route('frontend.tour_guide_detail',$tour->id)}}" class="btn btn-secondary form-control my-2">Detail</a>
                      </div>
                    </div>
                   
                </div>
                @endforeach

            </div>

            
       
</section>





{{-- popular hotel --}}
<section class="py-0 ">
 <div class="container mt-5">
  <div class="row justify-content-center pb-4">
   <div class="
                    col-md-12
                    heading-section
                    text-center
                    ftco-animate
                    fadeInUp
                    ftco-animated
                ">
    <h2 class="mb-4">Popular Hotel</h2>
   </div>
  </div>

  <div class="row">

   {{-- @php
   $hotel_array =[];
   @endphp
   @foreach($hotels as $hotel)

   @php
   $rating = 0;
   foreach($hotel->rating as $data){
   $rating += $data->rate;

   }

   $hotel_array[$rating] = $hotel;

   @endphp

   @endforeach

   @php
   if(count($hotel->rating) > 0){
   krsort($hotel_array);
   }else{
   $hotel_array = $hotels;
   }
   @endphp --}}

   @foreach($hotel_array_data as $hotel)

   <div class="col-md-4 ftco-animate fadeInUp ftco-animated">
    <div class="project-wrap">

     <div class="my-img">

      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
       <div class="carousel-inner">
        <img src="{{asset('storage/'.$hotel[1]->logo)}}" class="img-fluid">

       </div>

      </div>
      <div>

      </div>
      <span class="packageprice">{{$hotel[1]->city->name}}</span>
     </div>
     <div class="text p-4">
      <span class="days"></span>
      <h3 class="mb-2"><a href="#"></a></h3>
      <p><i class="fas fa-hotel fa_hotel_icon"></i> {{$hotel[1]->name}} </p>
      <p class="location">
       <i class="fas fa-phone"></i>
       {{$hotel[1]->phone}}

      </p>




      <p><i class="fas fa-location-arrow"></i> {{$hotel[1]->addresss}} </p>

      <p class="rating">
       <i class="fas fa-star-half-alt"></i>
       @php
       $rating = 0;
       foreach($hotel[1]->rating as $data){
       $rating += $data->rate;
       }

       @endphp
       {{$rating}}
       Stars

      </p>


      <ul class="text-center">
       <div class="@if(Auth::check()) rating-input @else rating_login @endif" data-hotel_id="{{$hotel[1]->id}}" data-type_id="1">

        <span class="starone">
         <i class="fas fa-star star_one star_blank 
                                    @foreach($hotel[1]->rating as $rate)
                                        @if($rate->user_id == Auth::id())
                                            @if($rate->rate >= 1)
                                                star_color
                                            @endif
                                        @endif
                                    @endforeach" data-value="1" title="One Star"></i>
        </span>

        <span class="startow" title="Two Star"><i class="fas fa-star star_two star_blank
                                    @foreach($hotel[1]->rating as $rate)
                                        @if($rate->user_id == Auth::id())
                                            @if($rate->rate >= 2)
                                                star_color
                                            @endif
                                        @endif
                                    @endforeach" data-value="2"></i></span>

        <span class="starthree" title="Three Star"><i class="fas fa-star star_three star_blank
                                    @foreach($hotel[1]->rating as $rate)
                                        @if($rate->user_id == Auth::id())
                                            @if($rate->rate >= 3)
                                                star_color
                                            @endif
                                        @endif
                                    @endforeach" data-value="3"></i></span>

        <span class="starfour" title="Four Star"><i class="fas fa-star star_four star_blank
                                    @foreach($hotel[1]->rating as $rate)
                                        @if($rate->user_id == Auth::id())
                                            @if($rate->rate >= 4)
                                                star_color
                                            @endif
                                        @endif
                                    @endforeach" data-value="4"></i></span>

        <span class="starfive" title="Five Star"><i class="fas fa-star star_five star_blank
                                    @foreach($hotel[1]->rating as $rate)
                                        @if($rate->user_id == Auth::id())
                                            @if($rate->rate == 5)
                                                star_color
                                            @endif
                                        @endif
                                    @endforeach" data-value="5"></i></span>

        <br>
        {{-- <p class="bg-success text-white d-inline-block px-1 py-1 mt-1 star_text"></p> --}}
       </div>


      </ul>

      @if(Auth::check())
      <button data-id="" class="package-booking-btn btn btn-secondary form-control my-2">Detail</button>
      @else
      <a href="/login" class=" btn btn-secondary form-control my-2">Detail</a>
      @endif
     </div>
    </div>
   </div>

   @endforeach
  </div>
 </div>
</section>




<x-feedback-component />






{{-- partnership --}}
<section class="pt-0">
 <div class="container mt-5">
  <div class="row mt-5">
   <div class="col-md-12 justify-content-center">
    <h1 class="text-center">Partnerships
        @if(count($partners) > 0)
        <span class="text-danger text-center d-block my-2" style="font-size: 15px;">Pull left or right for more data</span>
        @endif
    </h1>

   </div>
  </div>

  <div class="your-class">
    @foreach($partners as $partner)
    <div class="partnership_div">
        
    
        <div class="partnership_name_div">
         <h4 class="partnership_name">{{$partner->name}}</h4>
        </div>
        <div style="overflow: hidden; width: auto ; height: 180px; position: cover;">
        <img src="{{
                    asset(
                        'storage/'.$partner->logo
                    )
                }}" class="img-fluid" alt="..." />
        </div>
    </div>
    @endforeach

  </div>
 </div>
</section>




@include('layouts.footer')

<!-- Modal -->
<div class="modal fade" id="packageBookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
   <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Package Booking</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <div class="modal-body">

   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Save changes</button>
   </div>
  </div>
 </div>
</div>

@endsection
@push('script')
<script>
 $(document).ready(function() {
  $.ajaxSetup({
   headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
  });

        $('.package-booking-btn').click(function() {
            let id = $(this).data('id');
            console.log(id);

            Swal.fire({
                title: 'How many people with you for tour?'
                , input: 'number'
                , showCancelButton: !0
                , cancelButtonText: "No, cancel!"
                , confirmButtonText: "Go to booking"
                , reverseButtons: !0
                , allowOutsideClick: false
                , showLoaderOnConfirm: true
                , inputValidator: ((value) => {

                    if (value >= 11) {
                        return 'please give us a clall!';
                    }

                    if (value <= 0) {
                        return 'please select from more than one or one person';
                    }


                }),

            }).then((e) => {
                if (e.value) {
                    window.location.href = "/p/booking/" + id + "/" + e.value
                } else {
                    console.log('enter');
                }
            })


        })

        $('#contact-email-form').submit(function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            let token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/front/contact'
                , type: 'POST'
                , data: formData
                , beforeSend: function() {
                    swal.fire({

                        html: '<h5>Loading...</h5>'
                        , showConfirmButton: false
                        , allowOutsideClick: false,

                    });
                }
                , success: function(json) {
                    if (json) {
                        swal.fire({

                            title: 'Your message is send'
                            , text: 'Thank you so much'
                            , type: 'success'
                            , showConfirmButton: true,

                        }).then(() => {
                            $('#contact-email-form').trigger('reset');
                        });
                    }
                }
            })

        })




        $('#package-search-div').submit(function(e) {
            e.preventDefault();
            let packageid = $('#package-search-from').val();

            window.location.href = "/package_detail/" + packageid;

        })



 })

</script>
@endpush
