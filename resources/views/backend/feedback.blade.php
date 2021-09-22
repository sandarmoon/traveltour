@extends('backendTemplate')
@section('main-content')



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-7">
      <div class="container-fluid">
        <div class="my-ct-page-title text-white">
          <h1 class="ct-title text-white" id="content">
            Feedback & Email Contact
          </h1>
          <div class="avatar-group mt-3">
          </div>
        </div>
        <div class="card">
			{{-- start --}}
			
			
			{{-- end --}}
        </div>
       <div class="card mb-4" id="newtype_store">
            <div class="card-header pb-0">
                {{-- <i class="fas fa-plus-square me-1"></i>
                <span class="error-name"></span>
                <span class="successmsg"></span> --}}
                <div class="nav-wrapper pb-0">
      				    <ul class="nav nav-tabs" id="tabs-icons-text" role="tablist">
      				        <li class="nav-item">
      				            <a class="nav-link mb-sm-3 mb-md-0 active hotel_nav" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fas fa-comments mr-1"></i>Feedback</a>
      				        </li>
      				        <li class="nav-item">
      				            <a class="nav-link mb-sm-3 mb-md-0 car_nav" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">
      				            	<i class="fas fa-envelope mr-1"></i>Contact Form</a>
      				        </li>
      				        
      				    </ul>
      				  </div>
            </div>
            <div class="card shadow">
			    <div class="card-body">
			        <div class="tab-content" id="myTabContent">
			            <div class="tab-pane fade show active " id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                    <div class="table-responsive">
			                <table class="table align-items-center table-flush" id="feedback-table">
                        <thead class="thead-light">
                          <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Message</th>
                            {{-- <th>Action</th> --}}
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>example</td>
                            
                            <td>This is Data</td>
                            {{-- <td>
                              <button class="btn btn-success">
                                Confirm
                              </button>

                              <button class="btn btn-danger">
                                Cancel
                              </button>

                            </td> --}}

                          </tr>
                        </tbody>
                      </table>
                    </div>
			            </div>
			            <div class="tab-pane fade " id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">

			               <table class="table align-items-center table-flush" id="emailcontact-table">
                        <thead class="thead-light">
                          <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            {{-- <th>Action</th> --}}
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>example</td>
                            <td>example@gmail.com</td>
                            <td>This is message</td>
                            {{-- <td>
                              <button class="btn btn-success">
                                Confirm
                              </button>

                              <button class="btn btn-danger">
                                Cancel
                              </button>

                            </td> --}}

                          </tr>
                        </tbody>
                      </table>

			            </div>
			            
			        </div>
			    </div>
			</div>
            
        </div>
      </div>
    </div>
    
@endsection



@section('script')

<script type="text/javascript">
  var feedback_table;
  var email_contact;

  $(document).ready(function() {

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
                  url:'/type/'+id,
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


      feedback_table=$('#feedback-table').DataTable({
             
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
                  url: 'ajax/getfeedbackdataTable',
                  method: 'POST',
                  data: {
                  "_token": "{{ csrf_token() }}"
                  }
              },
              columns: [
                  {data: 'rownum', name: 'rownum'},
                  
                  {data: 'name', name: 'name'},
                  
                  {data: 'message', name: 'message'},
                  
                  // {data: 'action', name: 'action',searchable:false,orderable:false}
              ],

              columnDefs: [ 
                  
                  {targets: 1,
                  createdCell: createdCell,
                  },
                ],

                createdRow: function( row, data, dataIndex ) {
                    $( row ).find('td:eq(2)').addClass('dataTable_class_width');
                },
                
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



      email_contact=$('#emailcontact-table').DataTable({
             
              "serverSide": true,
              "processing": true,
              
              "sort":false,
              "autoWidth": false,
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
                  url: 'ajax/getemailcontactdataTable',
                  method: 'POST',
                  data: {
                  "_token": "{{ csrf_token() }}"
                  }
              },
              columns: [
                  {data: 'rownum', name: 'rownum'},
                  
                  {data: 'name', name: 'name'},

                  {data: 'email', name: 'email'},

                  {data: 'message', name: 'message'},
                  
                  // {data: 'action', name: 'action',searchable:false,orderable:false}
              ],

              columnDefs: [ 

                 {targets: 1,
                  createdCell: createdCell,

                  },

                  
                ],
                
              // initComplete: function () {
              //     this.api().columns().every(function () {
              //         var column = this;
              //         var input = document.createElement("input");
              //         $(input).appendTo($(column.footer()).empty())
              //         .on('change', function () {
              //             column.search($(this).val()).draw();
              //         });
              //     });
              // }
              
          });
  })
</script>








@endsection
