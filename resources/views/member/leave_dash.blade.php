@extends('layouts.master_layout')
@section('title', 'Leave Dashboard')
@push('style')
    <style>
        .member-head {
            color: white;
        }

        .table-cover table {
            background-color: white;
        }
    </style>
@endpush
@section('section')
    <div class="content container-fluid">
        <div class="member-head">
            <h2>Leave</h2>
            <h5>Dashboard / Leave</h5>
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
                                <th scope="col">Reject Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($leave_records as $record)
                                <tr>
                                    <td scope='col'>{{$record['id']}}</td>
                                    <td scope='col'>{{$record['user_id']}}</td>
                                    <td scope='col'>{{$record['title']}}</td>
                                    <td scope='col'>{{$record['from_leave']}}</td>
                                    <td scope='col'>{{$record['to_leave']}}</td>
                                    <td scope='col'>{{$record['description']}}</td>
                                    <td scope='col'>{{$record['status']}}</td>
                                    <td scope='col'>{{$record['leave_type']}}</td>
                                    <td scope='col'>{{$record['no_of_days']}}</td>
                                    <td scope='col'>{{$record['reject_reason']}}</td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-3">
                    <div class="leave-application">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Leave Application
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Leave Application</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="leave-application">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Leave Title</label>
                                                <input type="text" class="form-control" id="title" name='title'>
                                            </div>
                                            <select class="form-select" aria-label="Default select example" name="select"
                                                id="select">
                                                <option selected>Leave Account</option>
                                                <option data-bal="{{ $leave_count[0]['sick_leave'] }}"
                                                    value="{{ $sick }}">Sick
                                                    Leave</option>
                                                <option data-bal="{{ $leave_count[0]['paid_leave'] }}"
                                                    value="{{ $paid }}">Paid
                                                    Leave</option>
                                                <option data-bal="{{ $leave_count[0]['festive_leave'] }}"
                                                    value="{{ $festive }}">
                                                    Festive Leave</option>
                                            </select>
                                            <div class="mb-3">
                                                <label for="from" class="form-label">From</label>
                                                <input type="date" class="form-control" id="from" name="from">
                                            </div>
                                            <div class="mb-3">
                                                <label for="to" class="form-label">To</label>
                                                <input type="date" class="form-control" id="to" name="to">
                                            </div>
                                            <div class="mb-3">
                                                <label for="desc" class="form-label">Add Description</label>
                                                <textarea class="form-control" id="desc" rows="3" name="desc"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    @include('layouts.member_sidebar')
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#leave-application').validate({
                rules: {
                    title: "required",
                    from: "required",
                    to: "required",
                },
                submitHandler: function() {
                    let data = $('#leave-application').serialize();
                    $.ajax({
                        url: "{{ route('leave.dashboard.controll') }}",
                        type: "post",
                        data: data,
                        success: function(res) {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
@endpush
