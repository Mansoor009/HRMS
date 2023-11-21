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
            height: 328px;
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
                            <h6>First Punch In at</h6>
                            <p>
                                <?php
                                if (isset($firstPunchIn)) {
                                    echo $firstPunchIn;
                                } else {
                                    echo 'Not Checked Today';
                                }
                                ?>
                            </p>
                        </div>
                        <div class="punch-info">
                            <div class="punch-hours">
                                <span class="punchDiff">
                                    00:00:00
                                </span>
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
                                    <li>Punch In at <br>{{ $val->created_at }}</li>
                                @else
                                    <li>Punch Out at <br>{{ $val->created_at }}</li>
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
                                <th>#</th>
                                <th>Date </th>
                                <th>Punch In</th>
                                <th>Punch Out</th>
                                <th>Production</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>19 Feb 2019</td>
                                <td>10 AM</td>
                                <td>7 PM</td>
                                <td>9 hrs</td>
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
            var totalElapsedTime = 0;
            var previousTime
            $('.punch-btn').click(function() {
                let htmlLi = '';
                let element = $(this);
                let action = element.attr('data-action');
                // let startT = moment('');
                // let endT = moment('{{ $lastPunchOut }}');
                // let duration = moment.duration(endT.diff(startT));
                // $('.punchDiff').html(
                //     `${duration.hours()}:${duration.minutes()}:${duration.seconds()} hrs`
                // );
                $.ajax({
                    url: '{{ route('punch.status') }}',
                    type: 'post',
                    data: {
                        status: action
                    },
                    success: function(res) {
                        console.log(res)
                        if (res['punch'] == 1 && res['status'] == true) {
                            // notif({
                            //     msg: 'Punched In Succesfully!',
                            //     type: 'success',
                            //     fontSize: '23px',
                            // });
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
                            Toast.fire({
                                icon: "success",
                                title: "Punched In Successfully"
                            });

                        } else if (res['punch'] == 0 && res['status'] == true) {
                            // notif({
                            //     type: 'success',
                            //     msg: 'Punched Out Succesfully!',
                            //     fontSize: '23px',

                            // });
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
                            Toast.fire({
                                icon: "success",
                                title: "Punched Out Successfully"
                            });

                        }
                        res['attendance'].forEach((val) => {
                            if (val.punch_status == 1) {
                                htmlLi +=
                                    `<li>Punch In At <br> ${val.created_at}`
                            } else {
                                htmlLi +=
                                    `<li>Punch Out At <br> ${val.created_at}`
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
        });
    </script>


    <!-- Display live timer and punch-in/punch-out button -->
    <div>
        <div id="liveTimer"></div>
        <button onclick="togglePunch()">Punch In/Out</button>
    </div>

    {{-- <script>
    var isPunchedIn = false;
    var totalElapsedTime = 0;
    var previousTime;

    // Function to update the live timer
    function updateLiveTimer() {
        var liveTimerElement = document.getElementById('liveTimer');

        if (isPunchedIn) {
            var currentTime = moment();

            // Calculate the time difference since the previous update
            var elapsedTime = moment.duration(currentTime.diff(previousTime || currentTime));
            totalElapsedTime += elapsedTime.asMilliseconds();

            // Format the total elapsed time as desired
            var formattedTime = moment.utc(totalElapsedTime).format('HH:mm:ss');

            // Update the content of the live timer element
            liveTimerElement.innerText = "Total Elapsed Time: " + formattedTime;

            // Store the current time as the previous time for the next update
            previousTime = currentTime;
        } else {
            liveTimerElement.innerText = "Not Punched In";
        }
    }

    // Function to toggle punch-in/punch-out status
    function togglePunch() {
        var currentTime = moment();

        if (isPunchedIn) {
            // If punched in, punch out
            isPunchedIn = false;
        } else {
            // If not punched in, punch in
            isPunchedIn = true;
            previousTime = currentTime;
        }
    }

    // Update the live timer every second (1000 milliseconds) if punched in
    setInterval(function() {
        if (isPunchedIn) {
            updateLiveTimer();
        }
    }, 1000);

    // Initialize the live timer when the page loads
    window.onload = function() {
        updateLiveTimer();
    };
</script> --}}
@endpush
