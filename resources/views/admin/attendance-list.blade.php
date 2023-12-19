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
                                @for ($i = 1; $i <= 31; $i++)
                                    <th >{{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail as $item)
                                <tr>
                                    <td scope="col">{{ $item->id }}</td>
                                    <td>{{ $item->user_name }}</td>
                                    @foreach ($attendance as $list)
                                        @if ($item->id == $list->user_id)
                                            <th>{{$list->user_name}}</th>
                                        @else
                                            <th></th>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
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

    </script>
@endpush
