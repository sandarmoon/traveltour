<section class="py-0 overflow-hidden">

        <div class="container">

          <div class="row">

            
            
            <div class="col-6 col-8 col-lg-6 card shadow">

              <div class="py-8"><span class="fw-bold fs-4 text-primary ms-2">Contact Form</span>

                  <div class="p-3 py-5 p-md-3">
                    <div class="row">
                      
                      <div class="col-md-10 mx-auto card-body">
                        
                        <form id="contact-email-form" action="" method="post">
                          <div class="form-group row my-3">
                            <label for="name" class="col-md-2 form-control-label">Name</label>
                            <div class="col-md-10">
                                <input type="text" name="name" id="name" class="form-control ">

                            </div>
                          </div>

                          <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">

                          <div class="form-group row my-3">
                            <label for="email" class="col-md-2 form-control-label">Email</label>
                            <div class="col-md-10">
                                <input type="email" name="email" id="email" class="form-control ">

                            </div>
                          </div>


                          <div class="form-group row my-3">
                            <label for="message" class="col-md-2 form-control-label">Message</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="message" id="message"></textarea>
                            </div>
                          </div>

                          <div class="form-group row my-3">
                          
                            <div class="col-md-12 d-grid gap-2">
                                <input type="submit"  class="btn btn-primary d-inline-block btn-lg" value="Send Message"/>
                            </div>
                          </div>
                        </form>
                      </div>
                    
                    </div>
                  </div>
                </div>
                
              </div>

            



            <div class="col-6 col-sm-4 col-lg-6 bg-primary-gradient bg-offcanvas-right">
              <div class="py-7"><img class="d-inline-block mb-3" src="{{ asset('frontend/assets/travel.svg') }}" width="40" alt="logo" /><span class="fw-bold fs-4 text-light ms-2">Lucky Seven</span>

                <div class="py-7 p-md-7">
                  <p class="text-light"><i class="fas fa-phone-alt me-3"></i><span class="text-light">+3930219390</span></p>
                  <p class="text-light"><i class="fas fa-envelope me-3"></i><span class="text-light">something@gmail.com</span></p>
                  <p class="text-light"><i class="fas fa-map-marker-alt me-3"></i><span class="text-light lh-lg">333, Lorem Street, Albania, Alifornia<br/>United States of America</span></p>
                  <div class="mt-6">

                    <a href="#!"> <img class="me-3" src="{{asset('frontnew/assets/img/icons/facebook.svg')}}" alt="..." /></a>

                    <a href="#!"> <img class="me-3" src="{{asset('frontnew/assets/img/icons/twitter.svg')}}" alt="..." /></a>

                    <a href="#!"> <img class="me-3" src="{{asset('frontnew/assets/img/icons/instagram.svg')}}" alt="..." /></a></div>

                  <p class="mt-3 text-light text-center text-md-start"> Made with&nbsp;
                    <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#EB6453" viewBox="0 0 16 16">
                      <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"></path>
                    </svg>&nbsp;by&nbsp;<a class="text-light" href="#" >Lucky Seven</a>
                  </p>
                </div>  

              </div>
            </div>

          </div>
        </div>
        

      </section>
      