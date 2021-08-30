@extends('frontendTemplate')
@section('main')
<!-- Header-->
        
        <div class="col-md-10 offset-1 p-3 ">
            
            <div class="row">
                {{-- start here --}}
                <div class="col-md-12">

                	<ul class="nav nav-tabs" id="myTab" role="tablist">
					  <li class="nav-item" role="presentation">
					    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">OverView</button>
					  </li>
					  <li class="nav-item" role="presentation">
					    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Rooms</button>
					  </li>
					  <li class="nav-item" role="presentation">
					    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">More</button>
					  </li>
					</ul>

					<div class="tab-content" id="myTabContent">
						{{-- //for overview --}}
					  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					  	<div class="row h-100 ">
					  		<div class="col-md-7 ">
                              <div class="card-body">
                                <div class="my-3">
                                	<h1 class="hotel-heading-1 mb-0">{{$h->name}}</h1>
	                                <span class="heading-2 text-muted">{{$h->city->name}}</span>
                                </div>
                                <p class="card-text " style="font-size: 1.119rem;line-height: 1.4srem;">
                                   {{$h->info}}
                                   
                                   <h4 class="text-dark">Popular amenities</h4>
                                   	@foreach($popular_facilities as $k=>$f)
                                   	 <h5 class="text-dark">{{$k}}</h5>
                                   		<ul>
                                   			@foreach($f as $i)
                                   			<li>{{$i['name']}}</li>
                                   			@endforeach
                                   		</ul>
                                   	@endforeach

                                </p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p><i class="fas fa-wifi"></i> Wifi Included</p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    </div>
                                    <div>
                                        
                                    </div>
                                </div>
                              </div>
					  		</div>
					  		<div class="col-md-5 H-100  ">
					  			<div class="img-column">
					  				<img src="{{asset('storage/'.$h->logo)}}" style="width: 100%;height: auto;object-fit: cover;" alt="">
					  			</div>

					  		</div>
					  	</div>
					  </div>

					  {{-- //for rooms --}}
					  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					  <div class="col-md-8 mx-auto p-2">
					  	<form action="{{route('search.hotel')}}" class="mx-5 d-flex flex-lg-row flex-column  justify-content-lg-between justify-content-center" method="post">
							@csrf
							<!-- start here -->
							
							
							
							<div class="mb-3 px-lg-3 px-md-3 px-sm-0 px-xs-0 px-0">
								<label for="inputPassword2" class="
								">Check In @error('start_date') <span class="text-danger">required</span> @enderror </label>
									<input type="date" class="form-control" name="start_date" id="inputPassword2" value="{{$s_date}}" placeholder="">


							</div>
							<div class="mb-3 px-lg-3 px-md-3 px-sm-0 px-xs-0 px-0">
								<label for="inputPassword2" class="">Check Out  @error('end_date') <span class="text-danger">required</span> @enderror</label>
									<input type="date" class="form-control" name="end_date" id="inputPassword2"  value="{{$e_date}}" placeholder="">

							</div>

							<div class="mb-3 px-lg-3 px-md-3 px-sm-0 px-xs-0 px-0 counting-people">
								<label for="inputPassword2" >General Type</label>
								<input type="text" name="common_type" class="form-control" value="2 Travellers,1 Room">
									<!-- <select name="common_type" class="form-select" aria-label="Default select example">
									<option selected="selected" value="1">2 Travellers,1 Room</option>
									<option  value="2">3 Travellers,1 Room</option>
									</select> -->

							</div>

							<div class=" px-lg-3 px-md-3 px-sm-0 px-xs-0 px-0 d-none">
											<label for="inputPassword2" class="visually-hidden">Submit</label>
								<input type="submit" class=" btn btn-success form-control btn-submit " id="inputPassword2" value="Search ...!">

							</div>
							<!-- end here -->
						</form>
					  </div>
						<div class="row rooms-div ">
							@foreach($rooms as $room)
							@php
							$photos=json_decode($room->photos,true);
							$s=0;
							@endphp
							<div class="col-md-4">
								<div class="card">
									<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
										<div class="carousel-inner">
											@foreach($photos as $k=>$p)
											<div class="carousel-item {{($s==$k) ? 'active':''}}">
												<img src="{{asset('storage/'.$p)}}" class="d-block w-100" alt="...">
											</div>
											@endforeach
										</div>
									</div>
									<div class="card-body">
										<h6 class="mb-0">{{$room->type->name}},
											{{($room->single == null) ? '':$room->single." Single"}}
											{{($room->double == null) ? '':$room->double." Double"}}
											{{($room->king == null) ? '':$room->king." King"}}
											{{($room->queen == null) ? '':$room->queen." Queen"}}
											Beds, Non Smoking </h6>
										<p class="small text-muted">{{$room->wide}}Sqft</p>
										{{-- accordian start --}}
										<ul class="list-unstyled">
											<li><i class="fas fa-user-friends"></i> Sleep{{$room->ppl}}</li>
											<li><i class="fas fa-bed"></i>
												{{($room->single == null) ? '':$room->single." Single"}}
												{{($room->double == null) ? '':$room->double." Double"}}
												{{($room->king == null) ? '':$room->king." King"}}
												{{($room->queen == null) ? '':$room->queen." Queen"}} Bed
											</li>
											<li>
												<i class="fas fa-check"></i> Reserve Now,Pay Later
											</li>
											<li><a href="{{route('room.show',$room->id)}}" class="text-decoration-none">More Details ></a></li>
										</ul>
										<hr>
										<h6 class="description">Tax free is $10.(fixed)</h6>
										<hr class="mx-2">
										<div class="d-flex justify-content-between">
											<div>
												<h4 class="mb-0">${{$room->pricepernight}}</h4>
							
												<span class="price-desc small mb-2 text-muted">per night</span>
												<span class="total-desc  small mb-2 text-dark ">{{$room->pricepernight+ 10}} total</span><br />
							
							
												<div class="my-tooltip">
													<span class="fee-include  small mb-2 text-dark ">includes tax and fees</span>
													<div class=" tooltiptext">
														Tax Fee is 10$
														Total is {{$h->pricepernight}} + 10
													</div>
												</div>
											</div>
											<div>
												<span class="left-msg d-none  small mb-2 text-danger ">We have 4 left!</span>
												<button type="submit" class="btn btn-primary mt-3 btn-reserve" data-id="{{$room->id}}">Reserve
													Now!</button>
							
											</div>
										</div>
										{{-- accordian end --}}
							
									</div>
								</div>
							</div>
							@endforeach
			            </div>
					  </div>

					  {{-- //for More information --}}
					  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
					  	<div class="m-5">
					  		<h4>{{$h->service_label_one}}</h4>
					  		{!!$h->service_desc_one!!}
					  	</div>
					  </div>
					</div>
                        
                 </div>
                {{-- end here --}}

            </div>
            
        </div>
        <!-- Section for card-->
        {{-- modal start here --}}
		<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
		  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalToggleLabel">Travellers</h5>
		        <button type="button" class="btn-close d-none" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
			  <input type="hidden" name="code">
		      <div class="modal-body" >
				
		        <div class="room-div">
		        	
		        </div>
		        <hr>
		        <div class="moreroom"></div>
		        <button class="btn btn-primary btn-room btn-add-more-div" >Add more Room</button>
		      </div>
		      <div class="modal-footer">
		        <button class="btn btn-primary btn-next"  data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Next</button>
		      </div>
		    </div>
		  </div>
		</div>
		<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
		  <div class="modal-dialog modal-dialog-centered">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalToggleLabel2">Modal 2</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      
		      <div class="modal-body">
				  <h5>You have registered </h5>
				  <ul>
					  <li>Total Traveller   =>  <span class="text-primary ppl-count">5</span> people.</li>
					  <li>Total Room => <span class="text-danger r-count">2</span> Rooms.</li>
				  </ul>
		        
				
				<div class="bg-dark">
					<p class="text-danger p-3" style="font-size:0.725rem;">
						Each Room are specified with number of sleep !<br/>
						Please Choose two rooms that you have register!<br/>
						If not, you can change too!<br/>
						Thank you so much for your information!
					</p>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back to change</button>
				<button class="btn btn-primary btn-choose-room" data-bs-toggle="modal" data-bs-dismiss="modal">Choose Rooms</button>
		      </div>
		    </div>
		  </div>
		</div>
		
        {{-- modal end here --}}
        
@endsection
@push('script')
<script>
	var h_id="{{$h->id}}";
	var i=2;
	var desti="{{$drop_id}}";
	$(document).ready(function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		

		$('.rooms-div').on('click','.btn-reserve',function(){
			let id = $(this).data('id');
			let cart=localStorage.getItem('mycounting');
			if(cart){
				cart = JSON.parse(cart);
				// console.log();
				cart.r[0].r_id = id;
				localStorage.setItem('mycounting', JSON.stringify(cart));
			}
			 window.location.href="/booking/r/"+id;
			// alert('helo');
			// let mycart=localStorage.getItem('mycounting');
			// $.ajax({
			// 	url:'/rbooking',
			// 	type:"POST",
			// 	data:{'data':mycart,'r_id':id},
			// 	success:function(res){
			// 		console.log(res);
			// 	},
			// 	error:function(err){
			// 		console.log(err);
			// 	}
			// })
		})

		// filtering for rooms
		$('#exampleModalToggle2 .btn-choose-room').click(function(){
			alert('heo');
			let data=localStorage.getItem('mycounting');
			data=JSON.parse(data);
			let len=0; let pcount = 0;
			if(data){
				 len = data.r.length;
				$.each(data.r, function (l, m) {
					pcount += m.total;

				})
			}
			$.ajax({
				url:'/filter/'+pcount+'/'+h_id,
				type:'POST',
				data:{'data':data},
				success:function(res){
					// console.log(res);
					let data=JSON.parse(res.data);
					console.log(data);
					showRooms(data)
				},
				error:function(err){
					console.log(err);
				}
			})
		})

		//for  rooms with js
		function showRooms(data){
			
			let html=''; let images='';
			let detail_url = "{{route('room.show',':id')}}";
			// 
				$.each(data,function(i,v){
					detail_url=detail_url.replace(':id',v.id);
					html+=`<div class="col-md-4">
			                    <div class="card">
			                      <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
			                          <div class="carousel-inner">`;
					let photos= v.photos;
					
					if(photos != undefined){
						photos=JSON.parse(photos);
						let l=0;
						$.each(photos,function(j,k){
							console.log(k);
							// return false;
							images+=` <div class="carousel-item `;
								if (l == j) {
									images+='active'
								}

							images+=`"><img src="/storage/${k}" class="d-block w-100" alt="...">
									</div>`;
						})
						// return false;
						html+=images;

						html+=`</div>
			                        </div>
			                      <div class="card-body">
			                        <h6 class="mb-0">${v.type.name}, 
			                            ${(v.single == undefined) ? '': v.single}
			                            ${(v.double == undefined) ? '': v.double}
			                            ${(v.king == undefined) ? '': v.king}
			                            ${(v.queen== undefined) ? '': v.queen}
			                             Beds, Non Smoking </h6>
			                        <p class="small text-muted">${v.wide} Sqft</p>
			                        {{-- accordian start --}}
			                            <ul class="list-unstyled">
			                                <li><i class="fas fa-user-friends"></i> Sleep${v.ppl}</li>
			                                <li><i class="fas fa-bed"></i>
			                                    ${(v.single == undefined) ? '' : v.single}
												${(v.double == undefined) ? '' : v.double}
												${(v.king == undefined) ? '' : v.king}
												${(v.queen == undefined) ? '' : v.queen} Bed
			                                </li>
			                                <li>
			                                   <i class="fas fa-check"></i> Reserve Now,Pay Later
			                                </li>
			                                <li><a href="${detail_url}" class="text-decoration-none">More Details ></a></li>
			                            </ul>
			                            <hr>
			                            <h6 class="description">Tax free is $10.(fixed)</h6>
			                            <hr class="mx-2">
			                            <div class="d-flex justify-content-between">
			                                <div>
			                                    <h4 class="mb-0">${v.pricepernight}</h4>

			                                    <span class="price-desc small mb-2 text-muted">per night</span>
			                                    <span class="total-desc  small mb-2 text-dark ">${(v.pricepernight + 10)} total</span><br/>


			                                    <div class="my-tooltip">
			                                    	<span class="fee-include  small mb-2 text-dark ">includes tax and fees</span>
												  <div class=" tooltiptext">
												  	Tax Fee is 10$
												  	Total is ${v.pricepernight} + 10
												  </div>
												</div>
			                                </div>
			                                <div>
			                                     <span class="left-msg d-none  small mb-2 text-danger ">We have 4 left!</span>
												<button type="button"  class="btn btn-primary mt-3 btn-reserve" data-id="${v.id}">Reserve Now!</button>

			                                </div>
			                            </div>
			                        {{-- accordian end --}}

			                      </div>
			                    </div>
			                </div>`;
					}
				})
				$('.rooms-div').html(html);
		}
		
		// alert('hei');
		$('.counting-people').click(function(){
			$('#exampleModalToggle').modal('show');
			let s = $('input[name="start_date"]').val();
			let e = $('input[name="end_date"]').val();
			// generateing code
			let code="mycounting";
			// generateing code
			//mycart(desti, s, e,code);

			getCartData(code);
		})

		$('.btn-add-more-div').click(function () {
			//alert('helo');

			let cart = localStorage.getItem('mycounting');
			let c_obj = JSON.parse(cart);

			if (c_obj) {
				let len = c_obj.r.length;
				let lastrno = c_obj.r[len - 1].rno;

				let i = lastrno + 1;
				// start here	
				// console.log(cartName);
				let room = {
					'rno': i,
					'r_id': 0,
					'child': 0,
					'adult': 1,
					'total': 1
				};


				
					$.each(c_obj.r, function (h, l) {
						if (l.rno != i) {
							c_obj.r.push(room);
							return false;
						}
					})
					
				


				// if(type=='string'){
				// 	cart=JSON.parse(cartName);
				// }else{
				// 	cart=cartName;

				// 	console.log(cart.r);
				localStorage.setItem('mycounting', JSON.stringify(c_obj));
				// }


				// end here 
			}
			getCartData('mycounting');
		})

		

		 

	// starting 
	  $('.room-div').on('click', '.btn-add-adult', function () {
			let no = $(this).data('no');
			console.log(no);
			addingAdult(no);

		})

		$('.room-div').on('click', '.btn-minus-adult', function () {
			let no = $(this).data('no');
			console.log(no);
			reducingAdult(no);

		})

		$('.room-div').on('click', '.btn-add-children', function () {
			let no = $(this).data('no');
			console.log(no);
			addingChild(no);

		})

		$('.room-div').on('click', '.btn-minus-children', function () {
			let no = $(this).data('no');
			console.log(no);
			reducingChild(no);

		})
	// ending

	// clicking next button
	$('.btn-next').click(function () {
			// alert('hloe');
			let cart = localStorage.getItem('mycounting');
			let cartobj = JSON.parse(cart);
			let r = cartobj.r.length;

			let pcount = 0;
			
				$.each(cartobj.r, function (l, m) {
					pcount += m.total;

				})
				

			$('.ppl-count').html(pcount);
			$('.r-count').html(r);
			// console.log(pcount);

		})

		
	})

	function getCartData(user) {

	   let cart=localStorage.getItem(user);
			let obj = JSON.parse(cart);
			let final_html = '';
			if (obj) {
				$.each(obj.r, function (i, v) {
					let html = `<div class="traveller-counting">
								<div class="d-flex justify-content-between">
								<h6>Room ${v.rno}</h6>
								<a class="text-danger btn-delete"><i class="fas fa-times" data-id=${i}></i></a></div>
								<div class="d-flex justify-content-between">
									<div><p class="text-muted">Adult</p></div>
									<div class="d-flex ">
										<button class="btn btn-add-adult" data-no="${v.rno}"><i class="fas fa-plus-circle" ></i></button>
										<p class="text-muted mb-0 align-self-center result-${v.rno}-adult">${v.adult}</p>
										<button class="btn btn-minus-adult" data-no="${v.rno}"><i class="fas fa-minus-circle "></i></button>
									</div>
									
								</div>
								<div class="d-flex justify-content-between mt-4">
									<div><p class="text-muted mb-0">Childeren</p>
										<span>(Aged 0-17)</span></div>
									<div class="d-flex ">
										<button class="btn btn-add-children" data-no="${v.rno}"><i class="fas fa-plus-circle"></i></button>
										<p class="text-muted mb-0 align-self-center result-${v.rno}-children">${v.child}</p>
										<button class="btn btn-minus-children" data-no="${v.rno}"><i class="fas fa-minus-circle"></i></button>
									</div>
									
								</div>
							</div>
							<hr>
							`;
					final_html += html;
				})

				$('.room-div').html(final_html);


			}
			
		}

	     // for adult first room




			function addingAdult(no) {
				console.log('i am adult');
				console.log(no);
				let cart = localStorage.getItem('mycounting');
				let obj = JSON.parse(cart);

				
					$.each(obj.r, function (l, k) {
						if (k.rno == no) {
							++k.adult;
							k.total = k.adult + k.child;
							$(`.result-${no}-adult`).html(k.adult);
						}
					})
				

				localStorage.setItem('mycounting', JSON.stringify(obj));
			}



			function reducingAdult(no) {
				let cart = localStorage.getItem('mycounting');
				let obj = JSON.parse(cart);

				
					$.each(obj.r, function (l, k) {
						if (k.rno == no) {
							--k.adult;
							k.total = k.adult + k.child;
							if (k.total > 0) {
								localStorage.setItem('mycounting', JSON.stringify(obj));
								$(`.result-${no}-adult`).html(k.adult);
							}
							
						}
					})
				
			}
			// for adult first room end

			// for child first start


			function addingChild(no) {
				let cart = localStorage.getItem('mycounting');
				let obj = JSON.parse(cart);

				
					$.each(obj.r, function (l, k) {
						if (k.rno == no) {
							++k.child;
							k.total = k.adult + k.child;
							$(`.result-${no}-children`).html(k.child);
						}
					})
			

				localStorage.setItem('mycounting', JSON.stringify(obj));
			}




			function reducingChild(no) {
				let cart = localStorage.getItem('mycounting');
				let obj = JSON.parse(cart);

				
					$.each(obj.r, function (l, k) {
						if (k.rno == no) {
							--k.child;
							k.total = k.adult + k.child;
							if (k.total > 0) {
								localStorage.setItem('mycounting', JSON.stringify(obj));
								
							}
							$(`.result-${no}-children`).html(k.child);
						}
					})
				
			}

	  // for child first end
</script>
@endpush