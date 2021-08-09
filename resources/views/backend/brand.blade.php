@extends('backendTemplate')
@section('main-content')



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-7">
      <div class="container-fluid">
        <div class="my-ct-page-title text-white">
          <h1 class="ct-title text-white" id="content">
            Brands
          </h1>
          <div class="avatar-group mt-3">
          </div>
        </div>
       <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-plus-square me-1"></i>
                <span class="error-name">New Brand</span>
                <span class="successmsg"></span>
            </div>
            <div class="card-body">
                <form class="row gx-3 gy-2 align-items-center" id="brand-newform">
                    
                    <div class="col-sm-8">
                       
                        <input type="text" class="form-control" name="name" id="specificSizeInputName" placeholder="Enter New Brand Name">
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
                  <table class="table align-items-center table-flush" id="brand-table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        
                        <th scope="col">Action</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
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
      const createdCell = function(cell) {
          let original;
        cell.setAttribute('contenteditable', true)
        cell.setAttribute('spellcheck', false)
        cell.addEventListener("focus", function(e) {
              original = e.target.textContent;
              console.log(e.target.textContent);

          })
        cell.addEventListener("blur", function(e) {
              if (original !== e.target.textContent) {
               console.log(original);
              const row = table.row(e.target.parentElement);
              let newdata=e.target.textContent;
              let id=row.data().id;
              
              $.ajax({
                  url:'/brand/'+id,
                  type:"PATCH",
                  data:{name:newdata},
                  success:function(res){
                      console.log(res);
                  },
                  error:function(error){
                      console.log(error);
                  }
              })
               
              }
        })
      }
        table=$('#brand-table').DataTable({
           
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
            ajax: {
                url: 'ajax/getBrand',
                method: 'POST',
                data: {
                "_token": "{{ csrf_token() }}"
                }
            },

            columns: [
                {data: 'rownum', name: 'rownum'},
                
                {data: 'name', name: 'name'},
                
                {data: 'action', name: 'action',searchable:false,orderable:false}
            ],
            columnDefs: [ 
               {targets: 1,
                createdCell: createdCell
                }
              ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                    .on('change', function () {
                        column.search($(this).val()).draw();
                    });
                });
            }
            
        });

    $('#brand-table').on('click','.btn-delete',function(){
      let id=$(this).data('id');
      let url='/brand/'+id;
        $.ajax({
          url:url,
          type:'DELETE',
          success:function(data){
            $('.successmsg').html(data.success);
             $('.successmsg').addClass('text-success');
             $('.successmsg').hide(2000);
             $('#brand-table').DataTable().ajax.reload();
          },
          error:function(error){
            console.log(error);
          }
        })
    })

    $('#brand-newform').submit(function(e){
      e.preventDefault();
      let name=$(`input[name="name"]`).val();
      $.ajax({
        url:'brand',
        type:'POST',
        data:{name:name},
        error:function(data){
            var errors=data.responseJSON.errors;
            $.each(errors,function(i,v){
                console.log(i);
                 $(`.error-${i}`).html(v);
                $(`.error-${i}`).addClass('text-danger');

            })
           },
           success:function(res){
               console.log(typeof res);
               console.log(res.success);
             $(`.error-name`).html('New City');
             $(`.error-name`).removeClass('text-danger');
             $('.successmsg').html(res.success);
             $('.successmsg').addClass('text-success');
             $('.successmsg').hide(2000);
             $(`#brand-newform input[name]`).val('');
             $('#brand-table').DataTable().ajax.reload();
            
             },
      })
    })
  })
</script>
@endsection