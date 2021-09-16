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
                     
                        <h5 class="text-dark">{{$package->days}}Days  Package</h5>
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
                   
                    <!-- start here  -->
                    <div class="card border-warning col-md-8 mt-4  mx-auto">
                        <div class="card-header bg-secondary ">
                            <h5 class="mb-0 text-white">Check price & book now</h5>
                        </div>
                        <div class="card-body">
                            <div class="  mb-3 row">
                                <label for="staticEmail" class="col-sm-5 col-form-label text-dark"> travelers</label>
                                <div class="col">
                                <select class="form-select" id="num-travelers" aria-label="Default select example">
                                <option value="1" selected>One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                                <option value="4">Four</option>
                                <option value="5">Five</option>
                                <option value="6">Six</option>
                                <option value="7">Seven</option>
                                <option value="8">Eight</option>
                                <option value="9">Nine</option>
                                <option value="10">Ten</option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="px-4" id="estimate-data">
                            <table class="table">
                                <tr>
                                    <td>Package<br>
                                        <span class="small">per person</span>
                                     </td>
                                    <td>${{$package->priceperperson}}</td>
                                </tr>
                                <tr>
                                    <td>total for <span class="text-danger result-ppl">3</span> </td>
                                    <td class="total-price">$300</td>
                                </tr>
                            </table>
                            <span class="text-danger " id="booking-warning"></span>
                        </div>
                        <div class="mx-auto">
                            @if(Auth::check())
                        <button  data-id="{{$package->id}}" class="package-booking-btn btn btn-secondary  m-3">book Now!</button>
                        @else 
                        <a href="/login" class=" btn btn-secondary m-3">book Now!</a>
                        @endif
                        </div>
                    </div>
                    <!-- end here  -->
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
@push('script')
<script>
    const price="{{$package->priceperperson}}";
    $(document).ready(function(){
        $('#num-travelers').change(function(){
            let num=$(this).val();
            let total=price * num;
            $('.result-ppl').html(num);
            $('.total-price').html('$'+total);
            if(num > 4){
                $('#estimate-data table').addClass('d-none');
                $('#booking-warning').html('Please give us a call first before booking!');
            }else{
                $('#estimate-data table').removeClass('d-none');
                $('#booking-warning').html('');
            }
            
        })
        $('.package-booking-btn').click(function(){
           let id=$(this).data('id');
           console.log(id);
            let ppl=$('#num-travelers').val();
            window.location.href="/p/booking/"+id+"/"+ppl;
        })


          

            
    })
</script>
@endpush