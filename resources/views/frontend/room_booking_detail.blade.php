@extends('frontendTemplate')
@section('main')
<!-- Header-->
<section class=" py-2  ">
    <div class="container px-4 px-lg-5 my-5  ">

       <h4>Guest Detail!</h4>
       <div class=" row">
        <div class="col-md-8">
             <!-- getting contact here -->
             <div class="card">
                 <div class="card-body contact-div">
                     <h5 class="card-title">Contact Info</h5>
                     <div class="row ">
                         <div class="col">
                            <div class="form-group">
                              
                              <input type="text" name="name" id="name" class="form-control" placeholder="Name *" >
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

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="email" name="" id="" class="form-control" placeholder="Email Address *"
                                    aria-describedby="helpId">
                                <small  id="helpId" class="text-muted">This  is the email we will send your  confirmation to.</small>
                            </div>
                        </div>
                    
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
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque, deleniti! Commodi repudiandae placeat debitis dicta ipsa tenetur hic, quia corrupti voluptatem minima obcaecati amet laudantium optio? Quisquam natus recusandae amet.
        </div>
       </div>

    </div>
</serction>
<div class="col-md-10 offset-1 p-3 ">
    
    <div class="row">
       
    </div>

</div>
<!-- Section for card-->

@endsection
@push('script')
<script>
    $(document).ready(function () {
       



    })
</script>
@endpush