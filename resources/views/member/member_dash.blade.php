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
            padding: 0 0 0 30px;
        }

        .member-head h2,h3{
            color: white;
        }
        .member-head{
            margin: 15px 0;
        }
        .row{
            margin:15px 0;
        }
    </style>
@endpush
@section('section')
    
    <div class="content container-fluid">

        <div class="member-head">
            <h2>Attendance</h2>
        <h3>Dashboard / Attendance</h3>
        </div>
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-5">
                <div class="card punch-status">
                    <div class="card-body">
                        <h5 class="card-title">Timesheet <small class="text-muted">11 Mar 2019</small></h5>
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
                        <div class="statistics">
                            <div class="row">
                                <div class="col-md-6 col-6 text-center">
                                    <div class="stats-box">
                                        <p>Break</p>
                                        <h6>1.21 hrs</h6>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6 text-center">
                                    <div class="stats-box">
                                        <p>Overtime</p>
                                        <h6>3 hrs</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card recent-activity">
                    <div class="card-body">
                        <h5 class="card-title">Today Activity</h5>
                        <ul class="res-activity-list">
                            <li>
                                <p class="mb-0">Punch In at</p>
                                <p class="res-activity-time">
                                    <i class="fa-regular fa-clock"></i>
                                    10.00 AM.
                                </p>
                            </li>
                            <li>
                                <p class="mb-0">Punch Out at</p>
                                <p class="res-activity-time">
                                    <i class="fa-regular fa-clock"></i>
                                    11.00 AM.
                                </p>
                            </li>
                            <li>
                                <p class="mb-0">Punch In at</p>
                                <p class="res-activity-time">
                                    <i class="fa-regular fa-clock"></i>
                                    11.15 AM.
                                </p>
                            </li>
                            <li>
                                <p class="mb-0">Punch Out at</p>
                                <p class="res-activity-time">
                                    <i class="fa-regular fa-clock"></i>
                                    1.30 PM.
                                </p>
                            </li>
                            <li>
                                <p class="mb-0">Punch In at</p>
                                <p class="res-activity-time">
                                    <i class="fa-regular fa-clock"></i>
                                    2.00 PM.
                                </p>
                            </li>
                            <li>
                                <p class="mb-0">Punch Out at</p>
                                <p class="res-activity-time">
                                    <i class="fa-regular fa-clock"></i>
                                    7.30 PM.
                                </p>
                            </li>
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
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let punchStatus = 0;
            $('.punch-btn').click(function(){
                if(punchStatus == 0){
                    punchStatus = 1;
                    $(this).text('Punch Out');
                    console.log(punchStatus);
                }
                else{
                    punchStatus = 0;
                    $(this).text('Punch In');
                    console.log(punchStatus);
                }
                $.ajax({
                    url:'{{route('punch.status')}}',
                    type:'post',
                    data:{
                        status:punchStatus
                    },
                    success:function(res){
                        console.log(res)
                    }
                });
            })
        })
    </script>
@endpush
