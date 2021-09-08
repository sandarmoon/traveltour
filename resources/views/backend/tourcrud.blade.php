@extends('backendTemplate')
@section('main-content')


 <div class="header bg-gradient-primary pb-7 pt-4 pt-md-7">
  <div class="container-fluid">
    <div class="my-ct-page-title text-white">
      <h1 class="ct-title text-white d-inline-block" id="content">
        New Tour Adding 
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
        <div class="row px-2">
            
            <div class="col-sm-10 mx-auto">
              <div class="card">
                    
                @if($tour->exists)
                    <form class="flex flex-col w-full" method="POST" enctype="multipart/form-data" action="{{ route('tour.update',$tour->id) }}">
                        @method('put')
                @else
                    <form class="flex flex-col w-full" method="POST" enctype="multipart/form-data" action="{{ route('tour.store') }}">
                @endif
                    @csrf
                    <div class="px-3">
                        <div class="row form-group my-4">
                            <label class="form-control-label col-md-2 mx-auto" id="title">Name</label>

                            <div class="col-md-10 mx-auto">
                                <input type="text" name="title" class="form-control" id="title" value="{{old('title',$tour->title)}}" placeholder="Title">
                                @error('title')
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="row form-group my-4">
                            <label class="form-control-label col-md-2 mx-auto" id="title">City</label>
                            <div class="col-md-10 mx-auto">
                                <select class="form-select" name="city">
                                    <option>Select One</option>
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}" @if($city->id == $tour->city_id) selected="selected" @endif>{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>


                        <div class="row form-group my-4">
                            <label class="form-control-label col-md-2 mx-auto" id="photo">Photo</label>
                            <div class="col-md-10 mx-auto">

                               
                                

                                @if($tour->exists)
                                <input type="hidden" name="oldphoto" value="{{$tour->photo}}">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                      <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Old photo</button>
                                      </li>
                                      <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">New Photo</button>
                                      </li>
                                      
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                          @php
                                            $photo = json_decode($tour->photo);
                                          @endphp
                                          @foreach($photo as $p)
                                            <img src="{{asset('/storage/'.$p)}}" width="18%" class="mx-1 my-3" height="20%">
                                          @endforeach
                                      </div>
                                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                          <input type="file" name="photo[]" class="form-control-file mt-2" id="photo" multiple="multiple">
                                            @error('photo')
                                            <span class="text-danger">{{ $errors->first('photo') }}</span>
                                            @endif
                                      </div>
                                      
                                    </div>
                                @else

                                 <input type="file" name="photo[]" class="form-control-file" id="photo" multiple="multiple">
                                @error('photo')
                                <span class="text-danger">{{ $errors->first('photo') }}</span>

                                @endif
                            @enderror
                            </div>
                           
                            
                        </div>


                        <div class="row form-group my-4">
                            <label class="form-control-label col-md-2 mx-auto" id="title">Description</label>
                            <div class="col-md-10 mx-auto">
                                <textarea class="summernote_tour" name="description">{{old('description')}} @if($tour->exists) {!! $tour->desc !!} @endif</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="row form-group my-4">
                            <div class="col-md-10 mx-auto">
                            <button class="btn btn-block btn-primary">Add Now</button>
                                
                            </div>
                        </div>
                    </div>

                    </form>

                    
                    {{-- end form here --}}
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