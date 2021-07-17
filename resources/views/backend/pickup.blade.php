@extends('backendTemplate')
@section('main-content')



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-7">
      <div class="container-fluid">
        <div class="my-ct-page-title text-white">
          <h1 class="ct-title text-white" id="content">
            Pickup Loaction
          </h1>
          <div class="avatar-group mt-3">
          </div>
        </div>
       <div class="card mb-4" id="pickup-newform">
            <div class="card-header">
                <i class="fas fa-plus-square me-1"></i>
                <span class="error-name">New Location</span>
                <span class="message"></span>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <form method="post" action="{{route('pickup.store')}}" class="row gx-3 gy-2 align-items-center" >
                    @csrf
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" id="specificSizeInputName" placeholder="Enter Pickup Location">
                    </div>
                    <div class="col-sm-3">
                      <select class="form-select" aria-label="Default select example" name="parent_id">
                        <option selected>Open this select city</option>
                        @foreach($cities as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    
                    <div class="col-12 col-xl-3 col-lg-3 col-md-3 col-sm-12 ">
                        <button type="submit" class="btn btn-primary form-control">Submit</button>
                    </div>
                </form>

            </div>

        </div>
        <div class="card mb-4 d-none" id="pickup-editform">
            <div class="card-header">
                <i class="fas fa-plus-square me-1"></i>
                <span class="error-name">Editing Location</span>
                <span class="message"></span>
                
            </div>
            <div class="card-body">
                <form method="post"  class="row gx-3 gy-2 align-items-center">
                 {{ csrf_field() }}
                  <input type="hidden" name="_method" value="PUT">

                    
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" id="oldname" placeholder="Enter Pickup Location">
                    </div>
                    <div class="col-sm-3">
                      <select class="form-select" aria-label="Default select example" name="parent_id">
                        <option selected>Open this select city</option>
                        @foreach($cities as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    
                    <div class="col-12 col-xl-3 col-lg-3 col-md-3 col-sm-12 ">
                        <button type="submit" class="btn btn-primary form-control">Submit</button>
                    </div>
                </form>

            </div>

        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
      <div class="my-card">
        <div class="card-body p-0">
          
          <div class="row">
            <div class="col">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">City List</h3>
                </div>
                <div class="table-responsive  p-1">
                  <table class="table align-items-center table-flush" id="pickup-table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">City</th>
                        <th scope="col">Action</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Wireless gate</td>
                        <td>Yangon</td>
                        <td>
                          <button></button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div>      
        </div>
      </footer>
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

     $('#pickup-table').DataTable({
        processing: true,
        serverSide: true,
      ajax: '/getPickupAjax',
        columns: [
            {data: 'DT_RowIndex', name: 'id'},
            {data: 'name', name: 'name'},
            {data:'city',name:'city'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

     $('#pickup-table').on('click','.btn-delete',function(){
       let id=$(this).data('id');
          let ans=confirm('Are you sure to Delete?');
          if(ans){
            $.ajax({
              url:'pickup/'+id,
              type:'DELETE',
              success:function(data){
                $('.message').html(data.success);
                $('#pickup-table').DataTable().ajax.reload();
              },
              hide:function(e){
                console.log(e);
              }
            })
          }
     })

    $('#pickup-table').on('click','.btn-Edit',function(){
      $('#pickup-newform').addClass('d-none');
      $('#pickup-editform').removeClass('d-none');
      let id=$(this).data('id');
      let name=$(this).data('name');
      let parent=$(this).data('parent');
      let url="{{route('pickup.update',':id')}}";
      url=url.replace(':id',id);
      $("#oldname").val(name);
      $("#pickup-editform select").val(parent).change();
      $("#pickup-editform form").attr('action',url);
      
    })
     
  })
</script>
@endsection