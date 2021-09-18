@extends('frontendnew')
@section('main-content')
<!-- Header-->
<section class="   ">
    <div class="container px-4 px-lg-5 my-3  ">

       <h4>Guest Detail!</h4>
       @php
       $photos=json_decode($room->photos,true);
       
       @endphp
       <div class=" row">
        <div class="col-md-8">
             <!-- getting contact here -->
             <div class="card">
                 <div class="card-body contact-div">
                     <h5 class="card-title">Contact Info</h5>
                     <div class="row ">
                         <div class="col">
                            <div class="form-group">
                              
                              <input type="text" name="username" id="name" class="form-control" value="{{(Auth::check() ? Auth::user()->name: '')}}" placeholder="Name *" >
                              <!-- <small id="helpId" class="text-muted">Help text</small> -->
                            </div>
                         </div>
                        <div class="col">
                            <div class="form-group">
                        
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone *">
                                <!-- <small id="helpId" class="text-muted">Help text</small> -->
                            </div>
                        </div>
                     </div>

                    <div class="row">
                        <div class="col">
                            
                    
                            <div class="form-group">
                                
                                <input type="text" name="address" id="address" class="form-control" placeholder="address *">
                            </div>
                                <!-- <small id="helpId" class="text-muted">Help text</small> -->
                            
                        </div>
                        
                        
                    </div>

                    <div class="py-4">
                        <h6 class="ct-lead">Account for Managment your bookings </h6>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <span id="result"></span>
                                    <input type="email" name="email" id="email"  class="form-control"  value="{{(Auth::check() ? Auth::user()->email: '')}}" placeholder="Email Address *"
                                        aria-describedby="email">
                                        @if(!Auth::check())
                                         <small  class="text-muted">This  is the email we will send your  confirmation to.</small>
                                        @endif
                                   
                                </div>
                            </div>
                        </div>

                    
                        <input type="hidden" name="user_id" value="{{(Auth::check() ? Auth::user()->id : '')}}">
                           
                       
                    </div>
                    
                    <div class="row">
                        <h5 class=""  aria-describedby="helpId">Additional Details and Perferences</h5>
                        <small id="helpId" class="text-muted">(e.g. roll-away beds, late check-in, and accessible rooms) are not guaranteed. If you don't hear back from the property,
                        you may want to contact them directly to confirm. The property may charge a fee for certain special requests.</small>
                        <div class="form-group">
                            
                            <textarea id="msg" class="form-control" name="msg" rows="3"></textarea>
                        </div>
                    </div>

                 </div>
             </div>
             <!-- end here -->
        </div>
        <div class="col-md-4">
            <div class="card px-3 py-4  pre-room-booking" >
               <h3 class="br-title">Your Stay</h3>

               <!-- checkin and checkout -->
                <div class="row mt-2 p-2 ">
                    <div class="col">
                        <strong><p class="mb-0">Check-in</p></strong>                        After 12:00 PM
                    </div>

                    <div class="col">
                        <strong><p class="mb-0">Check-out</p></strong>
                        Before 12:00 PM
                    </div>
                </div>
                <hr class="my-3">
                <p class="b-date mb-0"></p>
                <span class="ppl-total">2 Adults</span>

                <table class="table  mt-3">
                    <tr> 
                        <td>
                            <p class="mb-0 ct-lead">Deluxe Tent</p>
                            <span style="font-size: 0.725rem;">No Refund</span>
                        </td>
                        <td>${{$room->pricepernight}}</td>
                    </tr>

                    <tr>
                        <td>
                            <p><strong class="night-count"></strong> Night(s)</p>
                            
                        </td>
                        <td class="sub-total"></td>
                    </tr>

                    <tr>
                        <td>
                            <p>Tax and Fees</p>
                            
                        </td>
                        <td>$10.00</td>
                    </tr>

                    <tr>
                        <td>
                            <h4>Total</h4>
                            
                        </td>
                        <td class="total-cost">$390.00</td>
                    </tr>
                
                
                
                </table>
                
                @if(Auth::check())
                <button class="btn btn-secondary btn-hotel-checkout">Book Now!</button>
                @else
                <a href="{{route('login')}}" class="btn btn-success ">SignIn/SignUp to Book!</a>
                @endif
            </div>
        </div>
       </div>

    </div>
</serction>
<div class="col-md-10 offset-1 p-3 ">
    
    <div class="row">
       
    </div>

