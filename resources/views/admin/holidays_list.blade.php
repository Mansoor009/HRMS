@extends('layouts.master_layout')
@section('title', 'Admin - Holidays')
@push('style')
    <style>
        .holiday-cover table {
            background-color: white;
        }
    </style>
@endpush

@section('section')
    <div class="holiday-table-wrapper">
        <div class="container">
            <div class="holiday-cover">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-striped table-bordered table-lg-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Holiday Title</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                    <tr>
                                        <td>{{ $item['id'] }}</td>
                                        <td>{{ $item['title'] }}</td>
                                        <td>{{ $item['date'] }}</td>
                                        <td><select name="status" id="status" class="status form-select"
                                                data-id="{{ $item['id'] }}">
                                                <option value="1" {{ $item['status'] == 1 ? 'selected' : '' }}>Holiday
                                                </option>
                                                <option value="0" {{ $item['status'] == 0 ? 'selected' : '' }}>No
                                                    Holiday</option>
                                            </select>
                                        </td>
                                        <td><button class="btn btn-info editBtn" data-id='{{ $item['id'] }}'>Edit</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-3">
                        <div class="adding-holidays">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary holidayBtn" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                +Add Holidays
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
                                                    <label for="title" class="form-label">Holiday Title</label>
                                                    <input type="text" class="form-control" id="title"
                                                        name='title'>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="date" class="form-label">Holiday Date</label>
                                                    <input type="date" class="form-control" id="date"
                                                        name="date">
                                                </div>
                                                <input type="hidden" name="id" id="id">
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
    </div>
@endsection

@section('sidebar')
    @include('layouts.admin_sidebar')
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.status').change(function() {
                let id = $(this).data('id');
                let val = $(this).val();
                $.ajax({
                    url: '{{ route('admin.holiday.status') }}',
                    type: 'post',
                    data: {
                        id: id,
                        val: val
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
                        Toast.fire({
                            icon: "success",
                            title: "Holiday Status Changed"
                        });
                    }
                })
            });

            $('.holidayBtn').click(function() {
                $('#title').val('');
                $('#date').val('');
                $('#id').val('');
            });

            $('.editBtn').click(function() {
                let id = $(this).data('id');
                $.ajax({
                    url: '{{ route('admin.holiday.edit', '') }}' + "/" + id,
                    type: 'get',
                    success: function(res) {
                        response = res.update[0];
                        console.log(response);
                        $('#title').val(response.title);
                        $('#date').val(response.date);
                        $('#id').val(response.id);
                        $('#exampleModal').modal('show');
                    }
                });
            });

            $('#leave-application').validate({
                submitHandler: function() {
                    let data = $('#leave-application').serialize();
                    $.ajax({
                        url: '{{ route('admin.holiday.controll') }}',
                        type: 'post',
                        data: data,
                        success: function(res) {
                            Swal.fire({
                                icon: "success",
                                title: "List Updated",
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 250 );
                        }
                    })
                }
            });

        });
    </script>
@endpush
