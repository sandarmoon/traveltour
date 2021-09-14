@extends('frontendnew')
@section('main-content')
@php $s=0;
    $tours=$package->tours;
$photos=[]; 
foreach($tours as $t){ 
    $places=json_decode($t->photo,true); 
foreach($places as $v){
array_push($photos,$v);
}
} 

$len=count($package->tours);
    $lastindex=$len-1;
$places='';
    
    
foreach($package->tours  as $k=>$tours) {
if($k == $lastindex) 
$places.=$tours->title;
else 
$places.=$tours->title.',';
}
@endphp


    <section class=" py-3">
       <div class="container mt-5">
            <h1 class="tour-name ">
                {{$package->name}}
            </h1>
            <div class="tour-trip-date">
                @php

                $start=new DateTime($package->start);
                echo date_format($start, 'F j, Y');
                  
                
                @endphp 
                -
                @php

                $end=new DateTime($package->end);
                echo date_format($end, 'F j, Y');
                  
                
                @endphp 
            </div>
            <div class="package-Travelers">
                
               
                   <div class="traveler-count col-md-8">
                       <h4 class="sub-title">Travelers</h4>
                       <div class="  mb-3 row">
                            <label for="staticEmail" class="col-sm-7 col-form-label text-dark">Number of travelers</label>
                            <div class="col-sm-4">
                            <select class="form-select" id="num-travelers" aria-label="Default select example">
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="4">Four</option>
                            <option value="5">Five</option>
                            <option value="6">Six</option>
                            <option value="7">Eight</option>
                            <option value="8">Nine</option>
                            <option value="10">Ten</option>
                            </select>
                            </div>
                        </div>
                        <span style="color:#5f11bc;">To book for more than 10 people, give us a call.</span>
                   </div>  

                   <div class="travel-package col-md-8 mt-5">
                       <h4 class="sub-title">Package</h4>
                       <div class="row price-list-item">
                            <div class="col-md-7">Regular Price</div>
                            <div class="col-md-4">${{$package->priceperperson}}/person</div>
                       </div>
                       <hr > 
                       <div class="row price-list-item">
                            <div class="col-md-7">Grand Hotel /Stay</div>
                            <div class="col-md-4">include</div>
                       </div>
                       <hr>
                       <div class="row price-list-item">
                            <div class="col-md-7">Van /Transport</div>
                            <div class="col-md-4">include</div>
                       </div>
                       <hr>
                   </div>

                   <div class="travel-package col-md-8 mt-5">
                       <h4 class="sub-title">Special Request</h4>
                        
                       <p style="color:#5f11bc;">Stay a few extra days? Tell us the details below, and we'll let you know your options, including prices. To request extra days before your itinerary begins or after it ends, let us know your preferred travel dates and whether you
                        would like us to arrange hotels, transfers, and/or other touring services.</p>
                       
                        <textarea name="msg" id="msg" class="form-control"></textarea>
                       
                   </div>

                   <div class="travel-package col-md-8 mt-5">
                       <h4 class="sub-title">Total Checkout Bill</h4>
                       <div class="row price-list-item">
                            <div class="col-md-7">Per person subtotal</div>
                            <div class="col-md-4 package-price">${{$package->priceperperson}}</div>
                       </div>
                       <hr > 
                       <div class="row price-list-item">
                            <div class="col-md-7">Package Trip Days</div>
                            <div class="col-md-4">{{$package->days}}Days</div>
                       </div>
                       <hr>
                       <div class="row price-list-item">
                            <div class="col-md-7">Total for <span class="ppl"></span> travelers</div>
                            
                            <div class="col-md-4 package-total-amount">$5,098</div>
                       </div>
                       <div class="row price-list-item">
                            <div class="col-md-7">Deposit to pay today</div>
                            <div class="col-md-4">$0</div>
                       </div>
                       <div class="row price-list-item text-danger">
                            <div class="col-md-7">Balance: pay by <span class="pay-date"></span></div>
                            <div class="col-md-4 package-total-amount">$4,900</div>
                       </div>
                       <hr>
                   </div>

                   <div class="travel-package col-md-8 mt-5">
                       <h4 class="sub-title">Fill Your Contact</h4>
                       <div class="row price-list-item">
                            <div class="col-md-3">Phone</div>
                            <div class="col-md-9 ">
                                <input type="text" id="contact-phone" class="form-control">
                            </div>
                       </div>
                       <hr > 
                       <div class="row price-list-item">
                            <div class="col-md-3">Address</div>
                            <div class="col-md-9">
                                <textarea name="address" id="contact-address" class="form-control"></textarea>
                            </div>
                       </div>
                       
                   </div>

                   

                   <h4 class="mt-5 mb-3">Ready to Go?</h4>
                   <span class="my-4">Ok! let's book it!</span>  <br/> 
                   <button class="btn btn-secondary  btn-booking my-2"><h5 class="text-white">Reserve Now!</h5></button>
               
            </div>
       </div>

    </section>
    <!-- not  used -->
    <div class=" d-none">
        
        <section class="col-md-6 py-4">
            <div class="package-banner">
                <div class="package-photo-slides">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                        @foreach($photos as  $k=>$p)
                        <div class="carousel-item  {{$k==0 ? 'active':''}}">
                            <img src="{{ asset('storage/'.$p) }}" class="d-block  w-100" alt="...">
                        </div>
                        @endforeach
                        
                        </div>
                    </div>
                </div>
                <div class="package-header-content ">
                    <div class="package-title ">
                        <h1 class="tour-name">{{$package->name}}</h1>
                        <h4 class="tour-desc">{{$package->desc}}</h4>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- not used at all  -->

