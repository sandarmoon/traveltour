
 <section class="py-5">
    @php 
    $car=(object)$car;
    dd($car);
    $photos=json_decode($car->photo,true);
    $cover=$photos['cover'];
    @endphp

    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <!-- <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." /></div> -->
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{asset('storage/'.$cover)}}" alt="..." /></div>
            <div class="col-md-6">
                <div class="small mb-1">{{$car->company->name}}</div>
                <h1 class="display-5 fw-bolder">{{$car->name}}({{$car->model}})</h1>
                <div class="fs-5 mb-5">
                    <span class="{{($car->discount ==0) ? 'text-danger':'text-decoration-line-through'}}">${{$car->priceperday}}</span>
                    <span class="{{($car->discount ==0) ? 'd-none':''}}" >$40.00</span>
                </div>
                <div>
                    <ul class="">
                        <li>{{$car->type->name}}</li>
                        <li>{{$car->doors}} doors</li>
                        <li>{{$car->seats}} people</li>
                        <li>Auto Gear </li>
                        <li>Fuel info: full to full</li>
                        <li>{{($car->aircon==1) ? 'Full Air Conditional':'Limited Air Conditional'}}</li>
                        <li>{{($car->bags)}} air bags</li>
                        
                        <li>
                            <span class="text-warning"> Pickup Gate </span>
                            <ul class="list-inside ">

                                @foreach($car->pickuppivot as $location)
                                <li>{{$location->name}},{{$location->parent->name}}</li>
                                @endforeach
                            </ul>
                        </li>

                        
                    </ul>
                </div>
                <div class="d-flex">
                    <button class="btn {{($car->status==1) ? 'btn-success':'btn-danger'}}">
                        {{($car->status==1) ? 'Valid':'Booked'}}
                    </button>
                   
                    <a href="" class="btn btn-warning"> Edit</a>
                </div>
            </div>
        </div>
    </div>
</section>