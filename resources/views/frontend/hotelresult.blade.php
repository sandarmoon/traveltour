@extends('frontendnew')
@section('main-content')
<!-- Header-->
<x-searchingnew :cities="$cities" :packages="$packages" />

<div class="col-md-10 offset-1 p-3 ">
 {{-- <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> --}}
 <form action="{{route('rooms.hotelid')}}" method="post">
  @csrf
  <input type="hidden" name="h_id" value="">
  <input type="hidden" name="s_date" value="{{$s_date}}">
  <input type="hidden" name="e_date" value="{{$e_date}}">
  <input type="hidden" name="drop_id" value="{{$drop->id}}">
  <input type="hidden" name="search" value="{{$search}}">
  <input type="hidden" name="c_type" value="{{$common_type}}">
  <input type="submit" class="d-none">
 </form>
 <div class="row">
  @foreach($hotels as $h)
  <div class="col-md-6">
   <div class="card h-100" data-id="{{$h->id}}">
    <div class="row g-0">
     <div class="col-md-4 ">
      <img src="{{asset('storage/'.$h->logo)}}" class="img-fluid rounded-start" alt="...">
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
@include('layouts.foot')
@endsection
@push('script')
<script>
 $(document).ready(function() {
  $('.card').click(function() {

   let h_id = $(this).data('id');
   $('input[name="h_id"]').val(h_id);
   $('form').submit();
  })



 })

</script>
@endpush
