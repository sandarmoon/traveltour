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



      {{-- modal start --}}
      <div class="modal fade" id="pickupModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="{{route('pickup.route')}}">
              @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                Choose for Pickup Location in here!
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="carid" value="">
              <select class="js-example-basic-multiple" name="states[]" multiple="multiple" style="width: 100%" >
                @foreach($locations as $l)
                <option value="{{$l->id}}">{{$l->name}},{{$l->parent->name}}</option>
                
                 @endforeach
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="closebtn">Close</button>
              <input type="submit" class="btn btn-primary" value="Save changes">
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection
@section('script')
<script>
  $(document).ready(function(){
    $('.js-example-basic-multiple').select2({
      dropdownParent: $('#pickupModel'),
      width: 'resolve',
      placeholder: 'Pickup Here!',
      allowClear: true,
       
  
     });
    $('.btn-click-pickup').click(function(){
      let id=$(this).data('id');
      $('#pickupModel').modal('show');
      $('#pickupModel input[name="carid"]').val(id);
    })
  })
</script>
@endsection