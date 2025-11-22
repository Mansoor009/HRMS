
<?php $__env->startSection('title', 'Leave Dashboard'); ?>
<?php $__env->startPush('style'); ?>
    <style>
        .member-head {
            color: white;
        }

        .table-cover table {
            background-color: white;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('section'); ?>
    <div class="content container-fluid">
        <div class="member-head">
            <h2>Leave</h2>
            <h5>Dashboard / Leave</h5>
        </div>
        <div class="table-cover">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-striped table-responsive-lg">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Leave Title</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <th scope="col">Description</th>
                                <th scope="col">Leave Status</th>
                                <th scope="col">Leave Type</th>
                                <th scope="col">No. Of Days</th>
                                <th scope="col">Reject Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $leave_records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    switch ($record['leave_type']) {
                                        case SICK_LEAVE:
                                            $type = 'Sick Leave';
                                            break;
                                        case PAID_LEAVE:
                                            $type = 'Paid Leave';
                                            break;
                                        case FESTIVE_LEAVE:
                                            $type = 'Festive Leave';
                                            break;
                                        default:
                                            $type = 'Unknown Leave Type';
                                    }
                                    switch ($record['status']) {
                                        case '1':
                                            $status = 'Approved';
                                            break;
                                        case '0':
                                            $status = 'Rejected';
                                            break;
                                        default:
                                            $status = 'Pending';
                                            break;
                                    }
                                ?>

                                <tr>
                                    <td scope='col'><?php echo e($record['id']); ?></td>
                                    <td scope='col'><?php echo e($record['title']); ?></td>
                                    <td scope='col'><?php echo e($record['from_leave']); ?></td>
                                    <td scope='col'><?php echo e($record['to_leave']); ?></td>
                                    <td scope='col'><?php echo e($record['description']); ?></td>
                                    <td scope='col'><?php echo e($status); ?></td>
                                    <td scope='col'><?php echo e($type); ?></td>
                                    <td scope='col'><?php echo e($record['no_of_days']); ?></td>
                                    <td scope='col'><?php echo e($record['reject_reason']); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-3">
                    <div class="leave-application">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Leave Application
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
                                                <label for="title" class="form-label">Leave Title</label>
                                                <input type="text" class="form-control" id="title" name='title'>
                                            </div>
                                            <div class="mb-1">
                                                <select class="form-select select" name="select" id="select"
                                                    data-id='<?php echo e($id); ?>'>
                                                    <option selected>Leave Account</option>
                                                    <option data-bal="<?php echo e($leave_count[0]['sick_leave']); ?>"
                                                        value="<?php echo e($sick); ?>">Sick
                                                        Leave</option>
                                                    <option data-bal="<?php echo e($leave_count[0]['paid_leave']); ?>"
                                                        value="<?php echo e($paid); ?>">Paid
                                                        Leave</option>
                                                    <option data-bal="<?php echo e($leave_count[0]['festive_leave']); ?>"
                                                        value="<?php echo e($festive); ?>">
                                                        Festive Leave</option>
                                                </select>
                                            </div>
                                            <span class="check_account"></span>
                                            <div class="mb-3">
                                                <label for="from" class="form-label">From</label>
                                                <input type="date" class="form-control" id="from" name="from">
                                            </div>
                                            <div class="mb-3">
                                                <label for="to" class="form-label">To</label>
                                                <input type="date" class="form-control" id="to" name="to">
                                            </div>
                                            <div class="mb-3">
                                                <label for="desc" class="form-label">Add Description</label>
                                                <textarea class="form-control" id="desc" rows="3" name="desc"></textarea>
                                            </div>
                                            <input type="hidden" name="user_id" id="user_id">
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('layouts.member_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.select').change(function() {
                let selectVal = $('.select option:selected').val();
                $.ajax({
                    url: '<?php echo e(route('select.val')); ?>',
                    type: 'post',
                    beforeSend: function() {
                        $('.check_account').html('Loading....').css('color', 'black')
                    },
                    success: function(res) {
                        let leaveType, leaveCount;
                        if (selectVal == 1) {
                            leaveCount = res['account'][0].sick_leave;
                            leaveType = 'Sick';
                        } else if (selectVal == 2) {
                            leaveCount = res['account'][0].paid_leave;
                            leaveType = 'Paid';
                        } else if (selectVal == 3) {
                            leaveCount = res['account'][0].festive_leave;
                            leaveType = 'Festive';
                        } else {
                            leaveCount = 0;
                            leaveType;
                        }
                        const message = `${leaveCount} ${leaveType} Leave Available`;
                        $('.check_account').html(message).css('color', leaveCount > 0 ?
                            'green' :
                            'red');
                    }
                });
            });

            $('#leave-application').validate({
                rules: {
                    title: "required",
                    from: "required",
                    to: "required",
                },
                submitHandler: function() {
                    let data = $('#leave-application').serialize();
                    $.ajax({
                        url: '<?php echo e(route('leave.dashboard.controll')); ?>',
                        type: 'post',
                        data: data,
                        success: function(res) {
                            if (res['status'] == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Leave Recorded Successfully",
                                    text: "Leave request submitted successfully. You will be notified of the status soon. Thank you for your cooperation"
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 1300);
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Your Leave Balance is Exceeding",
                                    text: "Leave request Denied. Your Leave Limit is Exceeding, Therefore We can't Send your Request"
                                });
                            }
                        }

                    });
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\HRMS\resources\views\member\leave_dash.blade.php ENDPATH**/ ?>