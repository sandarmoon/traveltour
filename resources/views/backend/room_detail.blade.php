@extends('backendTemplate')
@section('main-content')


<div class="header bg-gradient-primary pb-4 pt-5 pt-md-7">
      <div class="container-fluid">
        <div class="my-ct-page-title text-white">
          <h1 class="ct-title text-white d-inline-block" id="content">
            Room Detail
          </h1>
         
          <a class="ct-example text-white float-right border-0" href="{{route('room.index')}}">
            <i class="fas fa-arrow-left me-1"></i>
                <span class="error-name">Go Back </span>
          </a>
          
        </div>
        
        
        
      </div>

    </div>


<div class="container">
	

	<div class="card container mt-3 my-3 p-3">
            <div class="d-flex justify-content-between my-3 mx-2">
                <h5 class="description d-inline-block "> Room Infromation from <span style="font-size: 16px;color: black;">{{$room->company->name}} Hotel </span></h5>
                {{-- <a href="{{url()->previous()}}" class="btn-close float-left"></a> --}}
            </div>

            <div class="col-md-10 offset-1">
                <div class="row">
                <div class="col-md-5">
                	
                     <h3 class="mb-0">{{$room->type->name}}, 
                            {{($room->single == null) ?  '':$room->single." Single"}}
                            {{($room->double == null) ?  '':$room->double." Double"}}
                            {{($room->king == null) ?  '':$room->king." King"}}
                            {{($room->queen == null) ?  '':$room->queen." Queen"}}
                             Beds, Non Smoking </h3>

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
                                       <i class="fas fa-money-bill-wave"></i> {{$room->pricepernight}} $ for one night
                                    </li>
                                   
                                </ul>

                                {{-- <h5 class="my-3">Room Amenities</h5>
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
                                  
                                </ul> --}}
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
                   
                   
                </div>
            </div>
            </div>
        </div>
</div>

@endsection