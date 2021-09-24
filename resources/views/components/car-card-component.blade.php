<div class="row">
 @foreach($cars as $car)

 @php
 $photos=json_decode($car->photo,true);
 $cover='storage/'.$photos['cover'];

 @endphp



 {{-- start --}}
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
     <img src="{{asset($cover)}}" class="img-fluid " alt="photo">

    </div>
    <span class="packageprice">
    ${{$car->discount ? $car->discount: $car->priceperday}}
     
    </span>
   </div>

   <div class="text p-4" style="background-color: #e8e8e866;box-shadow: 0px 10px 23px -8px rgb(0 0 0 / 33%);">
    <span class="text-muted  d-block text-center text-uppercase">{{$car->company->name}}</span>
    <h3 class="text-center my-2">{{$car->name}}/{{$car->model}}
    
     <span style="font-size: 1rem; color: #f15d30;" class="{{$car->discount ? 'text-decoration-line-through':'d-none'}}" >${{$car->priceperday}}</span>
     
    </h3>
    <hr style="border:1px solid #f15d30 ;">
    <!-- start strart here  -->



    <p class="rating text-center">
     <i class="fas fa-star-half-alt"></i>
     @php
     $rating = 0;
     foreach($car->rating as $data){
     $rating += $data->rate;
     }

     @endphp
     {{$rating}}
     Stars

    </p>

    <ul class="text-center">
     <div class="@if(Auth::user()) rating-input @else rating_login @endif" data-car_id="{{$car->id}}" data-type_id="{{$car->type->parent_id}}">



      <span class="starone">
       <i class="fas fa-star star_one star_blank 
                                    @foreach($car->rating as $rate)
                                        @if($rate->user_id == Auth::id())
                                            @if($rate->rate >= 1)
                                                star_color
                                            @endif
                                        @endif
                                    @endforeach" data-value="1" title="One Star"></i>
      </span>

      <span class="startow" title="Two Star"><i class="fas fa-star star_two star_blank
                                    @foreach($car->rating as $rate)
                                        @if($rate->user_id == Auth::id())
                                            @if($rate->rate >= 2)
                                                star_color
                                            @endif
                                        @endif
                                    @endforeach
                                    
                                    
                                    " data-value="2"></i></span>

      <span class="starthree" title="Three Star"><i class="fas fa-star star_three star_blank
                                    @foreach($car->rating as $rate)
                                        @if($rate->user_id == Auth::id())
                                            @if($rate->rate >= 3)
                                                star_color
                                            @endif
                                        @endif
                                    @endforeach" data-value="3"></i></span>

      <span class="starfour" title="Four Star"><i class="fas fa-star star_four star_blank
                                    @foreach($car->rating as $rate)
                                        @if($rate->user_id == Auth::id())
                                            @if($rate->rate >= 4)
                                                star_color
                                            @endif
                                        @endif
                                    @endforeach" data-value="4"></i></span>

      <span class="starfive" title="Five Star"><i class="fas fa-star star_five star_blank
                                    @foreach($car->rating as $rate)
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
    <p class="text-center mb-0"><a href="" class="btn-car-detail" data-id="{{$car->id}}"><span class="flaticon-mountains"></span>More info</a></p>
    @if(Auth::check())
    <button data-id="" wire:click="firstStepSubmit({{$car->id}})" class="package-booking-btn btn {{$car->status ==1 ? 'btn-secondary':'btn-danger'}} form-control my-2 {{$car->status ==1 ? '':'disabled'}}">{{$car->status == 1 ? 'Book Now':'Booked'}}</button>

    @else
    <a href="/login" class=" btn {{$car->status ==1 ? 'btn-secondary':'btn-danger'}} form-control my-2 {{$car->status ==1 ? '':'disabled'}}">{{$car->status == 1 ? 'Book Now':'Booked'}}</a>
    @endif
   </div>
  </div>
 </div>

 {{-- end --}}

 @endforeach
</div>

{{-- old-car-card 
<div class="col-md-6 mb-5 mt-3">
 <div class="card mb-3 ">
  @if($car->status ==2)
  <h2 class="justify-content-end d-inline float-right"><span class="badge bg-danger">Booked</span></h2>
  @endif
  <div class="row g-0 ">
   <div class="col-md-5">
    <img src="{{asset($cover)}}" style="min-height: 100%;" class="img-fluid " alt="...">
</div>
<div class="col-md-7">
 <div class="card-body">
  <span class=""></span>
  <div class="ct-page-title">
   <div class="small mb-1">{{$car->company->name}}</div>
   <h4 class="ct-title  d-inline-block">{{$car->name.'('.$car->model.')'}}
   </h4>



   <button type="button" class=" float-left btn btn-primary position-relative">
    <span class="{{($car->discount ==0) ? 'text-white':'text-decoration-line-through'}}">${{$car->priceperday}}</span>

    @if($car->discount !=0)
    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
     {{$car->discount}}
     <span class="visually-hidden">discount</span>
    </span>
    @endif
   </button>
   <div class="clear-both"></div>
   <span class="ct-lead">{{$car->type->name}}</span>

  </div>
  <div class="ct-content">
   <ul>
    <li>Automatic</li>
    <li>{{$car->seats}} people</li>
    <li>{{$car->doors}} Doors</li>
    <li>{{($car->aircon==1) ? 'Full Air Conditional':'Limited Air Conditional'}}</li>
    @if($car->bags > 0)
    <li>{{$car->bags}} air bags included!</li>
    @endif
   </ul>
   <a class="btn btn-success {{($car->status ==2) ? 'd-none':''}}">Book Now!</a>


  </div>
 </div>
</div>
</div>
</div>

</div>

--}}
