@extends('frontendTemplate')
@section('main')
<!-- Header-->
 @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
        @include('layouts.slider')
        <x-searching :cities="$cities"  ></x-searching>

        <div class="d-none">
            <div class="container mt-0 my-3">
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
                            <hr class="mx-2">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-0">${{$room->pricepernight}}</h4>
                                    <span class="price-desc small mb-2 text-muted">per night</span>
                                    <span class="total-desc  small mb-2 text-dark ">{{$room->pricepernight+ 10}} total</span><br/>
                                     
                                    <span class="fee-include  small mb-2 text-dark ">includes tax and fees</span>
                                </div>
                                <div>
                                     <span class="left-msg  small mb-2 text-danger ">We have 4 left!</span>
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
        
@endsection
@section('script')
<script>
    
</script>
@endsection