<div class=" p-2 search-div" style="left:{{$left}}">
    <nav class="">
      <div class="nav nav-tabs bg-light my-nav"  id="nav-tab" role="tablist">
        <button class="nav-link active col " id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
            <span class="icon icon-hotel "></span>
            <span class="label-text">Car</span>
        </button>
        <button class="nav-link col " id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
         <span class="icon icon-hotel"></span>
         <span class="label-text">Hotel</span></button>
        <button class="nav-link col " id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
         <span class="icon icon-jounery"></span><span class="label-text">Package</span></button>
      </div>
    </nav>
    <div class="tab-content bg-light" id="nav-tabContent">
      <div class="tab-pane fade show active p-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <!-- start here -->
          <form action="{{route('search.car')}}" method="post">
            @csrf
           <div class="mb-3">
               <label for="inputPassword2" class="visually-hidden">Departure Location</label>

                <select class="example_select2" name="p_city_id" style="width:100%">
                  @foreach($cities as $c)
                  <option value="{{$c->id}}">{{$c->name}}</option>
                  @endforeach
                </select>

           </div>
           <div class="mb-3">
               <label for="inputPassword2" class="visually-hidden">Destination Location</label>

                <select class="example_select2" name="d_city_id" style="width:100%">
                  @foreach($cities as $c)
                  <option value="{{$c->id}}">{{$c->name}}</option>
                  @endforeach
                </select>

           </div>
           <div class="mb-3">
               <label for="inputPassword2" class="visually-hidden">Start Date</label>
                <input type="date" class="form-control" name="start_date" id="inputPassword2" placeholder="">

           </div>
           <div class="mb-3">
               <label for="inputPassword2" class="visually-hidden">End Date</label>
                <input type="date" class="form-control" name="end_date" id="inputPassword2" placeholder="">

           </div>
           <div class="">
               <label for="inputPassword2" class="visually-hidden">Submit</label>
                <input type="submit" class=" btn btn-success form-control " id="inputPassword2" value="Search Now!">

           </div>
           </form>
          <!-- end here -->

      </div>
      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">Coming Soon</div>
      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">Comming Soon</div>
    </div>                
 </div>