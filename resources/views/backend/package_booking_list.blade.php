@extends('backendTemplate')
@section('main-content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-7">
      <div class="container-fluid">
        <div class="my-ct-page-title text-white">
          <h1 class="ct-title text-white d-inline-block" id="content">
                Package list
          </h1>
          
          <a class="ct-example text-white float-right border-0" href="{{route('list.car')}}">
            <i class="ni ni-bold-left"></i>
                <span class="error-name">Back</span>
          </a>
          
        </div>
        
      </div>
    </div>
    <div class="container-fluid mt--8">
        <div class="row">
            @foreach($packages as $package)
            <div class="col-md-4 ">
                <div class="card package-card">
            @php 
                $start_trip=new DateTime($package->start);
                $end_trip=new DateTime($package->end);
            @endphp
                    <div class="card-body">
                        <h5 class="card-title">{{$package->days}} Days Trip</h5>
                        <h2 class="card-text mb-0">{{$package->name}}</h2>
                        <span class="small">
                {{date_format($start_trip, 'M j, Y')}} - {{date_format($end_trip, 'M j, Y')}}</span>
                    </div>
                    
                   
                        <ul class="list-group ">
                            <li style="border-radius: 0px; " class="list-group-item d-flex justify-content-between align-items-center">
                            Expected 
                                <span class="badge bg-primary rounded-pill">{{$package->ppl}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Booked
                                <span class="badge bg-primary rounded-pill">{{$package->pbookings->sum('ppl')}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Counted To the Trip
                                @php 
                                $now = time(); // or your date as well
                                $your_date = strtotime($package->start);
                                $datediff =  $your_date-$now;

                                $d=round($datediff / (60 * 60 * 24));
                                
                                $date_now = date("Y-m-d"); // this format is string comparable

                               
                                @endphp


                                @if($date_now >= $package->start)
                                <span class="badge btn-danger  rounded-pill">
                                   invalid
                                </span>
                                @else
                                <span class="badge  {{$d > 2 ? 'btn-primary':'btn-danger'}} rounded-pill">
                                    {{$d}}
                                </span>
                                @endif
                            </li>
                            <li  class="list-group-item ">
                                <a  href="{{route('bookinglist.pid',$package->id)}}" class="btn btn-info btn-more float-right"  class="form-control">More Report</a>
                            </li>
                        </ul>
                    
                   
                        
                        
                    
                </div>
            </div>
            @endforeach
        </div>    
    </div>

@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('.btn-more').click(function(){
            
        })
    })
</script>
@endsection