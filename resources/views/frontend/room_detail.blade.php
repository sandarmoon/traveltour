@extends('frontendnew')
@section('main')
<!-- Header-->
 @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
        

        

        <div class="card container mt-3 my-3 p-3">
            <div class="d-flex justify-content-between my-3 mx-2">
                <h5 class="description d-inline-block "> Room Infromation</h5>
                <a href="{{url()->previous()}}" class="btn-close float-left"></a>
            </div>

            <div class="col-md-10 offset-1">
                <div class="row">
                <div class="col-md-5">
                     <h4 class="mb-0">{{$room->type->name}}, 
                            {{($room->single == null) ?  '':$room->single." Single"}}
                            {{($room->double == null) ?  '':$room->double." Double"}}
                            {{($room->king == null) ?  '':$room->king." King"}}
                            {{($room->queen == null) ?  '':$room->queen." Queen"}}
                             Beds, Non Smoking </h4>

                        <p class="small text-muted">{{$room->wide}}Sqft</p>
                            {{-- accordian start --}}
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item" style="font-size: 1.135rem;"><i class="fas fa-user-friends"></i> Sleep{{$room->ppl}}</li>
                                    <li class="list-group-item" style="font-size: 1.135rem;"><i class="fas fa-bed"></i>
                                        {{($room->single == null) ?  '':$room->single." Single"}}
                                        {{($room->double == null) ?  '':$room->double." Double"}}
                                        {{($room->king == null) ?  '':$room->king." King"}}
                                        {{($room->queen == null) ?  '':$room->queen." Queen"}} Bed
                                    </li>
                                    <li class="list-group-item" style="font-size: 1.135rem;">
                                       <i class="fas fa-check"></i> Reserve Now,Pay Later
                                    </li>
                                   
                                </ul>

                                <h5 class="my-3">Room Amenities</h5>
                                <ul class="list-group list-unstyled">
                                    @foreach($data as $k=>$v)
                                      <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                          <div class="fw-bold">{{$k}}</div>
                                            <ul>
                                                @foreach($v as $i)
                                                <li>{{$i['name']}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        
                                      </li>
                                   @endforeach
                                  
                                </ul>
                </div>
                @php
                $photos=json_decode($room->photos,true);
                $s=0;
                @endphp
                <div class="col-md-7">
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

                   </div>
                   <h4 class="description mt-3">Room Option</h4>
                   <div class="card mt-2">
                       
                        <div class="card-footer">
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
                        </div>
                   </div>
                </div>
            </div>
            </div>
        </div>
        @include('layouts.foot')
@endsection
@section('script')
<script>
    
</script>
@endsection