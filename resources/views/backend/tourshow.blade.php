@extends('backendTemplate')
@section('main-content')


 <div class="header bg-gradient-primary pb-7 pt-4 pt-md-7">
  <div class="container-fluid">
    <div class="my-ct-page-title text-white">
      <h1 class="ct-title text-white d-inline-block" id="content">
        Tour Detail
      </h1>
      <a class="ct-example text-white float-right border-0" href="{{route('tour.index')}}">
        <i class="ni ni-bold-left"></i>
            <span class="error-name">Go Back</span>
      </a>
      
    </div>
    
  </div>
</div>


<div class="container-fluid mt--7">
  <div class="shadow">

     <div class="bg-white pb-3"> {{-- start here --}}
        <div class="card">
            <div class="card-header shadow">
                 <h2>{{$tour->title}} ( {{$tour->city->name}} )</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                          <div class="carousel-inner">
                            @php
                                $photo = json_decode($tour->photo)
                            @endphp
                            @foreach($photo as $key => $p)
                            <div class="carousel-item @if($key == 0) active @endif">
                              <img src="{{asset('/storage/'.$p)}}" class="d-block w-100" height="400" alt="photo">
                            </div>
                            @endforeach
                            
                          </div>

                          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                          </button>

                          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                          </button>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-9 mx-auto">
                       <h2 class="font-weight-bold">Description</h2>
                       {!! $tour->desc !!}
                    </div>
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