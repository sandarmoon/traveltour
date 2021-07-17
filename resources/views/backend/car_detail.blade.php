@extends('backendTemplate')
@section('main-content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-7">
      <div class="container-fluid">
        <div class="my-ct-page-title text-white">
          <h1 class="ct-title text-white d-inline-block" id="content">
            Code No : {{$car->codeno}}
          </h1>
          @if ($message = Session::get('success'))
              <div class="alert alert-success">
                  <p>{{ $message }}</p>
              </div>
          @endif
          <a class="ct-example text-white float-right border-0" href="{{route('car.index')}}">
            <i class="ni ni-bold-left"></i>
                <span class="error-name">Back</span>
          </a>
          
        </div>
        
      </div>
    </div>
    <div class="container-fluid mt--8">
      <div class="my-card">
        <div class="card-body p-0">
        	<x-car-detail-component :car="$car" />
        </div>
       </div>
      </div>

@endsection