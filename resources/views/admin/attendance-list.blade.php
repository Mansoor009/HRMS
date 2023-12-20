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
    </style>
@endpush

@section('section')
    <section class="attendance-list-wrapper">
        <div class="container">
            <div class="header">

            </div>
            <div class="row">
                <div class="col-lg-12">
                    {{-- <table class="table table-striped table-bordered table-lg-responsive">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Employee</th>
                                <th scope="col">Date</th>
                                <th scope="col">Check In</th>
                                <th scope="col">Check Out</th>
                                <th scope="col">Production</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendance as $item)
                                <tr>
                                    <td scope="col">{{ $item->id }}</td>
                                    <td>{{ $item['user_name'] }}</td>
                                    <td>{{ Carbon::parse($item['present_date'])->format('d M Y') }}</td>
                                    <td>{{ Carbon::parse($item['first_punch'])->format('h:i A') }}</td>
                                    <td>{{ $item['last_punch'] == null ? '' : Carbon::parse($item['last_punch'])->format('h:i A') }}
                                    </td>
                                    <td>{{ $item['time_difference'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> --}}
                    <table class="table table-striped table-bordered table-responsive">
                        <thead>

                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                @php
                                    $numberOfDays = cal_days_in_month(CAL_GREGORIAN, 12, 2023);
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
                                            $make_date = date('Y-m-d', strtotime("2023-12-$i"));
                                            $found_match = false;
                                            $attendance_for_day = '-';
                                            foreach ($attend['attendance'] as $att) {
                                                $att_date = date('Y-m-d', strtotime($att['present_day']));
                                                if ($att_date == $make_date) {
                                                    if ($att['time_difference'] > 28800) {
                                                        $attendance_for_day = 'P';
                                                        break;
                                                    } else {
                                                        $attendance_for_day = 'H';
                                                        break;
                                                    }
                                                } else {
                                                    $attendance_for_day = 'A';
                                                }
                                            }
                                        @endphp
                                        <td>
                                            {{ $attendance_for_day }}
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
    <script></script>
@endpush
