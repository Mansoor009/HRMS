
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
            <h2>Send Notification</h2>
            <h5>Dashboard / Leave</h5>
        </div>
        <div class="notification-form-cover">
            <form id="send-notification" name="send-notification">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Message Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Message Body</label>
                            <textarea class="form-control" name="body"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Send Notification</button>
                </div>
            </form>
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

            $('#send-notification').validate({
                rules: {
                    title: "required",
                    desc: "required",
                },
                submitHandler: function() {
                    let data = $('#send-notification').serialize();
                    $.ajax({
                        url: '<?php echo e(route('send.notification')); ?>',
                        type: 'get',
                        data: data,
                        success: function(res) {
                            if (res.status) {
                                Swal.fire({
                                    icon: "success",
                                    title: res.message,
                                }).then((result) => {

                            });
                            }
                        }

                    });
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\HRMS\resources\views\member\send-notification.blade.php ENDPATH**/ ?>