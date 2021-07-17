<div class="row">
  @foreach($cars as $car)

  @php 
  $photos=json_decode($car->photo,true);
  $cover='storage/'.$photos['cover'];

  @endphp
  <div class="col-md-6 mb-5">
     <div class="card mb-3 " >
        <div class="row g-0 ">
          <div class="col-md-5">
            <img src="{{asset($cover)}}" style="min-height: 100%;" class="img-fluid " alt="...">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <span class=""></span>
              <div class="ct-page-title">
                <div class="small mb-1">{{$car->company->name}}</div>
                <h4 class="ct-title  d-inline-block">{{$car->name.'('.$car->model.')'}}
                </h4>

                

                <button type="button" class=" float-left btn btn-primary position-relative">
                  <span class="{{($car->discount ==0) ? 'text-white':'text-decoration-line-through'}}">${{$car->priceperday}}</span>
                    
                 @if($car->discount !=0)
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{$car->discount}}
                    <span class="visually-hidden">discount</span>
                  </span>
                  @endif
                </button>
              <div class="clear-both"></div>
                <span class="ct-lead">{{$car->type->name}}</span>
                
              </div>
              <div class="ct-content">
                <ul>
                   <li>Automatic</li>
                  <li>{{$car->seats}} people</li>
                  <li>{{$car->doors}} Doors</li>
                  <li>{{($car->aircon==1) ? 'Full Air Conditional':'Limited Air Conditional'}}</li>
                   @if($car->bags > 0)
                   <li>{{$car->bags}} air bags included!</li>
                   @endif
                </ul>
                <a wire:click="firstStepSubmit({{$car->id}})" class="btn btn-success">Book Now!</a>
                
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  @endforeach
</div>
