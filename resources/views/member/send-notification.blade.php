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
            <h2>Send Notification</h2>
            <h5>Dashboard / Leave</h5>
        </div>
        <div class="notification-form-cover">
            <form id="send-notification" name="send-notification">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Message Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Message Body</label>
                            <textarea class="form-control" name="body"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Send Notification</button>
                </div>
            </form>
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

            $('#send-notification').validate({
                rules: {
                    title: "required",
                    desc: "required",
                },
                submitHandler: function() {
                    let data = $('#send-notification').serialize();
                    $.ajax({
                        url: '{{ route('send.notification') }}',
                        type: 'get',
                        data: data,
                        success: function(res) {
                            if (res.status) {
                                Swal.fire({
                                    icon: "success",
                                    title: res.message,
                                }).then((result) => {

                            });
                            }
                        }

                    });
                }
            });
        });
    </script>
@endpush
