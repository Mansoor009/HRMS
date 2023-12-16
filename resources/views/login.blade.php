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
    <title>Laravel-Login</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css') }}">
    <title>Registration Form</title>

</head>
<style>
    .fe-eye {
        cursor: pointer;
        border-radius: 0 4px 4px 0 !important;
    }
</style>

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
                                    1500s, when an unknown printer took a galley of type and scrambled it to make a type
                                    specimen book.</p>
                                <a href="index.html" class="btn btn-success">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="sign-up-body wd-md-50p">
                        <div class="main-signin-header">
                            <h2>Welcome back!</h2>
                            <h4>Please Log In to continue</h4>
                            <form id="loginForm">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter your Email" type="text"
                                        id="email" name="email">
                                    <span class="email_error error"></span>
                                </div>
                                <div class="input-group mb-3">
                                    <input class="form-control" placeholder="Enter your Password" type="password"
                                        id="password" name="password">
                                    <i class="input-group-text fe fe-eye"></i>
                                    <span class="password_error error"></span>
                                </div>
                                <button class="btn btn-primary btn-block" type="submit">Log In</button>
                            </form>
                        </div>
                        <div class="main-signin-footer mt-3 mg-t-5">
                            <p><a href="{{ route('forgotPassword') }}">Forgot password?</a></p>
                            <p>Don't have an account? <a href="{{ route('register') }}">Create an Account</a></p>
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

        $("#loginForm").validate({
            rules: {
                email: "required",
                // password: "required"
            },
            submitHandler: function() {
                let data = $("#loginForm").serialize()
                $('.error').text('');
                $.ajax({
                    url: '{{ route('login.url') }}',
                    type: "post",
                    data: data,
                    success: function(res) {
                        // let response = jQuery.parseJSON(res);
                        console.log(res.status);
                        if (res.status == "denied") {
                            Swal.fire({
                                icon: "warning",
                                title: "Oops...",
                                text: "Your Account is De-Activated",
                            });
                        } else if (res.status == false) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Wrong Credentials, Please Try Again!",
                            });
                        } else if (res.status == "admin") {
                            Swal.fire({
                                icon: "success",
                                title: "Admin logged in successfully",
                                text:"Please Remember to Logout Once Work is Done!"
                            });
                            setTimeout(() => {
                                window.location = '{{ route('admin.dashboard') }}';
                            }, 500);


                        }
                        else if (res.status == "member") {
                            Swal.fire({
                                icon: "success",
                                title: "Member logged in successfully",
                                text:"Please Remember to Logout Once Work is Done!",
                            });
                            setTimeout(() => {
                                window.location = '{{ route('member.dashboard') }}';
                            }, 500);

                        }

                    },
                    error: function(xhr) {
                        $.each(xhr.responseJSON.errors, function(index, message) {
                            $(`.${index}_error`).text(message[0]).css('color', 'red');
                        });
                        if (xhr.responseJSON.status == false) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Wrong Credentials, Please Try Again!",
                            });
                        }
                    }
                });
            }
        });

        let eyePass = document.querySelector('.fe-eye');
        let inputPass = document.querySelector('#password')
        eyePass.addEventListener('click', function() {
            if (this.classList.contains('fe-eye')) {
                this.classList.remove('fe-eye');
                this.classList.add('fe-eye-off');
                inputPass.type = 'text'
            } else {
                this.classList.add('fe-eye');
                this.classList.remove('fe-eye-off');
                inputPass.type = 'password'
            }

        });
    </script>
</body>

</html>
