@extends('backendTemplate')
 @section('main-content')
 <div class="header bg-gradient-primary pb-8 pt-5 pt-md-7">
      <div class="container-fluid">
        <div class="my-ct-page-title text-white">
          <h1 class="ct-title text-white d-inline-block" id="content">
           Tour Package
          </h1>
         
          <a class="ct-example text-white float-right border-0" href="{{route('package.create')}}">
            <i class="fas fa-plus-square me-1"></i>
                <span class="error-name">New Tour Package</span>
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
                  <h3 class="mb-0">Tour Package List</h3>
                </div>
                <div class="table-responsive  p-1">
                  <table class="table align-items-center table-flush" id="package-table">
                    <thead class="thead-light">
                      <tr>
                        
                        <th scope="col">Name</th>
                        <th scope="col">From-To</th>
                        <th scope="col">Start-End</th>
                        <th scope="col">Days</th>
                        <th scope="col">Price Per Person</th>
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
@if (Session::has('sweet_alert.alert'))
  <script>
    swal({!! Session::get('sweet_alert.alert') !!});
  </script>
  @endif
<script >

  $(document).ready(function(){

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#package-table').DataTable({
      processing: true,
        serverSide: true,
        ajax:"{{route('ajax.getpackageAjax')}}",
        columns:[
          {data:'name'},
          {data:function(data){
            return data.depart.name + ' - '+data.destination.name;
          }},
          {data:function(data){
            return data.start + ' - '+data.end;
          }},
          {data:'days'},
          {data:'priceperperson'},
          {data:function(data){
            let html='';
           let package_date = new Date(data.start);
          package_date=package_date.getTime();

          let today = new Date();
          today=today.getTime();
          

          if( today > package_date){
              html="<h3><span class='badge badge-danger'>invalid</span></h3>";
          }else{
             if(data.status ==1)
                  html="<h3><span class='badge badge-success'>valid</span></h3>";
              else
              html="<h3><span class='badge badge-danger'>booking full</span></h3>";
          }

            return html;
           






          }},
          {data:'action',name:'action',orderable:false,searchable:false}
        ]
    })

    $('#package-table').on('click','.btn-delete',function(){
      let id=$(this).data('id');
      swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                  url:"package/"+id,
                  type:'DELETE',
                  success:function(res){
                      if(res.success){
                        $('#package-table').DataTable().ajax.reload();
                      }
                  },
                  error:function(err){
                    console.log(err);
                  }
                })
            } else {
              swal("You  clicked Cancel");
            }
          });
    })
  })
  
</script>
@endsection
