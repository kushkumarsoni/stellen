<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Application</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
  <link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

</head>
{{-- add new employee modal start --}}
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
            <ul id="save_errorList"></ul>
            <div class="row">
                <div class="col-lg-6 my-2">
                    <label for="name">Name<span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                    </div>
                <div class="col-lg-6 my-2">
                    <label for="email">E-mail<span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                </div>
                <div class="col-lg-6 my-2">
                    <label for="mobile">Mobile No<span class="text-danger">*</span></label>
                    <input type="tel" name="mobile" class="form-control" placeholder="mobile" required>
                </div>
                <div class="col-lg-6 my-2">
                    <label for="country_id">Country<span class="text-danger">*</span></label>
                    <select name="country_id" id="country_id" class="form-control country_id" required>        
                    </select>
                </div>
                <div class="col-lg-6 my-2">
                    <label for="state_id">State<span class="text-danger">*</span></label>
                    <select name="state_id" id="state_id" class="form-control state_id" required>
                        <option value="">Select State</option>
                    </select>
                </div>
                <div class="col-lg-6 my-2">
                    <label for="city_id">City<span class="text-danger">*</span></label>
                    <select name="city_id" id="city_id" class="form-control city_id" required>
                            <option value="">Select City</option>
                    </select>
                </div>
                <div class="col-lg-6 my-2">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" class="form-control" placeholder="Address"></textarea>
                </div>
                <div class="col-lg-6 my-2">
                    <label for="avatar">Select Avatar<span class="text-danger">*</span></label>
                    <input type="file" name="avatar" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_employee_btn" class="btn btn-primary">Add User</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">
        <input type="hidden" name="emp_avatar" id="emp_avatar">
        <div class="modal-body p-4 bg-light">
            <ul class="save_errorList"></ul>
          <div class="row">
            <div class="col-lg-6 my-2">
                <label for="name">Name<span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                </div>
            <div class="col-lg-6 my-2">
                <label for="email">E-mail<span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
            </div>
            <div class="col-lg-6 my-2">
                <label for="mobile">Mobile No<span class="text-danger">*</span></label>
                <input type="tel" name="mobile" id="mobile" class="form-control" placeholder="mobile" required>
            </div>
            <div class="col-lg-6 my-2">
                <label for="country_id">Country<span class="text-danger">*</span></label>
                <select name="country_id" id="edit_country_id" class="form-control country_id" required>
                    
                </select>
            </div>
            <div class="col-lg-6 my-2">
                <label for="state_id">State<span class="text-danger">*</span></label>
                <select name="state_id" id="edit_state_id" class="form-control state_id" required>
                    <option value="">Select State</option>
                </select>
            </div>
            <div class="col-lg-6 my-2">
                <label for="city_id">City<span class="text-danger">*</span></label>
                <select name="city_id" id="edit_city_id" class="form-control city_id" required>
                    <option value="">Select City</option>
                </select>
            </div>
            <div class="col-lg-6 my-2">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control" placeholder="Address"></textarea>
            </div>
          <div class="col-lg-6 my-2">
            <label for="avatar">Select Avatar</label>
            <input type="file" name="avatar" class="form-control">
          </div>
          <div class="mt-2" id="avatar">

          </div>
        </div>
    </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_employee_btn" class="btn btn-success">Update Employee</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit employee modal end --}}
<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-danger d-flex justify-content-between align-items-center">
            <h3 class="text-light">Manage Users</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i
                class="bi-plus-circle me-2"></i>Add New User</button>
          </div>
          <div class="card-body" id="show_all_employees">
            @include('users_table')
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  <!-- Include jQuery validation library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{asset('public/assets/js/parsley.min.js')}}"></script>
  <script>
    var $ = jQuery.noConflict();
    $(function() {
        "use strict";
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        // fetch all employees ajax request
        fetchAllEmployees();
       

        var country_id = '';
        var state_id = '';
        var city_id = '';

        fetchCountry(country_id);

    });

    $(document).ready(function() {
        $("#add_employee_form").validate({
            rules: {
                name: {
                    required:true,
                    minlength:3,
                    maxlength:191
                },
                email: {
                    required: true,
                    email: true,
                    maxlength:191,
                },
                mobile: {
                    required: true,
                    minlength: 10,
                    maxlength:10,
                },
                messages: {
                    name:{
                        required:"Please enter your name",
                        min: "Name should be atleast 3 characters"
                    },
                    mobile:{
                        required:"Please enter your mobile number",
                        min: "Mobile No should be 10 digits"
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email",
                        maxlength: "Please enter should not greater than 191 characters"
                    },
                }
            }
        });
        $("#edit_employee_form").validate({
            rules: {
                name: {
                    required:true,
                    minlength:3,
                    maxlength:191
                },
                email: {
                    required: true,
                    email: true,
                    maxlength:191,
                },
                mobile: {
                    required: true,
                    minlength: 10,
                    maxlength:10,
                },
                messages: {
                    name:{
                        required:"Please enter your name",
                        min: "Name should be atleast 3 characters"
                    },
                    mobile:{
                        required:"Please enter your mobile number",
                        min: "Mobile No should be 10 digits"
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email",
                        maxlength: "Please enter should not greater than 191 characters"
                    },
                }
            }
        });
    });