</div>
<!-- Section for card-->
@include('layouts.foot')
@endsection
@push('script')
<script>
    var roomid="{{$room->id}}";
    var price="{{$room->pricepernight}}";
    var taxfee=10;
    $(document).ready(function () {

        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

        getData();
        

        $('input[name="email"]').on('input',validate); 
       
        $('.btn-hotel-checkout').click(function(){
            let username= $('input[name="username"]').val();
            let phone= $('input[name="phone"]').val();
            let address= $('input[name="address"]').val();
            let user_id= $('input[name="user_id"]').val();
            let email= $('input[name="email"]').val();
            let password= $('input[name="password"]').val();
            let msg= $('textarea[name="msg"]').val();

            let cart=localStorage.getItem('mycounting');
             let cartObj=JSON.parse(cart);

            let check_in=new Date(cartObj.start);
             check_in=check_in.toLocaleDateString();

             let check_out=new Date(cartObj.end);
             check_out=check_out.toLocaleDateString();

             let days=$('.night-count').html();
             
             let room=cartObj.r[0];

            let adult=room.adult;
            let child=room.child;
            
            let formdata={
                'name':username,
                'phone':phone,
                'address':address,
                'user_id':user_id,
                'email':email,
                'password':password,
                'msg':msg,
                'days':days,
                'adult':adult,
                'child':child,
                'check_in':check_in,
                'check_out':check_out,
                'room_id': roomid
                
            }
            $.ajax({
                url:"{{route('hotel.booking.checkout')}}",
                type:"POST",
                data:formdata,
                beforeSend: function() {
                    swal.fire({
                        
                        html: '<h5>Loading...</h5>',
                        showConfirmButton: false,
                        allowOutsideClick:false,
                       
                    });
                },
                success:function(res){

                    
                   if(res.success){
                       swal.fire({
                        
                                title:'Your message is send',
                                text:'Thank you so much',
                                type:'success',
                                showConfirmButton: true,
                            
                            }).then(()=>{
                                let len = cartObj.r.length;
                                    console.log(len);
                                    if(len === 1){
                                        console.log('he');
                                        cartObj.r[0]={
                                            'rno': 1,
                                            'r_id': 0,
                                            'child': 0,
                                            'adult': 1,
                                            'total': 0
                                        };
                                    }else{
                                    console.log('ye')
                                    cartObj.r.splice(0,1);
                                }

                                localStorage.setItem('mycounting',JSON.stringify(cartObj));
                                 window.location.href="{{route('bookinghistory')}}";

                            });
                      

                    
                }},
                error:function(err){
                    console.log(err);
                }
            })
            
        })

        

    })

    function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
    }

    function validate() {
    const $result = $("#result");
    const email = $("#email").val();
    $result.text("");

    if (!validateEmail(email)) {
        
        $result.text( " Email is invalid :(");
        $result.css("color", "red");
    }else{
        $.ajax({
            url:"{{route('hotel.booking.validation')}}",
            type:"POST",
            data:{'email':email},
            success:function(res){
                console.log(res);
            },
            error:function(err){
                let err_email=err.responseJSON.errors.email;
                $result.text( err_email);
                $result.css("color", "red");
            }
        })
    }
    return false;
    }
    
    function getData(){
           let cart=localStorage.getItem('mycounting');
           let cartObj=JSON.parse(cart);

           let check_in=cartObj.start;
           let check_out=cartObj.end;

            check_in=gettime(check_in);
            check_out=gettime(check_out);

            let diff=(check_out - check_in)/(1000 * 3600 * 24);
                diff=Math.max(1,diff);
            let check_in_date=getDateString(check_in);
            // console.log(check_in_date);

            let check_out_date=getDateString(check_out);
            // console.log(check_out_date);

            $('.b-date').html(`${check_in_date} - ${check_out_date}`);

            //ppl count
            let ppl='';

            let room=cartObj.r[0];

            ppl=`${room.adult} Adult(s)  ${(room.child != 0) ? '/'+ room.child +'Child': ''}`;

            $('.ppl-total').html(ppl);

            $('.night-count').html(diff);

            let subtotal=(price * diff);
            $('.sub-total').html(`$${subtotal}`);

            let total = subtotal + taxfee;
            
            $('.total-cost').html(`$${total}`);
            
          
           

       }

       function gettime(date){
           let data=new Date(date);
             data=data.toLocaleDateString();
            data=new Date(data);
            data.setHours(data.getHours()+12);
            return data.getTime();
            
       }

       function getDateString(date){
           let data=new Date(date);
           return data.toDateString();
       }
</script>
@endpush