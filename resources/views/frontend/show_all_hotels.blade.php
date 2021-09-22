@extends('frontendnew')
@section('main-content')
 
@php 
$hotels=$all_hotels;
@endphp
@if(!empty($resulthotels))
@php $hotels=$resulthotels;@endphp
@endif

<x-searchingnew  />
<div class="container">
 <div class="row">
  <x-fliter-component></x-fliter-component>
   <div class="col-md-8">
    @if(!empty($resulthotels))
    <form action="{{route('rooms.hotelid')}}" method="post">
     @csrf
     <input type="hidden" name="h_id" value="">
     <input type="hidden" name="s_date" value="{{$s_date ? $s_date : ''}}">
     <input type="hidden" name="e_date" value="{{$e_date ? $e_date : ''}}">
     <input type="hidden" name="drop_id" value="{{$drop->id ? $drop->id : ''}}">
     <input type="hidden" name="search" value="{{$search ? $search : ''}}">
     <input type="hidden" name="c_type" value="{{$common_type ? $common_type : ''}}">
     <input type="submit" class="d-none">
    </form>
    @else
    <form action="{{route('rooms.hotelid')}}" method="post">
     @csrf
     <input type="hidden" name="h_id" value="">
     <input type="hidden"  name="s_date" value="">
     <input type="hidden" name="e_date" value="">
     <input type="hidden" name="drop_id" value="">
     <input type="hidden" name="search" value="">
     <input type="hidden" name="c_type" value="">
     <input type="submit" class="d-none">
    </form>
    @endif
    <div class="row" id="filter-data-ajax">
     @foreach($hotels as  $hotel)
      <div class="col-md-12">
        <div class="card mb-3" data-id="{{$hotel->id}}">
         <div class="row g-0">
         
           <div class="col-md-4">
             <img src="{{asset('storage/'.$hotel->logo)}}" class="img-fluid rounded-start" alt="...">
           </div>
           <div class="col-md-8">
             <div class="card-body">
               <h5 class="card-title">{{$hotel->name}}</h5>
               <span class="text-muted">{{$hotel->addresss}}</span>
               <p class="card-text">
               {{substr($hotel->info, 0, 200)}}."..."
               </p>
               <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
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
@endsection
@push('script')
<script>
 $(document).ready(function() {
  $('.card').click(function() {

   let h_id = $(this).data('id');
   $('input[name="h_id"]').val(h_id);
   let hotel_id=$('#hotel_d_city_id').val();

   if(hotel_id == undefined){
    alert('please enter data first');
   }else{
     
   let city = $('#hotel-search-div select[name="d_city_id"]').val();
   let check_in = $(
    '#hotel-search-div input[name="start_date"]'
   ).val();
   let check_out = $('#hotel-search-div input[name="end_date"]').val();
   localStorage.clear();
   mycart(city, check_in, check_out, "mycounting");

   
      $('form').submit();
   }

  
  })

  $('#filter-data-ajax').on('click','.card',function(){
    
      let h_id = $(this).data('id');
      $('input[name="h_id"]').val(h_id);
      let hotel_id=$('#hotel_d_city_id').val();

      if(hotel_id == undefined){
        alert('please enter data first');
      }else{
        
      let city = $('#hotel-search-div select[name="d_city_id"]').val();
      let check_in = $(
        '#hotel-search-div input[name="start_date"]'
      ).val();
      let check_out = $('#hotel-search-div input[name="end_date"]').val();
      localStorage.clear();
      mycart(city, check_in, check_out, "mycounting");

      
          $('form').submit();
      }
  })



 })

</script>
@endpush