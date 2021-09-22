@extends('frontendnew')
@section('main-content')

{{-- 
<section class="py-0">
	<div class="container">
		<div style="background-image: url('{{asset('frontnew/assets/img/file/myanmar.jpeg')}}'); position: cover; background-repeat: no-repeat; height: 80px; transform: scale(1.15);" class="mt-5">


		</div>
	</div>
</section> --}}



<section class="py-0">
	<div class="container">
		<div class="row mt-5 tour_guide_row">
			<div class="d-flex align-items-start">
				<div class="mx-auto col-sm-12 col-lg-4">
				
				
				  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

				    <button class="nav-link nav_custom active my-2 text-uppercase font-weight-bold" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target=".v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
				    	About Us
				    </button>

				    <button class="nav-link nav_custom my-2 text-uppercase font-weight-bold" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target=".v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
				    	Contact Us
				    </button>


				    <button class="nav-link nav_custom my-2 text-uppercase font-weight-bold" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target=".v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Terms & Conditions</button>

				    <button class="nav-link nav_custom my-2 text-uppercase font-weight-bold" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target=".v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">
				    	Mission & Vision
				    </button>
				  </div>
				  
				


				</div>

				<div class="col-md-8 mx-auto col-sm-12 col-lg-8">
				
					<div class="tab-content" id="v-pills-tabContent">

					    <div class="tab-pane fade show active v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
					    	
					    	<div class="about-list zing-content">
								<div class="about-item">
									<h3 class="about-title">Who Are We</h3>
									<div class="about-content">
										<p style="margin: 0in; margin-bottom: .0001pt;">Lucky Seven Travel Tour is managed by Daily Trip Myanmar Travels &amp; Tours Co., Ltd. We are proudly to be an experienced local Myanmar tour operator and ticketing; offering all domestic flights for both foreigner and Burmese. We are also providing Myanmar river cruise, hotel and car booking throughout the country.</p>

										<p>Becoming one of the leading travel companies in Myanmar, all potential customer will be surely supported very well by our enthusiastic, experienced staff.&nbsp;
										</p>							
									</div>
								</div>
		                		<div class="about-item">
									<h3 class="about-title">Why Choose Us?</h3>
									<div class="about-content">
										<p>Myanmar is a Golden Land which still keeps its culture, traditional value and is completely safe for travelling. We answer for:</p>
										<ul>
										<li>The best price guarantee</li>
										<li>24/7 supporting online/ mobile phone&nbsp;</li>
										<li>Passionate &amp; experienced experts</li>
										<li>Very easy &amp; secure processing</li>
										</ul>							
									</div>
								</div>
		                		<div class="about-item">
									<h3 class="about-title">What We Do</h3>
									<div class="about-content">
										<p><strong>Package Tour</strong>
										<p>We are providing the many tours as package.In the package, where we go and where we visit in the way.Therefore,we will offer you tour guide who can explain details of the tour.</p>
										<p><strong>Accommodations&nbsp;</strong></p>
										<p>We are providing a variety of hotel booking from budget to luxury one so that we surely match with the customer&rsquo;s interests.&nbsp;</p>
										<p><strong>Cruises</strong></p>
										<p>We will bring you to extraordinary expedition on the mighty rivers of Myanmar. With a variety from budget to luxury cruise that make you feel as home.&nbsp;</p>
										<p><strong>Car rental</strong></p>
										<p>We are offering car rental from airport transfers to package tours that cover all sites across Myanmar. We are proud of providing good condition vehicles (air-conditioner, clean, tidy&hellip;), experienced drivers who are always on time, new model of transport and the safety is the first priority.&nbsp;</p>
										<ul>
										<li>Saloon 4 seater&nbsp;</li>
										<li>Hiace 9 seater&nbsp;</li>
										<li>Minis bus 14 seater&nbsp;</li>
										<li>Bus 24 seater/ 35 seater</li>
										<li>Coach 45 seater&nbsp;</li>
										</ul>
										<p><strong>Daily Group Tour</strong></p>
										<p>Providing daily joining group tours at all Myanmar's famous destinations with the most competitive prices. We are proud to be the pioneer organization offers this kind of tour for world-wide travellers with the desire to bring more options for travelholics, save costs while still have fully experience about destinations and opportunity to make friends with others.</p>							
									</div>
								</div>
		                	</div>
						</div>


					    
					    <div class="tab-pane fade v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
					    	<div class="row">
					    		<div class="col-md-12">
					    			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4900.577875125807!2d96.12157256951009!3d16.858234455590217!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c194f01a7ca8a3%3A0x427729d4e0e859b2!2sSein%20Gayhar%20(Parami)!5e0!3m2!1sen!2smm!4v1632319310643!5m2!1sen!2smm" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
					    		</div>
					    	</div>
					    	<hr>
					    	<div class="row mt-3">
					    		<div class="col-md-6">
					    			<h2>Head Office</h2>
					    			
					    			<p>
					    				<i class="fas fa-home" style="color: orange;"></i>
					    				
					    				<span class="text-dark">Third floor,Sein Gayhar (Parami), Parami Rd, Yangon</span>
					    				
					    				
					    			</p>

					    			<p>
					    				<i class="fas fa-phone" style="color: orange;"></i>
					    				<span class="text-dark">0912345678</span>
					    			</p>

					    			<p>
					    				<i class="fas fa-envelope" style="color: orange;"></i>
					    				<span class="text-dark">luckysenven@gmail.com</span>
					    			</p>
					    		</div>
					    	</div>
					    	
					    </div>
					    <div class="tab-pane fade v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
					    	
					    	<p>
					    	These terms and conditions form the basis of the contract between you and myanmarairfares.com. By purchasing our services you confirm that you have read, understood and agree to these terms and conditions.
					    	</p>

							<h5 class="mt-2">WHEN BOOKING</h5>

							<p>- You are aware that cancellations of flight bookings may be subject to additional charges.
							</p> 

							<p>- You please check all flight details carefully to ensure that all details are correct.
							</p>
							

							<h5 class="mt-2">BEFORE DEPARTURE</h5>

							<p>- You have the necessary entry visas for all the countries you are visiting.
							</p>
							<p>- You are recommended to have adequate travel insurance to cover for loss of luggage, medical expenses, costs and expenses incurred due to cancellations, delays or other disruptions.
							</p>

							<p>- Your current passport must be valid at least six months from the date of return to your country.
							</p>

							<h5 class="mt-2">PAYMENT</h5>

							<p>To confirm the booking, we kindly ask you to make full payment. The payment will be made by Credit card or Bank transfer with the following details:
							</p>


							<h5>BAGGAGE</h5>

							<h6 class="mt-2"><i>Checked baggage</i></h6>

							<p>You are allowed to bring 20kg per person, any excess baggage will be charged later. No free baggage allowance for infant.</p>

							<h6 class="mt-2"><i>Hand bag</i></h6>

							<p>You are allowed one item of carry-on luggage. Size limit is 22in x 15in x 8in (Total 45ins) and the weigh less than 7kg.</p>

						

					    </div>
					    <div class="tab-pane fade v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" style="height: 70vh;">
					    	<h5>
					    		Mission
					    	</h5>
					    	<p>Our mission is to reduce your time when search for car rental or hotel.You can search whatever you what such as car or hotel or package. </p>
					    	<p>In our site,package tour is very well for many people such old age people and only one traveller.</p>

					    	<h5>Vision</h5>
					    	<p>When you want to travel,you search the car or hotel at many places that time you wasted many time.</p>
					    	<p>So we want to reduce your wasted time.</p>
					    </div>


					</div>
				</div>

			</div>
		</div>
	</div>
</section>



@include('layouts.foot')
@endsection





