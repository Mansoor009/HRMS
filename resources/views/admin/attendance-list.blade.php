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
                    <table class="table table-striped table-bordered table-lg-responsive">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Employee</th>
                                <th scope="col">Check In</th>
                                <th scope="col">Check Out</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendance as $item)
                                <tr>
                                    <td scope="col">{{ $item->id }}</td>
                                    <td scope="col">{{ $item->user_name }}</td>
                                    <td scope="col">{{ $item->first_punch }}</td>
                                    <td scope="col">{{ $item->last_punch }}</td>
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
    <script></script>
@endpush
