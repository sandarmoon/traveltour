@extends('backendTemplate')
@section('main-content')
 <div class="header bg-gradient-primary pb-7 pt-4 pt-md-7">
  <div class="container-fluid">
    <div class="my-ct-page-title text-white">
      <h1 class="ct-title text-white d-inline-block" id="content">
        New Vehicle Adding 
      </h1>
      <a class="ct-example text-white float-right border-0" href="{{route('car.index')}}">
        <i class="ni ni-bold-left"></i>
            <span class="error-name">Go Back</span>
      </a>
      
    </div>
    
  </div>
</div>
<div class="container-fluid mt--7">
  <div class="  shadow">
     
     <div class="">
        
           
           
           {{-- <hr class="my-4" /> --}}
           <!-- Address -->
           
           <div class="pl-lg-4">
              <div class="row  ">

				      <div class="col-sm-12  ">
				        
				        <div class="card h-100 bg-transparent border-0 ">
				            <div class="card-body p-0">
				            	<form action="{{route('car.store')}}" method="post" enctype="multipart/form-data">
				            		@csrf
				                <div class="row">
				                  <div class="col-xl-4 col-lg-4   order-xl-1 mb-5 mb-xl-0 px-0">
				                    <div class="card h-100 card-profile shadow" style="border-radius: 0.375rem 0 0 0.375rem">
				                     <!--  <div class="row justify-content-center">
				                        <div class="col-lg-3 order-lg-2">
				                          <div class="card-profile-image">
				                            <a href="#">
				                              <img src="http://localhost:8001/template/assets/img/theme/team-4-800x800.jpg" class="rounded-circle">
				                            </a>
				                          </div>
				                        </div>
				                      </div>
				                      <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
				                        <div class="d-flex justify-content-between">
				                          <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
				                          <a href="#" class="btn btn-sm btn-default float-right">Message</a>
				                        </div>
				                      </div> -->
				                      <div class="card-body pt-0 pt-md-4">
				                        <div class="text-center" style="margin-top: 1rem;">
				                            <img style="min-height: 100px;"  src="http://localhost:8000/assets/img/theme/team-4-800x800.jpg" class="img-fluid">
				                        </div>
				                        <div class="mt-4">
						                    <div class="form-group">
						                       <label class="form-control-label" for="input-cover">Upload Cover</label>
						                       @error('cover')
														    <span class="text-danger">{{ 'is required' }}</span>
														@enderror
						                       <input type="file" id="input-cover" name="cover" class="form-control form-control-alternative" >
						                    </div>
						                 </div>

						                 <div class="mt-4">
						                    <div class="form-group">
						                       <label class="form-control-label" for="input-previews">Upload Preview</label>
						                       @error('previews')
														    <span class="text-danger">{{ 'is required' }}</span>
														@enderror
						                       <input type="file" id="input-previews" name="previews[]" multiple class="form-control form-control-alternative" placeholder="Username" value="lucky.jesse">
						                    </div>
						                 </div>

						                 <div class="mt-4">
					                 		<div class="form-group">
														    <label for="type_id">Type</label>
														    @error('type_id')
																    <span class="text-danger">{{ 'is required' }}</span>
																@enderror
														    <select class="form-control" name="type_id" id="type_id">
														    	<option value="">Choose One</option>
														      @foreach($types as $t)
														      <option value="{{$t->id}}">{{$t->name}}</option>
														      @endforeach
														    </select>
														  </div>
						                    
						                 </div>

						                 <div class="mt-4">
					                 		<div class="form-group">
														    <label for="city_id">City</label>
														    @error('city_id')
																    <span class="text-danger">{{ 'is required' }}</span>
																@enderror
														    <select class="form-control" name="city_id" id="city_id">
														    	<option value="">Choose One</option>
														      @foreach($cities as $t)
														      <option value="{{$t->id}}">{{$t->name}}</option>
														      @endforeach
														    </select>
														  </div>
						                    
						                 </div>
				                        
				                        {{-- <h4 class="text-center text-muted m-0"></h4>
				                          <div class="row">
				                            <div class="col">
				                              <div class="card-profile-stats d-flex justify-content-center">
				                                <div>
				                                  <span class="heading">1</span>
				                                  <span class="description">Visit time</span>
				                                </div>
				                                <div>
				                                  <span class="heading">1</span>
				                                  <span class="description">Charge Doctor</span>
				                                </div>
				                              </div>
				                            </div>
				                          </div> --}}
				                      </div>
				                    </div>
				                  </div>
				                  <div class="col-xl-8 col-lg-8   order-xl-2">
				                    <div class="card h-100  shadow" style="border-radius: 0 0.375rem 0.375rem 0">
				                      
				                      <div class="card-body">
				                        <div class="row">
				                        	<h6 class="heading-small text-muted mb-4">More information</h6>
				                        	<div class="col-lg-4">
							                    <div class="form-group">
							                       <label class="form-control-label" for="input-name">Car Name</label>
							                       @error('input_name')
																		    <span class="text-danger">{{ 'is required' }}</span>
																		@enderror
							                       <input type="text" id="input-name" class="form-control form-control-alternative" name="name" >
							                    </div>
							                  </div>

							                 <div class="col-lg-4">
								                 	<div class="form-group">
								                       <label class="form-control-label">Brand</label>
								                       @error('brand_id')
																				    <span class="text-danger">{{ 'is required' }}</span>
																				@enderror
								                       <div class="clear-both"></div>
								                       <select class="form-control" name="brand_id" id="type_id">
								                       	 <option value="">Choose One</option>
																		      @foreach($brands as $b)
																		      <option value="{{$b->id}}">{{$b->name}}</option>
																		      @endforeach
																		    </select>
																		  </div>
																</div>
																<div class="col-lg-4">
								                 	<div class="form-group">
								                       <label class="form-control-label">Automatic Gear</label>
								                       @error('auto_gear')
																				    <span class="text-danger">{{ 'is required' }}</span>
																				@enderror
								                       <div class="clear-both"></div>
								                       <div class="custom-control custom-radio custom-control-inline">
																  <input type="radio" id="auto_gear_on" name="auto_gear" class="custom-control-input" value="1" checked="checked">
																  <label class="custom-control-label" for="auto_gear_on" >Yes</label>
																</div>
																<div class="custom-control custom-radio custom-control-inline">
																  <input type="radio" id="air_condition_off" name="auto_gear" class="custom-control-input" value="0">
																  <label class="custom-control-label" for="auto_gear_off">No</label>
																</div>
								                  </div>
							                 </div>
							                 
							                 
							              </div>
				                        {{-- <hr style="border-top: 1px solid rgb(206 210 215 / 68%);"> --}}
				                        <div class="row">
				                        	<div class="col-lg-4">
								                    <div class="form-group">
								                       <label class="form-control-label" for="input-car-model">Car Model</label>
								                       @error('model')
																    <span class="text-danger">{{ 'is required' }}</span>
																@enderror
								                       <input type="text" id="input-car-model" class="form-control form-control-alternative" name="model">
								                    </div>
								                 </div>
				                        	<div class="col-lg-4">
								                    <div class="form-group">
								                       <label class="form-control-label" for="input-car_seat">Seats</label>
								                       @error('seat')
																    <span class="text-danger">{{ 'is required' }}</span>
																@enderror
								                       <input type="text" id="input-car_seat" name="seat" class="form-control form-control-alternative" >
								                    </div>
								                 </div>
								                 <div class="col-lg-4">
								                    <div class="form-group">
								                       <label class="form-control-label" for="input-car-door">Doors</label>
								                       @error('door')
																    <span class="text-danger">{{ 'is required' }}</span>
																@enderror
								                       <input type="text" id="input-car-door" class="form-control form-control-alternative" name="door">
								                    </div>
								                 </div>
								                 
								              </div>
								              <div class="row">
				                        	
								                 <div class="col-lg-4">
								                    <div class="form-group">
								                       <label class="form-control-label">Air Condition</label>
								                       @error('air_condition')
																    <span class="text-danger">{{ 'is required' }}</span>
																@enderror
								                       <div class="clear-both"></div>
								                       <div class="custom-control custom-radio custom-control-inline">
																  <input type="radio" id="air_condition_on" name="air_condition" class="custom-control-input" value="1" checked>
																  <label class="custom-control-label" for="air_condition_on">Yes</label>
																</div>
																<div class="custom-control custom-radio custom-control-inline">
																  <input type="radio" id="air_condition_off" name="air_condition" class="custom-control-input" value="0">
																  <label class="custom-control-label" for="air_condition_off">No</label>
																</div>
								                    </div>
								                 </div>

								                 <div class="col-lg-4">
								                  <div class="form-group">
								                       <label class="form-control-label" >Air Bag</label>
								                       @error('air_bag')
																    <span class="text-danger">{{ 'is required' }}</span>
																@enderror
								                       <div class="clear-both"></div>
								                       <div class="custom-control custom-radio custom-control-inline">
																  <input type="radio" id="air_bag_on" name="air_bag" class="custom-control-input" value="1">
																  <label class="custom-control-label" for="air_bag_on">Yes</label>
																</div>
																<div class="custom-control custom-radio custom-control-inline">
																  <input type="radio" id="air_bag_off" name="air_bag" value="0" class="custom-control-input">
																  <label class="custom-control-label" for="air_bag_off" >No</label>
																</div>
								                    </div>
								                 </div>
				                        	<div class="col-lg-4">
								                    <div class="form-group">
								                       <label class="form-control-label" for="input-air-bag-num">Air Bags</label>
								                       @error('air_bag_num')
																    <span class="text-danger">{{ 'is required' }}</span>
																@enderror
								                       <input type="number" id="input-air-bag-num" name="air_bag_num" class="form-control form-control-alternative" >
								                    </div>
								                 </div>
								                 
								              </div>
								              <p class="ct-lead">Fuel Policy is Full to Full!</p>
				                        <hr style="border-top: 1px solid rgb(206 210 215 / 68%);">
				                        <div class="row">
				                        	<h6 class="heading-small text-muted mb-4">Pricing information</h6>
				                        	<div class="col-lg-4 d-none">
							                    <div class="form-group">
							                       <label class="form-control-label" for="input-qty">Qty</label>
								                       @error('qty')
																    <span class="text-danger">{{ 'is required' }}</span>
																@enderror
							                       <input type="number" id="input-qty" name="qty" class="form-control form-control-alternative">
							                    </div>
							                 </div>
				                        	<div class="col-lg-4">
								                    <div class="form-group">
								                       <label class="form-control-label" for="input-price-per-day">Price Per Day</label>
								                       @error('price-per-day')
																    <span class="text-danger">{{ 'is required' }}</span>
																@enderror
								                       <input type="number" id="input-price-per-day" name="price_per_day" class="form-control form-control-alternative" value="0">
								                    </div>
								                </div>
								                <div class="col-lg-4">
								                    <div class="form-group">
								                       <label class="form-control-label" for="input-discoutn">Discount</label>
								                       <input type="number" id="input-discoutn" name="Discount" class="form-control form-control-alternative" value="0">
								                    </div>
								                </div>
								                <div class="col-lg-12">
								                    <div class="form-group">
								                       
								                       <input type="submit" class="form-control form-control-alternative bg-primary text-white"  value="Add Now">
								                    </div>
								                </div>

				                            {{-- <div class="col pb-0 mb-0">
				                              <div class="card-profile-stats d-flex justify-content-left my-0 py-0">
				                                <div class="pr-5 ml-4 py-0">
				                                  <span class="description">Job Description</span>
				                                  <span class="heading">retired</span>
				                                </div>

				                                <div class="p-0">
				                                  <span class="description"></span>
				                                  <span class="heading"></span>
				                                </div>

				                                <div class="p-0">
				                                  <span class="description"></span>
				                                  <span class="heading"></span>
				                                </div>
				                                
				                                
				                              </div>
				                            </div> --}}
				                        </div>
				                      </div>
				                    </div>
				                  </div>
				               </div>
				               </form>
	 {{-- card --}}    </div> 
	{{-- helo --}}</div>
				        
				      </div>
				       <!--  <div class="col-sm-3 " >
				            <div class="card h-100 card-body">
				                
				            </div>
				        </div> -->
				</div>
           </div>
           
        
     </div>
  </div>
  <!-- Footer -->
  <x-footer-component/>
  {{-- footer end --}}
</div>
@endsection