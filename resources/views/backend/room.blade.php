@extends('backendTemplate')
@section('main-content')



  <div class="header bg-gradient-primary pb-8 pt-5 pt-md-7">
      <div class="container-fluid">
        <div class="my-ct-page-title text-white">
          <h1 class="ct-title text-white d-inline-block" id="content">
            Hotel Room 
          </h1>
         
          <a class="ct-example text-white float-right border-0" href="{{route('room.create')}}">
            <i class="fas fa-plus-square me-1"></i>
                <span class="error-name">New Hotel Room</span>
          </a>
          
        </div>
        
        @if ($message = Session::get('status'))
              <div class="alert alert-success">
                  <p>{{ $message }}</p>
              </div>
          @endif
        
      </div>

    </div>
    <div class="container-fluid mt--7">
      <div class="my-card">
        <div class="card-body p-0">
          
          <div class="row">
            <div class="col">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">Room List</h3>
                </div>
                <div class="table-responsive  p-1">
                  <table class="table align-items-center table-flush" id="room-table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Type</th>
                        <th scope="col">Wide</th>
                        <th scope="col">People</th>
                        <th scope="col">Price Per Night</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                       
                      </tr>
                    </thead>
                    <tbody>

                     
                    </tbody>
                  </table>
                </div>
                
              </div>
            </div>
          </div>

        </div>
      </div>
      <x-footer-component/>
    </div>
@endsection
@section('script')
<script>
  var table;
  $(document).ready(function(){
    

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

     $('#room-table').DataTable({
        processing: true,
        serverSide: true,
      ajax: 'room/get/rooms',
        columns: [
            {data:'name'},
            {data:'type.name'},
            {data:function(data){
              return data.wide+ " sq ft";
            }},
            {data:'ppl'},
            {data:function(data){
              return data.pricepernight+ " $";
            }},
             {data:function(data){
              let msg='';
              if(data.status ==1){
               msg='<h3 class="badge badge-success" style="font-size: 0.8rem;"><span class="">Valid</span></h3>';
              }else{
                msg='<h3 class="badge badge-danger" style="font-size: 0.8rem;"><span class="">Booked</span></h3>';
              }
              return msg;
            }},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

     $('#room-table').on('click','.btn-delete',function(){
        let id=$(this).data('id');
        let ans=confirm('are you sure to delete?');
        if(ans){
          $.ajax({
            url:'room/'+id,
            type:"DELETE",
            success:function(res){
              if(res){
                $('.ajax-alert').removeClass('d-none');
                $('.ajax-alert').html(res.success);

              }
            },
            error:function(err){
              console.log(err);
            }
          })
        }
     })




     
     
  })
</script>
@endsection