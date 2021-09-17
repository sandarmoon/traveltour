@extends('backendTemplate')
@section('main-content')
@php 
$date_now = date("Y-m-d");
@endphp


    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-7">
      <div class="container-fluid">
        <div class="my-ct-page-title text-white">
          <h1 class="ct-title text-white d-inline-block" id="content">
            {{$package->name}}/{{$package->days}} days Trip   

            <span class="badge {{$date_now >= $package->start ? 'bg-danger':'bg-warning'}} rounded-pill">{{$date_now >= $package->start ? 'In-Valid':'Valid'}}</span>
          </h1>
          @if ($message = Session::get('success'))
              <div class="alert alert-success">
                  <p>{{ $message }}</p>
              </div>
          @endif
           <a class="ct-example text-white float-right border-0" href="{{route('backend.package.bookinglist')}}">
            <i class="fas fa-left me-1"></i>
                <span class="error-name">back</span>
          </a> 
          
        </div>

        <div class="d-flex justify-content-between text-white">
            <p>Departure Date : {{$package->start}}</p>
            <p>End Date : {{$package->end}}</p>
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
                  <table class="table align-items-center table-flush" id="pb-table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col"> booking Code</th>
                        <th scope="col"> booking Date</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Travelers</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                      </tr>
                    </thead>
                    <tbody>

                        @foreach($bookings as $b)
                            <tr>
                                <td>{{$b->codeno}}</td>
                                <td>{{$b->created_at
                                    }}</td>
                                <td>{{$b->user->name}}</td>
                                <td>{{$b->ppl}}</td>
                                <td>{{$b->ppl * $package->priceperperson}}</td>
                                <td>{{$b->phone  ? $b->phone : '-'}}</td>
                                <td>{{$b->address ? $b->address : '-'}}</td>
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

    $('#pb-table').dataTable();
      

    
  })
</script>
@endsection