@extends('backendTemplate')
@section('main-content')



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-7">
      <div class="container-fluid">
        <div class="my-ct-page-title text-white">
          <h1 class="ct-title text-white d-inline-block" id="content">
            New PartnerShip
          </h1>
          @if ($message = Session::get('success'))
              <div class="alert alert-success">
                  <p>{{ $message }}</p>
              </div>
          @endif
          <a class="ct-example text-white float-right border-0" href="">
            <i class="fas fa-plus-square me-1"></i>
                <span class="error-name">New Company</span>
          </a>
          
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
                  <h3 class="mb-0">Partner List</h3>
                </div>
                <div class="table-responsive  p-1">
                  <table class="table align-items-center table-flush" id="company-table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Register Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Contact</th>
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

    $('#company-table').dataTable({
      'serverSide':true,
      'processing':true,
      ajax:'ajax/getPartnership',
      columns:[

        {data:'name'
        },
        {data:'created_at'},
        {data:function(data){
          let msg='';
          if(data.status ==1){
           msg='<span class="text-success">active</span>';
          }else{
            msg='<span class="text-danger">inactive</span>';
          }
          return msg;
        }},
        {data:function(data){
          let address='';
          if(data.addresss == undefined){
            address='';
          }else{
            address=data.addresss+'/';
          }
          return address+' Ph -'+data.phone;
        },className: "my-td"},
        {data:'action',name:'action',searchable:false,orderable:false}

      ]
    })

    $('#company-table').on('click','.btn-partner',function(){
      let status=$(this).data('status');
      let id=$(this).data('id');
      $.ajax({
        url:'confirm/partnership/'+id+'/'+status,
        type:'GET',
        success:function(res){
          // alert('res');

          $('#company-table').DataTable().ajax.reload();
        },
        error:function(err){
          // console.log(err);
        }
      })

    })
  })
</script>
@endsection