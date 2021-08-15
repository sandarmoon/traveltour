@extends('frontendTemplate')
@section('main')
<!-- Header-->
        
        <div class="col-md-10 offset-1 p-3 ">
            
            <div class="row">
                {{-- start here --}}
                <div class="col-md-12">

                	<ul class="nav nav-tabs" id="myTab" role="tablist">
					  <li class="nav-item" role="presentation">
					    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">OverView</button>
					  </li>
					  <li class="nav-item" role="presentation">
					    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Rooms</button>
					  </li>
					  <li class="nav-item" role="presentation">
					    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">More</button>
					  </li>
					</ul>

					<div class="tab-content" id="myTabContent">
						{{-- //for overview --}}
					  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					  	<div class="row h-100 ">
					  		<div class="col-md-7 ">
                              <div class="card-body">
                                <div class="my-3">
                                	<h1 class="hotel-heading-1 mb-0">{{$h->name}}</h1>
	                                <span class="heading-2 text-muted">{{$h->city->name}}</span>
                                </div>
                                <p class="card-text " style="font-size: 1.119rem;line-height: 1.4srem;">
                                   {{$h->info}}
                                   
                                   <h4 class="text-dark">Popular amenities</h4>
                                   	@foreach($popular_facilities as $k=>$f)
                                   	 <h5 class="text-dark">{{$k}}</h5>
                                   		<ul>
                                   			@foreach($f as $i)
                                   			<li>{{$i['name']}}</li>
                                   			@endforeach
                                   		</ul>
                                   	@endforeach

                                </p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p><i class="fas fa-wifi"></i> Wifi Included</p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    </div>
                                    <div>
                                        
                                    </div>
                                </div>
                              </div>
					  		</div>
					  		<div class="col-md-5 H-100  ">
					  			<div class="img-column">
					  				<img src="{{asset('storage/'.$h->logo)}}" style="width: 100%;height: auto;object-fit: cover;" alt="">
					  			</div>

					  		</div>
					  	</div>
					  </div>

					  {{-- //for rooms --}}
					  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<div class="row ">
			                @foreach($rooms as $room)
			                @php
			                $photos=json_decode($room->photos,true);
			                $s=0;
			                @endphp
			                <div class="col-md-4">
			                    <div class="card">
			                      <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
			                          <div class="carousel-inner">
			                            @foreach($photos as $k=>$p)
			                            <div class="carousel-item {{($s==$k) ? 'active':''}}">
			                              <img src="{{asset("storage/$p")}}" class="d-block w-100" alt="...">
			                            </div>
			                            @endforeach
			                          </div>
			                        </div>
			                      <div class="card-body">
			                        <h6 class="mb-0">{{$room->type->name}}, 
			                            {{($room->single == null) ?  '':$room->single." Single"}}
			                            {{($room->double == null) ?  '':$room->double." Double"}}
			                            {{($room->king == null) ?  '':$room->king." King"}}
			                            {{($room->queen == null) ?  '':$room->queen." Queen"}}
			                             Beds, Non Smoking </h6>
			                        <p class="small text-muted">{{$room->wide}}Sqft</p>
			                        {{-- accordian start --}}
			                            <ul class="list-unstyled">
			                                <li><i class="fas fa-user-friends"></i> Sleep{{$room->ppl}}</li>
			                                <li><i class="fas fa-bed"></i>
			                                    {{($room->single == null) ?  '':$room->single." Single"}}
			                                    {{($room->double == null) ?  '':$room->double." Double"}}
			                                    {{($room->king == null) ?  '':$room->king." King"}}
			                                    {{($room->queen == null) ?  '':$room->queen." Queen"}} Bed
			                                </li>
			                                <li>
			                                   <i class="fas fa-check"></i> Reserve Now,Pay Later
			                                </li>
			                                <li><a href="{{route('room.show',$room->id)}}" class="text-decoration-none">More Details ></a></li>
			                            </ul>
			                            <hr>
			                            <h6 class="description">Tax free is $10.(fixed)</h6>
			                            <hr class="mx-2">
			                            <div class="d-flex justify-content-between">
			                                <div>
			                                    <h4 class="mb-0">${{$room->pricepernight}}</h4>

			                                    <span class="price-desc small mb-2 text-muted">per night</span>
			                                    <span class="total-desc  small mb-2 text-dark ">{{$room->pricepernight+ 10}} total</span><br/>
			                                     
			                                    
			                                    <div class="my-tooltip">
			                                    	<span class="fee-include  small mb-2 text-dark ">includes tax and fees</span>
												  <div class=" tooltiptext">
												  	Tax Fee is 10$
												  	Total is {{$h->pricepernight}} + 10
												  </div>
												</div>
			                                </div>
			                                <div>
			                                     <span class="left-msg d-none  small mb-2 text-danger ">We have 4 left!</span>
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

					  {{-- //for More information --}}
					  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
					  	<div class="m-5">
					  		<h4>{{$h->service_label_one}}</h4>
					  		{!!$h->service_desc_one!!}
					  	</div>
					  </div>
					</div>
                        
                 </div>
                {{-- end here --}}

            </div>
            
        </div>
        <!-- Section for card-->
        
@endsection
@push('script')
<script>
    $(document).ready(function(){
       $('.card').click(function(){
            let id=$(this).data('id');
            window.location.href="rooms/"+id;
       })
    })
    
</script>
@endpush