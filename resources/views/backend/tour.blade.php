@extends('backendTemplate')
@section('main-content')



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-7">
      <div class="container-fluid">
        <div class="my-ct-page-title text-white">
          <h1 class="ct-title text-white d-inline-block" id="content">
            Tours 
          </h1>
          @if ($message = Session::get('success'))
              <div class="alert alert-success">
                  <p>{{ $message }}</p>
              </div>
          @endif
          <a class="ct-example text-white float-right border-0" href="{{route('tour.create')}}">
            <i class="fas fa-plus-square me-1"></i>
                <span class="error-name">New Tour</span>
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
                  <h3 class="mb-0">Tour List</h3>
                </div>
                <div class="table-responsive  p-1">
                  <table class="table align-items-center table-flush" id="tour-table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Title</th>
                        <th scope="col">City</th>
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
      {{-- modal start --}}
      <div class="modal fade" id="pickupModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="{{route('pickup.route')}}">
              @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                Choose for Pickup Location in here!
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="carid" value="">
              <select class="js-example-basic-multiple" name="states[]" multiple="multiple" style="width: 100%" >
                {{-- @foreach($locations as $l)
                <option value="{{$l->id}}">{{$l->name}},{{$l->parent->name}}</option>
                
                 @endforeach --}}
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="closebtn">Close</button>
              <input type="submit" class="btn btn-primary" value="Save changes">
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('script')
<script>
  $(document).ready(function(){

    $('.table-responsive').on('show.bs.dropdown', function () {
     $('.table-responsive').css( "overflow", "inherit" );
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
         $('.table-responsive').css( "overflow", "auto" );
    })
    // $.fn.modal.Constructor.prototype._enforceFocus = function() {};
     $('.js-example-basic-multiple').select2({
      dropdownParent: $('#pickupModel'),
      width: 'resolve',
      placeholder: 'Pickup Here!',
      allowClear: true,
       
  
     });

     $('#js-example-basic-hide-search-multi').on('select2:opening select2:closing', function( event ) {
    var $searchfield = $(this).parent().find('.select2-search__field');
    $searchfield.prop('disabled', true);
});



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     var url = "{{route('ajax.gettourAjax')}}"
      $('#tour-table').dataTable({
        "serverSide": true,
            "processing": true, 
            "sort":false,
            pagingType: 'full_numbers',
             pageLength: 10,
             language: {
               oPaginate: {
                 sNext: '<i class="fa fa-forward"></i>',
                 sPrevious: '<i class="fa fa-backward"></i>',
                 sFirst: '<i class="fa fa-step-backward"></i>',
                 sLast: '<i class="fa fa-step-forward"></i>'
                 }
               } ,
            ajax: url ,
            columns: [
                
                {data: 'rownum', name: 'rownum'},
                {data: 'title'},
                {data: 'city'},            
                {data: 'action', name: 'action',searchable:false,orderable:false}
            ],

      })

      $('#tour-table').on('click','.btn-delete',function(){
         let id=$(this).data('id');
         let ans=confirm('Are you sure to delete!');
         if(ans){
          $.ajax({
            url:'tour/'+id,
            type:'DELETE',
            success:function(data){
              alert('success');
            },
            error:function(err){
              alert('err');
            }
          })
         }
         $('#tour-table').DataTable().ajax.reload();
      })
      
  })
</script>
@endsection