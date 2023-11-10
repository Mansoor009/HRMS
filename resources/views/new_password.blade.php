<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords"
        content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4" />
    <!-- Title -->
    <title>Laravel-Fogot Password</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css') }}">
    <title>Registration Form</title>

</head>

<body class="main-body bg-light  login-img">

    <!-- Loader -->
    <div id="global-loader">
        <img src="assets/img/loaders/loader-4.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->

    <!-- page -->
    <div class="page">
        <!-- main-signin-wrapper -->
        <div class="my-auto page page-h">
            <div class="main-signin-wrapper">
                <div class="main-card-signin d-md-flex">
                    <div class="wd-md-50p login d-none d-md-block page-signin-style p-5 text-white">
                        <div class="my-auto authentication-pages">
                            <div>
                                <img src="assets/img/brand/logo-white.png" class=" m-0 mb-4" alt="logo">
                                <h5 class="mb-4">Responsive Modern Dashboard &amp; Admin Template</h5>
                                <p class="mb-5">Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                                    1500s.</p>
                            </div>
                        </div>
                    </div>
                    <div class="sign-up-body wd-md-50p">
                        <div class="main-signin-header">
                            <h2>Forgot Password</h2>
                            <h4>Please Fill This Field For Fresh Password</h4>
                            <form id="newPass">
                                <input type="text" hidden value="{{ $token }}">
                                <div class="form-group">
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="{{ $email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter New Password" type="password"
                                        id="password" name="password">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Confirm Password" type="password"
                                        id="password_confirmation" name="password_confirmation">
                                </div>
                                <button class="btn btn-primary btn-block" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page closed -->
    <!-- /main-signin-wrapper -->

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/ionicons/ionicons.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/js/eva-icons.min.js') }}"></script>
    <script src="{{ asset('assets/js/themecolor.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ 'https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js' }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#newPass").validate({
            submitHandler: function() {
                let data = $("#newPass").serialize()
                $.ajax({
                    url: '{{ route('reset.password.post') }}',
                    type: "post",
                    data: data,
                    beforeSend: function() {
                       $('.btn').html('Processing your password reset...')
                    },
                    success: function(res) {
                        if (res.status === true) {
                            Swal.fire({
                                icon: "success",
                                title: "Password Has Been Changed",
                            });
                            setTimeout(() => {
                                window.location = '{{ route('login', 'token') }}';
                            }, 500);
                        }
                    },
                    error:function(error){
                        console.log(error)
                            def = error.responseJSON.errors;
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: `${def.password[0]}`,
                            });
                    },
                    complete:function(){
                        $('.btn').html('Submit')
                    }
                });
            }
        });
    </script>
</body>

</html>
