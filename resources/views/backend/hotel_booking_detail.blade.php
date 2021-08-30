@extends('backendTemplate')
@section('main-content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-7">
      <div class="container-fluid">
        <div class="my-ct-page-title text-white">
          <h1 class="ct-title text-white d-inline-block" id="content">
            Code No : {{$booking->booking_code}}
          </h1>
          @if ($message = Session::get('success'))
              <div class="alert alert-success">
                  <p>{{ $message }}</p>
              </div>
          @endif
          <a class="ct-example text-white float-right border-0" href="{{URL::previous()}}">
            <i class="ni ni-bold-left"></i>
                <span class="error-name">Back</span>
          </a>
          
        </div>
        
      </div>
    </div>
    <div class="container-fluid mt--8">
      <div class="my-card">
        <div class="card-body p-0">
        	<div class="row">
           <div class="col-sm-6 order-2">
             <div class="card">
               <div class="card-header"> 
                Payment Detail
               </div>
               <div class="card-body">
                 <div>
                   <table class="table  table-hover dt-responsive">
                     
                     <tr>
                       <td class="p-2">Price</td>
                       <td>{{$booking->room->pricepernight}}</td>
                     </tr>
                     <td class="p-2">Discount</td>
                       <td>-</td>
                     </tr>
                     <tr>
                       <td class="p-2">Day</td>
                       <td>2</td>
                     </tr>
                     <tr>
                       <td class="p-2">Subtotal</td>
                       <td>
                         @php
                         $days=$booking->days;
                         
                         $price=$booking->room->pricepernight;
                         $total=0;
                         
                          $total=$price * $days + 10;
                        
                         echo $total.'$';
                         @endphp
                       </td>
                     </tr>
                     <tr>
                       <td class="p-2">Tax(5%)</td>
                       <td> 
                        @php

                          $a = 5/100;
                          $b = round($a*$total);
                           $percent=0;
                          if (($b != "") && ($a != "")){
                             $percent = $b;
                              } else {
                              $percent = 0;
                              }
                          
                          echo $percent.'$';
                         @endphp

                       </td>
                     </tr>
                     <tr>
                       <td class="p-2">total</td>
                       <td>@php
                             $total=$total+$percent;
                             echo $total."$";
                           @endphp
                      </td>
                     </tr>
                      <tr>
                       <td class="p-2">Paid</td>
                       <td>0$</td>
                     </tr>
                     
                     

                   </table>

                    <div class="ml-5 my-3">
                      <a href="{{route('bookinglist.confirm',[$booking->id,'2',2])}}" class="btn btn-outline-success  mt-3">Confirm</a>
                      <a href="{{route('bookinglist.confirm',[$booking->id,'3',2])}}" class="btn btn-outline-danger  mt-3">Cancel</a>
                    </div>
                 </div>
               </div>
             </div>
           </div> 
           <div class="col-sm-6 order-1">
              <div class="card">
               <div class="card-header"> 
                Booking Detail 
                @if($booking->status ==1)
                <span class="text-warning float-right">Pending</span>

                @elseif($booking->status==2)
                <span class="text-success float-right">Confirmed</span>

                @else
                <span class="text-danger float-right">Booking Cancel!</span>
                @endif



               </div>
               <div class="card-body">
                  <div>
                   <table class="table  table-hover dt-responsive">
                    <tr>
                       <td class="p-2">Booking Date</td>
                       <td>
                         {{$booking->booking_date}}
                       </td>
                     </tr>
                     <tr>
                       <td class="p-2">Customer</td>
                       <td>{{$booking->user->name}} </td>
                     </tr>
                     <tr>
                       <td class="p-2">Customer's Phone</td>
                       <td>{{$booking->phone}} </td>
                     </tr>
                     
                     <tr>
                       <td class="p-2">Check IN Date</td>
                       <td> 23 6 199s6</td>
                     </tr>
                     <tr>
                       <td class="p-2">Check OUT Date</td>
                       <td>24 6 1996</td>
                     </tr>
                     <tr>
                       <td class="p-2">Stay/Room </td>
                       <td>{{$booking->room->type->name}}, 
			                            {{($booking->room->single ) ? '': $booking->room->single}}
			                            {{($booking->room->double ) ? '': $booking->room->double}}
			                            {{($booking->room->king) ? '': $booking->room->king}}
			                            {{($booking->room->queen) ? '': $booking->room->queen}}
			                             Beds</td>
                     </tr>
                     <tr>
                       <td class="p-2">Hotel Name</td>
                       <td >{{$booking->room->company->name}}</td>
                     </tr>
                     <tr>
                       <td class="p-2">Message from Customer</td>
                       <td >{{$booking->msg}}</td>
                     </tr>
                     
                     
                     

                   </table>
                 </div>
               </div>
             </div>
            
              
           </div> 
          </div>
        </div>
       </div>
      </div>

@endsection
@section('script')
@endsection