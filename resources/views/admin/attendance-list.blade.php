@php
    use Carbon\Carbon;
@endphp
@extends('layouts.master_layout')
@section('title', 'Attendance List')

@push('style')
    <style>
        table {
            background-color: white;
        }

        .fa-xmark:before {
            content: "\f00d";
        }

        .fa-check:before {
            cursor: pointer;
        }
        .header {
            color: white;
            margin: 20px 0;
        }
    </style>
@endpush

@section('section')
    <section class="attendance-list-wrapper">
        <div class="container">
            <div class="header">
                <h3>Attendance</h3>
                <h6>Dashboard / Attendance</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-striped table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                @php
                                    $numberOfDays = cal_days_in_month(CAL_GREGORIAN, 1, 2024);
                                @endphp
                                @for ($i = 1; $i <= $numberOfDays; $i++)
                                    <th data-val = '{{ $i }}'>{{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($list as $attend)
                                <tr>
                                    <td>{{ $attend['id'] }}</td>
                                    <td>{{ $attend['user_name'] }}</td>
                                    @for ($i = 1; $i <= $numberOfDays; $i++)
                                        @php
                                            $make_date = date('Y-m-d', strtotime("2024-1-$i"));
                                            $attendance_for_day = '-';
                                            foreach ($attend['attendance'] as $att) {
                                                $att_date = date('Y-m-d', strtotime($att['present_day']));
                                                if ($att_date == $make_date) {
                                                    if ($att['time_difference'] > 28800) {
                                                        $attendance_for_day = '<i class="fa fa-regular fa-check" style="color: #21ba33;" data-id=' . $attend['id'] . ' data-val = ' . $make_date . '></i>';
                                                        break;
                                                    } else {
                                                        $attendance_for_day = '<i class="fa fa-regular fa-check" style="color: #21ba33;" data-id=' . $attend['id'] . ' data-val = ' . $make_date . '></i> <i class="fa fa-regular fa-xmark" style="color: #ff0000;"></i>';
                                                        break;
                                                    }
                                                } else {
                                                    $attendance_for_day = '<i class="fa fa-regular fa-xmark" style="color: #ff0000;"></i>';
                                                }
                                            }
                                        @endphp
                                        <td>
                                            {!! $attendance_for_day !!}
                                        </td>
                                    @endfor
                                </tr>
                            @empty
                                <tr>
                                    <td>No Salesman</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('sidebar')
    @include('layouts.admin_sidebar')
@endsection

@push('script')
    <script>
        $('.fa-check').click(function(e) {
            let id = $(this).data('id');
            let date = $(this).data('val');
            $.ajax({
                type: "get",
                url: '{{ route('emp.duration', '') }}' + "/" + id,
                data: {
                    date: date,
                },
                success: function(response) {
                    console.log(response);
                }
            });
        });
    </script>
@endpush
