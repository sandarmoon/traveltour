@extends('backendTemplate')
@section('main-content')
                          
 <div class="header bg-gradient-primary pb-7 pt-4 pt-md-7">
  <div class="container-fluid">
    <div class="my-ct-page-title text-white">
      <h1 class="ct-title text-white d-inline-block" id="content">
        Creating New Tour Package
      </h1>
      <a class="ct-example text-white float-right border-0" href="{{route('package.index')}}">
        <i class="ni ni-bold-left"></i>
            <span class="error-name">Go Back</span>
      </a>
      
    </div>
    
  </div>
</div>
<div class="container-fluid mt--7">
  <div class="shadow">

     <div class="  pb-3 row"> {{-- start here --}}
        <div class="col-sm-10 mx-auto">
              
              <div class="card">
                
                <div class="card-body">
      @if($package->exists)
            <form class="flex flex-col w-full" method="POST" enctype="multipart/form-data" action="{{ route('package.update',$package) }}">
                @method('put')
        @else
            <form class="flex flex-col w-full" method="POST" enctype="multipart/form-data" action="{{ route('package.store') }}">
        @endif
            @csrf
                <h6 class="heading-small text-muted mb-4">General information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-name">name</label>
                        <input type="text" id="input-name" class="form-control" placeholder="name" name="name" value="{{old('name',$package->name)}}">
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-people">People</label>
                        <input type="number" id="input-people" class="form-control" placeholder="people"  value="{{old('ppl',$package->ppl)}}"   name="ppl">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-departure_city">Depature City</label>
                        <select class="js-example-basic-multiple  form-control" id="input-departure_city" name="departure"  >
                            @foreach($cities as $i)
                                
                            <option value="{{$i['id']}}"
                             @if($package->depart_id == $i->id)
                              selected 
                             @endif
                              >{{$i['name']}}</option>
                            
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-destination_city">Destination City</label>
                        <select class="js-example-basic-multiple  form-control" id="destination_city_id" name="destination" >
                            @foreach($cities as $i)
                                
                            <option value="{{$i['id']}}"
                            @if($package->arrive_id == $i->id)
                              selected 
                             @endif
                            >{{$i['name']}}</option>
                            
                            @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-departure_date">Depature Date</label>
                        <input type="date" id="input-departure_date" class="form-control"    name="start" value="{{old('start',$package->start)}}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-destination_date">Destination Date</label>
                        <input type="date" id="input-destination_date" class="form-control" name="end" value="{{old('end',$package->end)}}"">
                      </div>
                    </div>
                  </div>
                </div>
                <h6 class="heading-small text-muted mb-4">Transportation and Stay information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-price-per-person">Hotel for stay</label>
                        <select class="js-example-basic-multiple  form-control" id="input-price-per-person" name="hotel" >
                            @foreach($hotels as $h)
                                
                            <option value="{{$h->id}}"
                              @if($package->company_hotel_id == $h->id)
                              selected
                              @endif
                              >{{$h->name}}</option>

                            
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-car">Tranportation</label>
                        <select class="js-example-basic-multiple  form-control" id="input-car" name="car" >
                            @foreach($cars as $c)
                                
                            <option value="{{$c->id}}"
                              @if($package->company_car_id == $c->id)
                              selected
                              @endif>{{$c->name}}</option>
                            
                            @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Payment information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-price-per-person">Price Per Person</label>
                        <input id="input-price-per-person"  type="number" class="form-control" placeholder="" value="{{old('priceperperson',$package->priceperperson)}}" name="priceperperson">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-discount">Discount</label>
                        <input type="text" id="input-discount" class="form-control" name="discount" value="{{old('discount',$package->discount)}}">
                      </div>
                    </div>
                  </div>
                  
                </div>
                <hr class="my-4">
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">Adding Tour places and description </h6>
                
                 
                <div class="pl-lg-4">
                  <div class="row">
                    
                    <div class="col-lg-12">
                      <div class="form-group">
                        <span class="ct-lead bold">
                  Please select Tours places according with ascending Day.
                </span>
                        <label class="form-control-label visually-hidden" for="input-tours">Tours</label>
                        <select name="tours[]" class="js-example-basic-multiple form-control" multiple  id="input-tours">
                          @foreach($tours as $t)
                          <option value="{{$t->id}}"
@foreach($package->tours as $pt)
@if($pt->id == $t->id)
selected
@endif
@endforeach
                            
                            >{{$t->title}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label " for="input-desc">Description for Package</label>
                        <textarea name="desc" id="input-desc" class="form-control" >
                          {{old('dec',$package->desc)}}
                        </textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <input type="submit" value=" @if($package->exists) Update Now! @else Add Now @endif" class="from-control btn btn-success">
                  </div>
              </form>
            </div>
              </div>
           </div> 
          
          
    

    
         
     </div>
  </div>
  <!-- Footer -->
  <x-footer-component/>
  {{-- footer end --}}
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
         $('.js-example-basic-multiple').select2();
    })
</script>
@endsection