// add new employee ajax request
$("#add_employee_form").submit(function(e) {
    e.preventDefault();
    const fd = new FormData(this);
    $("#add_employee_btn").text('Adding...');
    $.ajax({
        url: "{{ route('users.store') }}",
        method: 'post',
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
        if(response.status == 400){
                $("#add_employee_btn").text('Add Employee');
                $("#save_errorList").html('');
                $("#save_errorList").addClass('alert alert-danger');
                $.each(response.errors,function(key,values){
                    $("#save_errorList").append('<li>'+values+'</li>');
                });
        }
        if (response.status == 200) {
            Swal.fire(
            'Added!',
            response.message,
            'success'
            )
            fetchAllEmployees();
            $("#add_employee_btn").text('Add Employee');
            $("#add_employee_form")[0].reset();
            $("#addEmployeeModal").modal('hide');
        }
        }
    });
    });

    // delete user ajax request
    $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "{{ route('users.delete') }}",
              method: 'delete',
              data: {id: id},
              success: function(response) {
                if(response.status == 200) {
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                    fetchAllEmployees();
                }
              }
            });
          }
        })
      });

    function fetchAllEmployees() {
        $.ajax({
            url: "{{ route('users.fetchAll') }}",
            method: 'get',
            success: function(response) {
            $("#show_all_employees").html(response);
            $("table").DataTable({
                order: [0, 'asc']
            });
            }
        });
    }

    // edit employee ajax request
    $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        
        let id = $(this).attr('id');
        let public_url = "{{ asset('public') }}";
        $.ajax({
          url: "{{ route('users.edit') }}",
          method: 'get',
          data: {id: id },
          success: function(response) {
            $("#name").val(response.users.name);            
            $("#email").val(response.users.email);
            $("#mobile").val(response.users.mobile);
            $("textarea#address").text(response.users.address);
            $("#avatar").html(`<img src="${public_url}/storage/images/${response.users.photo}" width="100" class="img-fluid img-thumbnail">`);
            $("#emp_id").val(response.users.id);
            $("#emp_avatar").val(response.users.photo);

            country_id = response.users.country_id;
            state_id = response.users.state_id;
            city_id = response.users.city_id;
            
            if(response.users.country_id) {
                fetchState(response.users.country_id);
                fetchCountry(response.users.country_id);
            }
            
            if(response.users.state_id) {
                fetchCity(response.users.state_id);
            }
          }
        });
    });

      // update employee ajax request
      $("#edit_employee_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_employee_btn").text('Updating...');
        $.ajax({
          url: "{{ route('users.update') }}",
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if(response.status == 400) {
                $("#edit_employee_btn").text('Update User');
                $(".save_errorList").html('');
                $(".save_errorList").addClass('alert alert-danger');
                $.each(response.errors,function(key,values){
                    $(".save_errorList").append('<li>'+values+'</li>');
                });
            }

            if (response.status == 200) {
              Swal.fire(
                'Updated!',
                'Employee Updated Successfully!',
                'success'
              )
                $("#edit_employee_btn").text('Update Employee');
                $("#edit_employee_form")[0].reset();
                $("#editEmployeeModal").modal('hide');
              fetchAllEmployees();
            }
           
          }
        });
    });

function fetchCountry(country_id=null){
   $.ajax({
    url: "{{ route('users.fetchCountry') }}",
    method: 'post',
    dataType: 'json',
    success: function(response) {
       if (response.status == 200) {
            var html = '<option value="">Select Country</option>';
            $.each(response.countries,function(key,values){
                let selected = '';
                if(values.id == country_id){
                    selected = 'selected';
                }
                html += '<option value="'+values.id+'" '+selected+'>'+values.country_name+'</option>';
                //$(".country_id").append('<option value="'+values.id+'" '+selected+'>'+values.country_name+'</option>')
            });
            $(".country_id").html(html);
        }
    }
  });
}

$(".country_id").on("change",function(){
    let country_id = $(this).val();
    fetchState(country_id);
});


function fetchState(cid){
   $.ajax({
    url: "{{ route('users.fetchState') }}",
    method: 'post',
    data: {country_id:cid},
    dataType: 'json',
    success: function(response) {
       if (response.status == 200) {
            var html = '<option value="">Select State</option>';
            $.each(response.states,function(key,values){
                let selected = '';
                if(values.id == state_id) {
                    selected = 'selected';
                }
                html +='<option value="'+values.id+'" '+selected+'>'+values.state_name+'</option>';
                //$(".state_id").append('<option value="'+values.id+'" '+selected+'>'+values.state_name+'</option>')
            });
            $(".state_id").html(html);
        }
    }
  });
}

$(".state_id").on("change",function(){
    let state_id = $(this).val();
    fetchCity(state_id);
});

function fetchCity(sid){
   $.ajax({
    url: "{{ route('users.fetchCity') }}",
    method: 'post',
    data: {state_id:sid},
    dataType: 'json',
    success: function(response) {
      if (response.status == 200) {
            var html = '<option value="">Select City</option>';
            $.each(response.cities,function(key,values){
                let selected = '';
                if(values.id == city_id) {
                    selected = 'selected';
                }
                html += '<option value="'+values.id+'" '+selected+'>'+values.city_name+'</option>';
                //$(".city_id").append();
            });
            $(".city_id").html(html);
        }
    }
  });
}
  </script>
</body>

</html>