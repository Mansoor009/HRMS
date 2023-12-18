@php
    use Carbon\Carbon;
@endphp
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
            font-weight: 500;
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
            height: 312px;
            list-style-type: none;
            overflow-y: auto;
            position: relative;
            margin: 0;
            padding: 0 0 0 30px;
        }

        .recent-activity .res-activity-list li:before {
            content: "";
            width: 10px;
            height: 10px;
            border: 2px solid #c23b82;
            z-index: 2;
            background: #ffffff;
            border-radius: 100%;
            margin: 0 0 0 15px;
            position: absolute;
            top: 0;
            left: -45px;
        }

        .recent-activity .res-activity-list li {
            margin: 0 0 15px;
            position: relative;
            font-weight: 500;
        }

        .recent-activity .res-activity-list:after {
            content: "";
            border: 1px solid #e5e5e5;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 4px;
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
                        <h5 class="card-title">Timesheet <small class="text-muted"><?php echo date('d M Y'); ?></small></h5>
                        <div class="punch-det">
                            <h6>First Punch In Today at</h6>
                            <p>
                                <?php
                                if (isset($firstPunchIn)) {
                                    $date = new DateTime($firstPunchIn);
                                    echo $date->format('D h:i:s A');
                                } else {
                                    echo 'Not Checked Today';
                                }
                                ?>
                            </p>
                        </div>
                        <div class="punch-info">
                            <div class="punch-hours">
                                <div id="timer"><span id="timerValue">{{ $begin }}</span></div>
                            </div>
                        </div>
                        <div class="punch-btn-section">
                            @if (!isset($punch))
                                <button data-action="1" type="button" class="btn punch-btn">Punch In</button>
                            @else
                                <button data-action="{{ $punch ? 0 : 1 }}" type="button" class="btn punch-btn">Punch
                                    {{ $punch ? 'Out' : 'In' }}</button>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card recent-activity">
                    <div class="card-body">
                        <h5 class="card-title">Today Activity</h5>
                        <ul class="res-activity-list">
                            @foreach ($attendance as $val)
                                @if ($val->punch_status == 1)
                                    <li>Punch In at <br>{{ Carbon::parse($val->created_at)->format('h:i A') }}</li>
                                @else
                                    <li>Punch Out at <br>{{ Carbon::parse($val->created_at)->format('h:i A') }}</li>
                                @endif
                            @endforeach
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
                                <th>User Name</th>
                                <th>Date </th>
                                <th>Punch In</th>
                                <th>Punch Out</th>
                                <th>Production</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $item)
                            <tr>
                                <td>{{$item['user_name']}}</td>
                                <td>{{Carbon::parse($item['present_date'])->format('d M Y')}}</td>
                                <td>{{Carbon::parse($item['first_punch'])->format('h:m A')}}</td>
                                <td>{{Carbon::parse($item['last_punch'])->format('h:m A')}}</td>
                                <td>{{$item['time_difference']}}</td>
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
    @include('layouts.member_sidebar')
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            let timer;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.punch-btn').click(function() {
                let htmlLi = '';
                let element = $(this);
                let action = element.attr('data-action');

                $.ajax({
                    url: '{{ route('punch.status') }}',
                    type: 'post',
                    data: {
                        status: action
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
                        startTime = moment().subtract({
                            hours: res['begin_hours'],
                            minutes: res['begin_mins'],
                            seconds: res['begin_seconds']
                        });
                        if (res['punch'] == 1 && res['status'] == true) {
                            startTimer()
                            Toast.fire({
                                icon: "success",
                                title: "Punched In Successfully",
                                text:"Please Remember To Punch Out When you Check Out"
                            });

                        } else if (res['punch'] == 0 && res['status'] == true) {
                            stopTimer();
                            Toast.fire({
                                icon: "success",
                                title: "Punched Out Successfully"
                            });

                        }
                        res['attendance'].forEach((val) => {
                            if (val.punch_status == 1) {
                                htmlLi +=
                                    `<li>Punch In At <br> ${moment(val.created_at).format('h:mm A')}`
                            } else {
                                htmlLi +=
                                    `<li>Punch Out At <br> ${moment(val.created_at).format('h:mm A')}`
                            }
                            $('.res-activity-list').html(htmlLi);
                        });

                        if (res['punch'] == 1) {
                            $('.punch-btn').text('Punch Out');
                            element.attr('data-action', 0);
                        } else {
                            $('.punch-btn').text('Punch In');
                            element.attr('data-action', 1);
                        }

                    }
                });
            });

            var startTime = moment().subtract({
                hours: '{{ $begin_hours }}',
                minutes: '{{ $begin_mins }}',
                seconds: '{{ $begin_seconds }}'
            });

            function startTimer() {
                timer = setInterval(updateTimer, 1000); // Update every second
            }

            function stopTimer() {
                clearInterval(timer)
            }

            function updateTimer() {
                const currentTime = moment();
                const elapsedTime = moment.duration(currentTime.diff(startTime));

                hours = Math.floor(elapsedTime.asHours());
                minutes = Math.floor(elapsedTime.minutes());
                seconds = Math.floor(elapsedTime.seconds());


                $('#timerValue').text(
                    `0${hours}:${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`
                );
            }

            @if ($punch == 1)
                startTimer()
            @endif
        });
    </script>
@endpush
