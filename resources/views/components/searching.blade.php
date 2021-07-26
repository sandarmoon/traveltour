<div class="search-div">
     <div class="" >
        <nav class="px-3">
          <div class="nav nav-tabs  my-nav mp-3"  id="nav-tab" role="tablist">

            <div class="search-item active col bg-light  d-flex justify-content-center  py-4  " id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"  style="border-top-left-radius: 90px;">
                <span class="icon icon-hotel  " ></span>
                <p class="label-text  mt-2" > Car</p>
            </div>

            <div class="search-item col bg-light py-4  d-flex justify-content-center     " id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
             <span class="icon icon-hotel"></span>
             <p class="label-text mt-2">Hotel</p>
            </div>

            <div class="search-item col bg-light py-4  d-flex justify-content-center   " id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false" style="border-top-right-radius: 90px;">
             <span class="icon icon-jounery"></span><p class="label-text mt-2">Package</p>
            </div>

          </div>
        </nav>
        <div class="tab-content py-5 search-content  " style="width:100%;" id="nav-tabContent">
          <div class="tab-pane fade show active p-3 " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <form action="{{route('search.car')}}" class="mx-5 d-flex flex-lg-row flex-column  justify-content-lg-between justify-content-center" method="post">
             @csrf
              <!-- start here -->
              <div class="mb-3 px-lg-3 px-md-3 flex-grow-1 px-sm-0 px-xs-0 px-0">
                    <label for="inputPassword2" class="">Departure </label>

                    <select class="example_select2" name="p_city_id" style="width:100%;line-height: 26px;">
                      @foreach($cities as $c)
                      <option value="{{$c->id}}">{{$c->name}}</option>
                      @endforeach
                    </select>

               </div>
               <div class="mb-3 px-lg-3 px-md-3 flex-grow-1 px-sm-0 px-xs-0 px-0">
                   <label for="inputPassword2" class="">Destination </label>

                    <select class="example_select2 from-control"  name="d_city_id" style="width:100%">
                      @foreach($cities as $c)
                      <option value="{{$c->id}}">{{$c->name}}</option>
                      @endforeach
                    </select>

               </div>
               <div class="mb-3 px-lg-3 px-md-3 px-sm-0 px-xs-0 px-0">
                   <label for="inputPassword2" class="">Check In</label>
                     <input type="date" class="form-control" name="start_date" id="inputPassword2" placeholder="">


               </div>
               <div class="mb-3 px-lg-3 px-md-3 px-sm-0 px-xs-0 px-0">
                   <label for="inputPassword2" class="">Check Out</label>
                    <input type="date" class="form-control" name="end_date" id="inputPassword2" placeholder="">

               </div>
               <div class=" px-lg-3 px-md-3 px-sm-0 px-xs-0 px-0">
                               <label for="inputPassword2" class="visually-hidden">Submit</label>
                <input type="submit" class=" btn btn-success form-control btn-submit " id="inputPassword2" value="Search ...!">

               </div>
              <!-- end here -->
          </form>
          </div>
          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">..p.</div>
          <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">..k.</div>
        </div>                
    </div>
</div>