   <div class="col-md-4">
   <h4 class="text-dark">Search Here</h4>
   {{-- accordian start --}}
    <!-- total-price   -->
    <div class="mx-4">
        <h5 class="text-secondary">Total Price</h5>
       <ul class="list-unstyled" id="ul_group_total_price">
         <li>
          <input type="radio" class="group_total_price"  name="group_total_price" id="group_total_price_0-60" value="0-60">
										<label for="group_total_price_0-60">
											<span></span>$0 - $60 <font class="option-num">(1)</font>
										</label>
         </li>
         <li>
           <input type="radio" class="group_total_price"  name="group_total_price" id="group_total_price_70-140" value="70-140">
										<label for="group_total_price_70-140">
											<span></span>$70 - $140 <font class="option-num">(1)</font>
										</label>
         </li>
         <li>
           <input type="radio" class="group_total_price"  name="group_total_price" id="group_total_price_G140" value="G140">
										<label for="group_total_price_G140">
											<span></span>$140 and  more <font class="option-num">(1)</font>
										</label>
         </li>
       </ul>
    </div>

    <!-- facilites -->
    <div class="mx-4">
        <h5 class="text-secondary">Room Types </h5>
       <ul class="list-unstyled">
        @foreach($hoteltypes as $k=>$h_type)
         <li>
          <input type="checkbox" class="room_types"  name="group_total_room_type" id="group_total_room_type{{$k}}" value="{{$h_type->id}}">
										<label for="group_total_room_type{{$k}}">
											<span></span>{{$h_type->name}} <font class="option-num"></font>
										</label>
         </li>
         @endforeach
         
       </ul>
    </div>

    <div class="mx-4">
        <h5 class="text-secondary">Sleep Peoples</h5>
       <ul class="list-unstyled">
         <li>
          <input type="radio" class="group_total_ppl"  name="group_total_ppl" id="group_total_ppl_1" value="1">
										<label for="group_total_ppl_1">
											<span></span> A person  <font class="option-num"></font>
										</label>
         </li>
         <li>
           <input type="radio" class="group_total_2-3"  name="group_total_ppl" id="group_total_ppl_2-3" value="2-3">
										<label for="group_total_ppl_70-140">
											<span></span> Two-three People <font class="option-num"></font>
										</label>
         </li>
         <li>
           <input type="radio" class="group_total_G3"  name="group_total_ppl" id="group_total_ppl_G3" value="G3">
										<label for="group_total_ppl_G140">
											<span></span> Family (more than 3) <font class="option-num"></font>
										</label>
         </li>
       </ul>
    </div>

   
   {{-- accordian start --}}

</div> 

@push('script')
<script>
$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

  if(sessionStorage.getItem('group_total_room_type')){
    let auto_room_types=JSON.parse(getSavedValue('group_total_room_type'));
    $.each(auto_room_types, function(i,v) {
      $("input[value=" + v + "]").attr("checked", "checked");
    });
  }

    let auto_total_price=getSavedValue('group_total_price');
    $('input:radio[name="group_total_price"]').filter('[value="'+auto_total_price+'"]').attr('checked', true);

    let auto_total_ppl=getSavedValue('group_total_ppl');
    $('input:radio[name="group_total_ppl"]').filter('[value="'+auto_total_ppl+'"]').attr('checked', true);

     

    

   $('input[name="group_total_price"]').change(function(){
       let data=$(this).val();
       sessionStorage.setItem('group_total_price', data);
        let hotels='';
       $.ajax({
         url:"{{route('hotel.filter.price')}}",
         type:"POST",
         data:{'price':data},
         success:function(res){
           let data=res.hotels;
            
            $.each(data,function(i,v){
              let info="{{substr(':info', 0, 200)}}";
              info=info.replace(':info',v.info);

             

              hotels+=`
                <div class="col-md-12">
                  <div class="card mb-3" data-id="${v.id}">
                  <div class="row g-0">
                  
                    <div class="col-md-4">
                      <img src="\/storage/${v.logo}" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <h5 class="card-title">${v.name}</h5>
                        <span class="text-muted">${v.addresss}}</span>
                        <p class="card-text">
                        ${info}"..."
                        </p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              `;
            })
            $('#filter-data-ajax').html(hotels);
         }
         
       })

   })

   $('input[name="group_total_room_type"]').change(function(){
      

        let room_type=sessionStorage.getItem('group_total_room_type');
        if(!room_type){
          console.log('helo');
           room_type = [];
            $.each($("input[name='group_total_room_type']:checked"), function(){            
                room_type.push($(this).val());
            });
            sessionStorage.setItem('group_total_room_type', JSON.stringify(room_type));
        }else{
          console.log('may');
          let new_room_type = [];
            $.each($("input[name='group_total_room_type']:checked"), function(){            
                new_room_type.push($(this).val());
            });
            sessionStorage.setItem('group_total_room_type', JSON.stringify(new_room_type));
        }

         room_type=sessionStorage.getItem('group_total_room_type');
         let hotels='';
       $.ajax({
         url:"{{route('hotel.filter.room.type')}}",
         type:"POST",
         data:{'type':room_type},
         success:function(res){
           let data=res.hotels;
            console.log( data);

            
            $.each(data,function(l,k){
              $.each(k,function(i,v){
              let info="{{substr(':info', 0, 200)}}";
              info=info.replace(':info',v.info);

             

              hotels+=`
                <div class="col-md-12">
                  <div class="card mb-3" data-id="${v.id}">
                  <div class="row g-0">
                  
                    <div class="col-md-4">
                      <img src="\/storage/${v.logo}" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <h5 class="card-title">${v.name}</h5>
                        <span class="text-muted">${v.addresss}}</span>
                        <p class="card-text">
                        ${info}"..."
                        </p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              `;
            })
            })
            $('#filter-data-ajax').html(hotels);
         }
         
       })
           
        
   })

   $('input[name="group_total_ppl"]').change(function(){
       let data=$(this).val();
       sessionStorage.setItem('group_total_ppl', data);
       let hotels='';
       $.ajax({
         url:"{{route('hotel.filter.ppl.count')}}",
         type:"POST",
         data:{'ppl':data},
         success:function(res){
           let data=res.hotels;
            
            $.each(data,function(i,v){
              let info="{{substr(':info', 0, 200)}}";
              info=info.replace(':info',v.info);

             

              hotels+=`
                <div class="col-md-12">
                  <div class="card mb-3" data-id="${v.id}">
                  <div class="row g-0">
                  
                    <div class="col-md-4">
                      <img src="\/storage/${v.logo}" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <h5 class="card-title">${v.name}</h5>
                        <span class="text-muted">${v.addresss}}</span>
                        <p class="card-text">
                        ${info}"..."
                        </p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              `;
            })
            $('#filter-data-ajax').html(hotels);
         }
         
       })
   })
</script>
@endpush


   
  