@extends('backendTemplate')
@section('main-content')
 <div class="header bg-gradient-primary pb-7 pt-4 pt-md-7">
  <div class="container-fluid">
    <div class="my-ct-page-title text-white">
      <h1 class="ct-title text-white d-inline-block" id="content">
        New Hotel Room Adding 
      </h1>
      <a class="ct-example text-white float-right border-0" href="{{route('car.index')}}">
        <i class="ni ni-bold-left"></i>
            <span class="error-name">Go Back</span>
      </a>
      
    </div>
    
  </div>
</div>
<div class="container-fluid mt--7">
  <div class="shadow">

     
     <div class="bg-white  pb-3"> {{-- start here --}}
        <div class="row px-2">
            <div id="carouselExampleControls" class="col-sm-5 carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner" style="min-height: 400px;">
                <div class="carousel-item active">
                  <img src="{{asset('assets/img/theme/angular.jpg')}}" class="img-fluid d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{asset('assets/img/theme/profile-cover.jpg')}}" class="img-fluid d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{asset('assets/img/theme/react.jpg')}}" class="img-fluid d-block w-100" alt="...">
                </div>
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
           {{-- end here --}}
               
    

           <div class="col-sm-7">
              <div class="card">
                    <h4 class="ct-title text-center">Creating New Room</h4>
                    {{-- start form here --}}
                @if($room->exists)
                    <form class="flex flex-col w-full" method="POST" enctype="multipart/form-data" action="{{ route('room.update',$room) }}">
                        @method('put')
                @else
                    <form class="flex flex-col w-full" method="POST" enctype="multipart/form-data" action="{{ route('room.store') }}">
                @endif
                    @csrf
                        <div class="px-3">

                            <h5>General Information</h5>
                              <div class="mb-4 row">
                                <label for="name" class="col-sm-4 col-form-label">Name:</label>
                                <div class="col-sm-8">
                                  <input type="text"  class="form-control" id="name" name="name" value="{{old('name',$room->name)}}">
                                </div>
                              </div>

                              @if($room->exists)
                    <input type="hidden" name="oldphoto" value="{{old('oldphoto',$room->photos)}}">
                              @endif

                              <div class="mb-4 row">
                                <label for="galary" class="col-sm-4 col-form-label">Upload Galary:</label>
                                <div class="col-sm-8">
                                  <input type="file" class="form-control" multiple name="galary[]" id="galary">
                                </div>
                              </div>

                              <div class="mb-4 row">
                                <label for="type" class="col-sm-4 col-form-label">Type:</label>
                                <div class="col-sm-8">
                                  <select class="form-select" id="type" name="type_id" aria-label="Default select example">
                                      <option value="">Open this select menu</option>
                                      @foreach($types as $t)
                                      <option value="{{$t->id}}"
                                        @if($room->type_id ==$t->id)
                                        selected="selected" 
                                        @endif
                                        >{{$t->name}}</option>
                                      @endforeach
                                   </select>
                                </div>
                              </div>

                              <div class="mb-4 row">
                                <label for="people" class="col-sm-4 col-form-label">People(sleep):</label>
                                <div class="col-sm-8">
                                   <input type="text" class="form-control" name="people" value="{{old('people',$room->ppl)}}" id="people">
                                </div>
                              </div>

                              <div class="mb-2 row">
                                <label for="price" class="col-sm-4 col-form-label">Price Per Night:</label>
                                <div class="col-sm-8">
                                   <input type="number" class="form-control" name="price" value="{{old('price',$room->pricepernight)}}" id="price">
                                </div>
                              </div>

                              <div class="mb-2 row">
                                <label for="wide" class="col-sm-4 col-form-label">Room Space(ft):</label>
                                <div class="col-sm-8">
                                   <input type="number" class="form-control" name="wide" id="wide" value="{{old('wide',$room->wide)}}">
                                </div>
                              </div>

                              <div class="mb-2 row">
                                <label for="common" class="col-sm-4 col-form-label">Starting from:</label>
                                <div class="col-sm-8">
                                   <select class="form-select" id="type" name="common" aria-label="Default select example">
                                      <option value="" >Open this select menu</option>
                                      <option value="1" {{($room->common == 1) ? 'selected':''}}>2 Travellers,1 Room</option>
                                      <option value="2" {{($room->common == 2) ? 'selected':''}}>3 Travellers,1 Room</option>
                                   </select>
                                </div>
                              </div>
                            

                              

                        </div>

                    
                    {{-- end form here --}}
              </div>
           </div>           
        </div>

        <h4 class="ml-5">Room Service and Facilites</h4>
        <div class="col-md-10 offset-1">
            <h5 class="description ">Bed Service</h5>
            <div class="d-flex">
               <div class="col form-group">
                    <label for="single">Single Size</label>
                    <input type="number" class="form-control" name="single" value="{{old('single',$room->single)}}"  id="single">
                </div>

                <div class="col form-group">
                    <label for="double">Double Size </label>
                    <input type="number" class="form-control" name="double" value="{{old('double',$room->double)}}"  id="double">
                </div>

                <div class="col form-group">
                    <label for="king">King Size</label>
                    <input type="number" class="form-control"  name="king" value="{{old('king',$room->king)}}"  id="king">
                </div>

                <div class="col form-group">
                    <label for="queen">Queen Size</label>
                    <input type="number" class="form-control"  name="queen" value="{{old('queen',$room->queen)}}"  id="queen">
                </div>

            </div>

            <h5 class="description ">Room Service</h5>
            Choose More Service 

            @foreach($facilities as $k=>$v)
                <div class="col form-group">
                    <label for="queen">{{$k}}</label>
                    <select class="js-example-basic-multiple  form-control" name="facilities[]" multiple="multiple">
                         @foreach($v as $i)
                            
                         <option value="{{$i['id']}}"
                         @foreach($room->facilities as $facility)


                          @if($facility->id == $i['id'])
                          selected="selected" 
                          @endif
                          @endforeach
                          >{{$i['name']}}</option>
                         
                         @endforeach
                    </select>
                </div>
            @endforeach

            <div>
                <button type="submit" class="btn btn-primary form-control">Submit Now!</button>
            </div>
        </div>

        </form>
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