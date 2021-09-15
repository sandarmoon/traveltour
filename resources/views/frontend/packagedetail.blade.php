@extends('frontendnew')
@section('main-content')
<!-- Header-->
 @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
        

        <div class="card container mt-8 my-3 p-3">
            <div class="d-flex justify-content-between my-3 mx-2">
                <h3 class="description d-inline-block "> {{$package->name}} Package</h3>
                <a href="{{url()->previous()}}" class="btn-close float-left"></a>
            </div>

            <div class="col-md-10 offset-1">
                <div class="row">
                <div class="col-md-5">
                     
                        <h5 class="text-dark">{{$package->days}} days Package</h5>
                            {{-- accordian start --}}
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item" style="font-size: 1.135rem;"><i class="fas fa-map-marker-alt me-2"></i> 

                                        From <span class="text-dark">{{$package->depart->name}}</span>  - 
                                        To <span class="text-dark">{{$package->destination->name}}</span>
                                    </li>
                                    <li class="list-group-item" style="font-size: 1.135rem;"><i class="fas fa-calendar me-2"></i>
                                        @php
                                            $date = date_create($package->start);
                                            $start = date_format($date,'d.m.Y');
                                        @endphp

                                        @php
                                            $date = date_create($package->end);
                                            $end = date_format($date,'d.m.Y');
                                        @endphp
                                        {{$start}} - {{$end}} 
                                        
                                    </li>

                                    <li class="list-group-item" style="font-size: 1.135rem;">
                                       <i class="fas fa-money-bill-wave me-2"></i> {{$package->priceperperson}}$  for one traveller.
                                    </li>

                                    <li class="list-group-item" style="font-size: 1.135rem;">
                                       <i class="fas fa-users me-2"></i>Total ( {{$package->ppl}} ) Travellers
                                    </li>

                                    <li class="list-group-item" style="font-size: 1.135rem;">
                                       <i class="fas fa-hotel"></i><a href="" class="nav-link"> {{$package->hotel->name}} </a>
                                    </li>

                                     <li class="list-group-item" style="font-size: 1.135rem;">
                                       <i class="fas fa-car"></i><a href="" class="nav-link"> {{$package->car->name}} </a>
                                    </li>


                                    <li class="list-group-item" style="font-size: 1.135rem;">
                                       <i class="fas fa-check"></i> Reserve Now,Pay Later
                                    </li>

                                    <li class="list-group-item" style="font-size: 1.135rem;">
                                        <div class="row">
                                            <div class="col-md-1 mx-0">
                                                 <i class="fas fa-toolbox "></i>
                                            </div>
                                            <p class="col-md-10 mx-0">
                                                {{$package->desc}}
                                            </p>
                                        </div>
                                        
                                    </li>
                                   
                                </ul>

                </div>
                @php
                $s=0;
                $photo = [];
                foreach($package->tours as $p_tour){
                    $photos=json_decode($p_tour->photo,true);
                    foreach($photos as $p){
                        array_push($photo,$p);
                    }
                }
                
                
                @endphp
                <div class="col-md-7">
                   <div class="card">
                       <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                          <div class="carousel-inner">
                            @foreach($photo as $k=>$p)
                            <div class="carousel-item {{($s==$k) ? 'active':''}}">
                              <img src="{{asset("storage/$p")}}" class="d-block w-100" alt="...">
                            </div>
                            @endforeach
                          </div>
                        </div>

                   </div>
                   <h4 class="description mt-3 ">Package Option</h4>
                   <div class="card mt-2">
                       
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-0"></h4>
                                    <span class=" small mb-2 text-muted">{{$package->days}} days Package</span>

                                    <span class=" small mb-2 text-dark ">{{$package->priceperperson}}$  for one traveller.


                                    <span class=" small mb-2 text-dark "> Total ( {{$package->ppl}} ) Travellers</span><br/>
                                     
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


            <div class="row">
                 <h3 class="my-3">Tour Directions</h3>
                                

                    {{-- tour --}}
                    <div class="accordion accordionExample" >
                        
                        @foreach($package->tours as $key=>$data)
                          <div class="accordion-item my-2 shadow">

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

                                    <div class="col-md-6 img_fix sticky-top ">

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
        @include('layouts.foot')
@endsection
@section('script')
<script>
    
</script>
@endsection