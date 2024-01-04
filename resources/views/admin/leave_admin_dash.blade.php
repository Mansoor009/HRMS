@extends('layouts.master_layout')
@section('title', 'Admin - Leave(Employees)')
@push('style')
    <style>
        .admin-leave-head {
            color: white;
            margin: 20px 0;
        }

        .table-cover table {
            background-color: white;
        }

        .status {
            border-radius: 5px;
            padding: 5px;
        }

        .status:focus {
            box-shadow: rgb(172, 210, 255) 0px 1px 4px, rgb(172, 210, 255) 0px 0px 0px 3px;
        }
    </style>
@endpush
@section('section')
    <div class="content container-fluid">
        <div class="admin-leave-head">
            <h3>Leave History & Status</h3>
            <h6>Dashboard / Leave</h6>
        </div>
        <div class="table-cover">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-striped table-responsive-lg">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User Id</th>
                                <th scope="col">Leave Title</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <th scope="col">Description</th>
                                <th scope="col">Leave Status</th>
                                <th scope="col">Leave Type</th>
                                <th scope="col">No. Of Days</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($leave_records as $record)
                                <tr>
                                    <td scope='col'>{{ $record['id'] }}</td>
                                    <td scope='col'>{{ $record['user_id'] }}</td>
                                    <td scope='col'>{{ $record['title'] }}</td>
                                    <td scope='col'>{{ $record['from_leave'] }}</td>
                                    <td scope='col'>{{ $record['to_leave'] }}</td>
                                    <td scope='col'>{{ $record['description'] }}</td>
                                    <td scope='col'>
                                        <select class="status" name="status" id="status" data-id="{{ $record['id'] }}"
                                            data-user="{{ $record['user_id'] }}"
                                            {{ $record['status'] == 1 ? 'disabled' : '' }}>
                                            <option {{ is_null($record['status']) ? 'selected' : '' }} value="">
                                                Pending
                                            </option>
                                            <option {{ $record['status'] == '1' ? 'selected' : '' }} value="1">
                                                Approved
                                            </option>
                                            <option {{ $record['status'] == '0' ? 'selected' : '' }} value="0">
                                                Rejected
                                            </option>
                                        </select>
                                    </td>
                                    <td scope='col'>{{ $record['leave_type'] }}</td>
                                    <td scope='col'>{{ $record['no_of_days'] }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    @include('layouts.admin_sidebar')
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.status').change(function() {
                let id = $(this).data('id');
                let user_id = $(this).data('user');
                let val = $(this).val();
                if (val == '1') {
                    $(this).attr('readonly', '')
                } else if(val == '0'){
                    var reason = prompt('Rejection Reason')
                }
                $.ajax({
                    url: '{{ route('admin.leave.controll') }}',
                    type: 'post',
                    data: {
                        id: id,
                        val: val,
                        user_id: user_id,
                        reason: reason
                    },
                    success: function(res) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        if (res['value'] == '1') {
                            Toast.fire({
                                icon: "success",
                                title: "Leave Request Approved"
                            });
                        } else if (res['value'] == '0') {
                            Toast.fire({
                                icon: "success",
                                title: "Leave Request Rejected"
                            });
                        } else if (res['value'] == null) {
                            Toast.fire({
                                icon: "success",
                                title: "Leave Request is Still Pending"
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
