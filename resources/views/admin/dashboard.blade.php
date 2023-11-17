@extends('layouts.master_layout')
@section('title','Admin Dashboard')
@section('section')
    <table class="table table-striped table-bordered table-responsive">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Mobile Number</th>
                <th scope="col">Password</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user['id'] }}</th>
                    <td>{{ $user['user_name'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ $user['mobile_number'] }}</td>
                    <td>{{ $user['password'] }}</td>
                    <td><button type="button" class="btn btn-success editBtn" data-id='{{ $user['id'] }}'>Edit</button>
                    </td>
                    <td><button type="button" class="btn btn-danger remBtn" data-id='{{ $user['id'] }}'>Delete</button>
                    </td>
                    <td>
                        <select class="status" data-id='{{ $user['id'] }}'>
                            <option value="1" {{ $user['status'] == 1 ? 'selected' : '' }}>Activate</option>
                            <option value="0" {{ $user['status'] == 0 ? 'selected' : '' }}>De-Activate</option>
                        </select>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="submitForm">
                        <div class="form-group">
                            <input class="form-control" placeholder="Update Username " type="text" id="user_name"
                                name="user_name">
                            <span class="user_name_error error"></span>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Update Email" type="email" id="email"
                                name="email">
                            <span class="email_error error"></span>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Update Mobile Number" type="text" id="mobile_number"
                                name="mobile_number">
                            <span class="mobile_number_error error"></span>
                        </div>
                        <input type="hidden" name="user_id" id="user_id">
                        <button class="btn btn-primary btn-block upBtn">Update User Data</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.remBtn').click(function() {
                let id = $(this).data('id');
                $.ajax({
                    url: '{{ route('remove.data', '') }}' + "/" + id,
                    type: 'post',
                    success: function(res) {
                        Swal.fire({
                            icon: "success",
                            title: "Removed",
                            text: `Id no.${res.id} has been Removed Succesfully`,
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 800);
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: `${error.message}`,
                        });
                    }
                });
            });
            $('.editBtn').click(function() {
                let id = $(this).data('id');
                $.ajax({
                    url: '{{ route('edit.data', '') }}' + "/" + id,
                    type: 'get',
                    success: function(res) {
                        response = res.data[0];
                        $("#user_name").val(response.user_name);
                        $("#email").val(response.email);
                        $("#password").val(response.password);
                        $("#mobile_number").val(response.mobile_number);
                        $("#user_id").val(response.id);
                        $('#exampleModal').modal('show');
                    }
                })
            })

            $("#submitForm").validate({
                rules: {
                    user_name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                },
                submitHandler: function() {
                    let data = $("#submitForm").serialize();
                    $('.error').text('');
                    $.ajax({
                        url: '{{ route('register.url') }}',
                        type: "post",
                        data: data,
                        beforeSend: function() {
                            $('.upBtn').html('Updating......')
                        },
                        success: function(res) {

                            Swal.fire({
                                icon: "success",
                                title: "Updated",
                                text: "Data Updated Succesfully.",
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 500);

                        },
                        error: function(xhr) {
                            $.each(xhr.responseJSON.errors, function(index, message) {
                                $(`.${index}_error`).text(message[0]).css('color',
                                    'red');
                                // console.log(message[0]);
                            });
                        },
                        complete:function(){
                            $('.upBtn').html('Update User Data')
                        }
                    });
                }
            });
            $('.status').change(function() {
                let id = $(this).data('id');
                let status = $(this).val();
                console.log(id);
                $.ajax({
                    url: '{{ route('update.status') }}',
                    type: 'post',
                    data: {
                        id: id,
                        status: status
                    },
                    success: function(res) {
                        Swal.fire({
                            icon: "success",
                            title: `${res.message}`,
                        });
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: `${error.message}`,
                        });
                    }
                })
            })
        });
    </script>
@endpush
@push('style')
    <style>
        .table {
            background-color: white;
        }

        .status {
            border-radius: 4px;
            padding: 5px;
            background-color: #0d6efd;
            color: white;
        }
    </style>
@endpush
