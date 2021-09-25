@extends('frontendnew')
@section('main-content')
 
@php 
$hotels=$all_hotels;
@endphp
@if(!empty($resulthotels))
@php $hotels=$resulthotels;@endphp
@endif

<x-searchingnew  />

<div class="container mt-4">
    <div class="row">
        <x-fliter-component></x-fliter-component>
        <div class="col-md-8 my-div">
             <form action="{{route('rooms.hotelid')}}" id="hotelselected" method="post">
                @csrf
                <input type="hidden" name="h_id" value="">
                <input type="hidden" name="s_date" value="">
                <input type="hidden" name="e_date" value="">
                <input type="hidden" name="drop_id" value="">
                <input type="submit" class="d-none">
            </form>
            <div id="php-data">
                @foreach($hotels as  $hotel)
                <div class="card mb-3" >
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{asset('storage/'.$hotel->logo)}}"   class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title d-inline-block">{{$hotel->name}}</h5>
                                    <p class="rating d-inline ">
                                        <i class="fas fa-star-half-alt"></i>
                                        @php
                                        $rating = 0;
                                        foreach($hotel->rating as $data){
                                        $rating += $data->rate;
                                        }

                                        @endphp
                                        {{$rating}}
                                        Stars
                                    </p>
                                    <ul class="pl-0">
                                        <div class="@if(Auth::check()) rating-input @else rating_login @endif" data-hotel_id="{{$hotel->id}}" data-type_id="1">

                                            <span class="starone ">
                                                <i class="fas fa-star star_one star_blank 
                                                @foreach($hotel->rating as $rate)
                                                    @if($rate->user_id == Auth::id())
                                                        @if($rate->rate >= 1)
                                                            star_color
                                                        @endif
                                                    @endif
                                                @endforeach" data-value="1" title="One Star"></i>
                                            </span>

                                            <span class="startow" title="Two Star"><i class="fas fa-star star_two star_blank
                                                @foreach($hotel->rating as $rate)
                                                    @if($rate->user_id == Auth::id())
                                                        @if($rate->rate >= 2)
                                                            star_color
                                                        @endif
                                                    @endif
                                                @endforeach" data-value="2"></i></span>

                                            <span class="starthree" title="Three Star"><i class="fas fa-star star_three star_blank
                                                @foreach($hotel->rating as $rate)
                                                    @if($rate->user_id == Auth::id())
                                                        @if($rate->rate >= 3)
                                                            star_color
                                                        @endif
                                                    @endif
                                                @endforeach" data-value="3"></i></span>

                                            <span class="starfour" title="Four Star"><i class="fas fa-star star_four star_blank
                                                @foreach($hotel->rating as $rate)
                                                    @if($rate->user_id == Auth::id())
                                                        @if($rate->rate >= 4)
                                                            star_color
                                                        @endif
                                                    @endif
                                                @endforeach" data-value="4"></i></span>

                                            <span class="starfive" title="Five Star"><i class="fas fa-star star_five star_blank
                                                @foreach($hotel->rating as $rate)
                                                    @if($rate->user_id == Auth::id())
                                                        @if($rate->rate == 5)
                                                            star_color
                                                        @endif
                                                    @endif
                                                @endforeach" data-value="5"></i></span>

                                            <br>
                                            {{-- <p class="bg-success text-white d-inline-block px-1 py-1 mt-1 star_text"></p> --}}
                                        </div>
                                    </ul>
                                </div>
                                
                                <p class="card-text">
                                    <i class="fas fa-location-arrow"></i>{{$hotel->addresss}},{{$hotel->city->name}}
                                </p>
                                <p class="card-text">
                                    <button class="btn btn-secondary btn-php-view-more" data-id="{{$hotel->id}}" >ViewMore</button>
                
                                </p>
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

    

  $('.btn-php-view-more').click(function() {

   let h_id = $(this).data('id');
   $('input[name="h_id"]').val(h_id);
   //let hotel_id=$('#hotel_d_city_id').val();

    if(sessionStorage.length >0){
            let hotel_city_id=sessionStorage.getItem('hotel_d_city_id')
        let hotel_checkout=sessionStorage.getItem('hotel_check_out')
        let hotel_checkin=sessionStorage.getItem('hotel_check_in')

        

             if(hotel_checkin && hotel_checkout && hotel_city_id){

                  $('#hotelselected input[name="drop_id"]').val(getSavedValue('hotel_d_city_id'));
                    $('#hotelselected input[name="s_date"]').val(getSavedValue('hotel_check_in'));
                    $('#hotelselected input[name="e_date"]').val(getSavedValue('hotel_check_out'));

                    localStorage.clear();
                    mycart(hotel_city_id, hotel_checkin, hotel_checkout, "mycounting");
                    $('#hotelselected').submit();
            }else{
                 Swal.fire({title:'Please fill Pickup locations and start Date and Due Date',icon:'warning'});
            }

        
    }else{
        Swal.fire({title:'Please fill Pickup locations and start Date and Due Date',icon:'warning'});
    }
    

  
  })

  $('.my-div').on('click','.btn-view',function(){
    
      let h_id = $(this).data('id');
      $('input[name="h_id"]').val(h_id);

       

        if(sessionStorage.length >0){
            console.log('may be');
             let hotel_city_id=sessionStorage.getItem('hotel_d_city_id')
            let hotel_checkout=sessionStorage.getItem('hotel_check_out')
            let hotel_checkin=sessionStorage.getItem('hotel_check_in')
        
            if(hotel_checkin && hotel_checkout && hotel_city_id){

                  $('#hotelselected input[name="drop_id"]').val(getSavedValue('hotel_d_city_id'));
                    $('#hotelselected input[name="s_date"]').val(getSavedValue('hotel_check_in'));
                    $('#hotelselected input[name="e_date"]').val(getSavedValue('hotel_check_out'));

                    localStorage.clear();
                    mycart(hotel_city_id, hotel_checkin, hotel_checkout, "mycounting");
                    $('#hotelselected').submit();
            }else{
                alert('fill data mary in search');
            }
                  

            
        }else{
            alert('fill data mary in search');
        }


  
  })



 })

</script>
@endpush