@endsection
@push('script')
<script>
    const numppl="{{$ppl}}";
    const days="{{$package->days}}";
    const price="{{$package->priceperperson}}";
    const startdate="{{$package->start}}";
    const packageid="{{$package->id}}";
    $(document).ready(function(){

        


        console.log(numppl);
       $('#num-travelers').val(numppl);
       $('.ppl').html(numppl);

       
        readData(numppl,price,startdate);
        


        $('#num-travelers').change(function(){
            let value=$(this).val();
            $('.ppl').html(value);
            readData(value,price,startdate);

        })

        function readData(numppl,price,startdate){
           

            let total=price * numppl;
            $('.package-total-amount').html(total);

            let payday=new Date(startdate);
            payday.setDate(payday.getDate()-1);
            $('.pay-date').html(payday.toLocaleDateString());
        }

        $('.btn-booking').click(function(){
            let ppl=$('#num-travelers').val();
            let msg=$('#msg').val();
            let phone=$('#contact-phone').val();
            let address=$('#contact-address').val();
            
            let data={
                'ppl':ppl,
                'msg':msg,
                'phone':phone,
                'address':address,
                'id':packageid
            };
            console.log(data);
            
            var csrf = document.querySelector('meta[name="csrf-token"]').content;
             Swal.fire({
                    title: 'Are you Ready to confirm this Booking?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    confirmButtonColor: '#3011BC',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Do it!',
                    showLoaderOnConfirm: true,
                    allowOutsideClick: () => !Swal.isLoading(),
                    preConfirm: function(){
                        return $.ajax({
                            url:'/p/checkout',
                            type:'POST',
                            data:{'data':data,'_token': csrf },
                            success:function(res){
                               if(res.msg){
                                    Swal.fire({
                                    title: 'Message',
                                    text: "Booking is Successfully Don@!",
                                    type: 'success',
                                    }).then(()=>{
                                        window.location.href='/';
                                    })
                               }
                            },
                            error:function(err){
                                console.log(err);
                            }
                        }); //Your ajax function here
                    }
                });      
         })


    })
</script>
@endpush