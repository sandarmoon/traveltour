@extends('backendTemplate')
@section('main-content')



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-7">
      <div class="container-fluid">
        <div class="my-ct-page-title text-white">
          <h1 class="ct-title text-white d-inline-block" id="content">
            Car Booking list
          </h1>
          @if ($message = Session::get('success'))
              <div class="alert alert-success">
                  <p>{{ $message }}</p>
              </div>
          @endif
          {{-- <a class="ct-example text-white float-right border-0" href="">
            <i class="fas fa-left me-1"></i>
                <span class="error-name">back</span>
          </a> --}}
          
        </div>
        
      </div>
    </div>
    <div class="container-fluid mt--7">
      <div class="my-card">
        <div class="card-body p-0">
          
          <div class="row">
            <div class="col">
              <div class="card shadow">
                {{-- <div class="card-header border-0">
                  <h3 class="mb-0"> List</h3>
                </div> --}}
                <div class="table-responsive  p-1">
                  <table class="table align-items-center table-flush" id="car-booking-table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col"> booking Code</th>
                        
                        <th scope="col">Car</th>
                        <th scope="col">Date</th>
                        
                        <th scope="col">Day</th>
                        <th scope="col">From-to</th>
                        <th scope="col">Status</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Action</th>
                        
                       
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($bookings as $b)
                      <tr>
                        <td scope="col">No:{{$b->booking_code}}<br/>
                        {{$b->booking_date}}</td>
                        
                        <td scope="col">{{$b->car->name}}({{$b->car->type->name}}-{{$b->car->model}})</td>
                        <td scope="col">
                          @php
                          $date=date_create($b->departure_date);
                          $date=date_format($date,'Y M d');
                          echo $date;
                          @endphp
                        </td>
                        <td scope="col">{{$b->day}}</td>
                        <td scope="col">{{$b->from->name}}-{{$b->to->name}}</td>
                         <td scope="col">
                           @if($b->status ==1)
                           <h1 class="badge badge-warning" style="font-size: 0.8rem;">Pending</h1>
                           @elseif($b->status ==2)
                           <h1 class="badge badge-success" style="font-size: 0.8rem;">Confirm</h1>
                           @else
                           <h1 class="badge badge-danger" style="font-size: 0.8rem;">Cancel !</h1>
                           @endif
                         </td>
                        <td scope="col">{{$b->user->name}}</td>
                        
                        <td>
                          <div class="dropdown">
                            <button id="dLabel" class="btn dropdown-toggle" type="button" data-toggle="dropdown" 
                                    aria-haspopup="true" aria-expanded="true">
                              Action
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu  text-center " role="menu" aria-labelledby="dLabel">
                              <li><a class="dropdown-item" href="{{route('carbooking.confirm',[$b->id,'2'])}}">Confirm</a></li>
                              <li><a class="dropdown-item" href="{{route('carbooking.confirm',[$b->id,'3'])}}">Cancel</a></li>
                              
                              <li><a class="dropdown-item" href="{{route('car.booking.detail',$b->id)}}">Detail</a></li>
                              
                            </ul>
                          </div>
                        </td>
                        
                       
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
                </div>
                
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- Footer -->
      <x-footer-component/>
      {{-- footer end --}}
      
@endsection
@section('script')
<script>
  $(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#car-booking-table').dataTable({
      'serverSide':true,
      'processing':true,
      
      columns:[

        

      ]
    })

    // $('#car-booking-table').on('click','.btn-partner',function(){
    //   let status=$(this).data('status');
    //   let id=$(this).data('id');
    //   $.ajax({
    //     url:'confirm/partnership/'+id+'/'+status,
    //     type:'GET',
    //     success:function(res){
    //       // alert('res');

    //       $('#company-table').DataTable().ajax.reload();
    //     },
    //     error:function(err){
    //       // console.log(err);
    //     }
    //   })

    // })
  })
</script>
@endsection