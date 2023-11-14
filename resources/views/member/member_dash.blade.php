@extends('layouts.master_layout')
@section('title', 'Member Dashboard')
@push('style')
    <style>
        .card .card-title {
            color: #1f1f1f;
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .punch-det {
            background-color: #f9f9f9;
            border: 1px solid #e3e3e3;
            border-radius: 4px;
            margin: 0 0 20px;
            padding: 10px 15px;
        }

        .punch-info .punch-hours {
            background-color: #f9f9f9;
            border: 5px solid #e3e3e3;
            font-size: 18px;
            height: 120px;
            width: 120px;
            margin: 0 auto;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .punch-info {
            margin: 0 0 20px;
        }

        button.btn.punch-btn {
            background: linear-gradient(45deg, rgba(245, 66, 102, 0.9), rgba(56, 88, 249, 0.9));
            color: white;
            font-size: 20px;
            padding: 5px 15px;
            border-radius: 10px;
            font-weight: 600;
        }

        .punch-info span {
            color: blue;
        }

        .punch-btn-section {
            text-align: center;
            margin: 0 0 20px;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        .recent-activity .res-activity-list {
            height: 328px;
            list-style-type: none;
            overflow-y: auto;
            position: relative;
            margin: 0;
            padding: 0;
        }

        .member-head h2,
        h5 {
            color: white;
        }

        .member-head {
            margin: 15px 0;
        }

        .row {
            margin: 15px 0;
        }

        .res-activity-list li {
            background-color: #4855eb;
            color: white;
            padding: 8px 10px;
            font-weight: 500;
            margin: 12px 0;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            border-radius: 10px;
        }
    </style>
@endpush
@section('section')

    <div class="content container-fluid">

        <div class="member-head">
            <h2>Attendance</h2>
            <h5>Dashboard / Attendance</h5>
        </div>
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-5">
                <div class="card punch-status">
                    <div class="card-body">
                        <h5 class="card-title">Timesheet <small class="text-muted"><?php echo date('d M Y') ?></small></h5>
                        <div class="punch-det">
                            <h6>Punch In at</h6>
                            <p>Wed, 11th Mar 2019 10.00 AM</p>
                        </div>
                        <div class="punch-info">
                            <div class="punch-hours">
                                <span>3.45 hrs</span>
                            </div>
                        </div>
                        <div class="punch-btn-section">
                            <button type="button" class="btn punch-btn">Punch In</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card recent-activity">
                    <div class="card-body">
                        <h5 class="card-title">Today Activity</h5>
                        <ul class="res-activity-list">

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date </th>
                                <th>Punch In</th>
                                <th>Punch Out</th>
                                <th>Production</th>
                                <th>Break</th>
                                <th>Overtime</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>19 Feb 2019</td>
                                <td>10 AM</td>
                                <td>7 PM</td>
                                <td>9 hrs</td>
                                <td>1 hrs</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>20 Feb 2019</td>
                                <td>10 AM</td>
                                <td>7 PM</td>
                                <td>9 hrs</td>
                                <td>1 hrs</td>
                                <td>0</td>
                            </tr>
                        </tbody>
                    </table>
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
            let punchStatus = 0;
            $('.punch-btn').click(function() {
                let htmlLi = '';
                if (punchStatus == 0) {
                    punchStatus = 1;
                    $(this).text('Punch Out');
                } else {
                    punchStatus = 0;
                    $(this).text('Punch In');
                }
                $.ajax({
                    url: '{{ route('punch.status') }}',
                    type: 'post',
                    data: {
                        status: punchStatus
                    },
                    success: function(res) {
                        console.log(res)
                        if (res['status'] == false) {
                            console.log(res)
                            Swal.fire({
                                icon: "warning",
                                title: 'Already Punched In',
                            });

                        }
                        else if (res['punch'] == 1 && res['status'] == true) {
                            Swal.fire({
                                icon: "success",
                                title: 'Punched In Succesfully',
                            });
                        } else if (res['punch'] == 0 && res['status'] == true) {
                            Swal.fire({
                                icon: "success",
                                title: 'Punched Out Succesfully',
                            });
                        }
                        res['attendance'].forEach((val) => {
                            if (val.punch_status == 1) {
                                htmlLi += `<li>Punch In At ${val.created_at}`
                            } else {
                                htmlLi += `<li>Punch Out At ${val.created_at}`
                            }
                            $('.res-activity-list').html(htmlLi);
                            console.log(val)
                        });
                    }
                });
            });
        });

    </script>
@endpush
