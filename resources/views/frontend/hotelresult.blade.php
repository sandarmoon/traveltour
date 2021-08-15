@extends('frontendTemplate')
@section('main')
<!-- Header-->
        <header class=" py-2 banner ">
            <div class="container px-4 px-lg-5 my-5  ">
               
                <!-- <div class="text-center ">
                    <h1 class="display-4 fw-bolder">Plan  Your Adventure  Here!</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Take only memories, leave only footprints</p>
                    <button class="btn btn-warning"> Start Now!</button>
                </div> -->
                <x-searching :cities="$cities" left=700 ></x-searching>

            </div>
        </header>
        <div class="col-md-10 offset-1 p-3 ">
            
            <div class="row">
                @foreach($hotels as $h)
                    <div class="col-md-6">
                        <div class="card h-100" data-id="{{$h->id}}">
                          <div class="row g-0">
                            <div class="col-md-4 ">
                              <img src="{{asset('storage/'.$h->logo)}}"   class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                              <div class="card-body">
                                <h5 class="card-title mb-0">{{$h->name}}</h5>
                                <span class="text-muted">{{$h->city->name}}</span>
                                <p class="card-text " style="font-size:0.752rem;">
                                    {{substr($h->info, 0, 200)}}."..."
                                  
                                </p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p><i class="fas fa-wifi"></i> Wifi Included</p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    </div>
                                    <div>
                                        <p class="mt-4">{{$h->room->pricepernight}}$</p>
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