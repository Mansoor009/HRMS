<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

<body class="main-body  login-img">
    <!-- Loader -->
    <div id="global-loader">
        <img src="assets/img/loaders/loader-4.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->

    <!-- page -->
    <div class="page">
        <div class="m-3">

        </div>
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
                                <a href="index.html" class="btn btn-success">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="sign-up-body wd-md-50p">
                        <div class="main-signin-header">
                            <h2>Welcome</h2>
                            <h4>Please Register with Azira</h4>
                            <form id="submitForm">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control " placeholder="Enter your Username " type="text"
                                        id="user_name" name="user_name">
                                    <span class="user_name_error error"></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter your Email" type="email"
                                        id="email" name="email">
                                    <span class="email_error error"></span>
                                </div>
                                <div class="input-group mb-3">
                                    <input class="form-control" placeholder="Enter your Password" type="password"
                                        id="password" name="password">
                                    <i class="input-group-text fe fe-eye"></i>
                                    <span class="password_error error"></span>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter your Mobile Number" type="text"
                                        id="mobile_number" name="mobile_number">
                                    <span class="mobile_number_error error"></span>
                                </div>
                                <button class="btn btn-primary btn-block createBtn">Create Account</button>
                            </form>
                        </div>
                        <div class="main-signup-footer mg-t-10">
                            <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- page closed -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/ionicons/ionicons.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/p-scroll.js') }}"></script>
    <script src="{{ asset('assets/js/eva-icons.min.js') }}"></script>
    <script src="{{ asset('assets/js/themecolor.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ 'https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js' }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let eyePass = document.querySelector('.fe-eye');
        let inputPass = document.querySelector('#password')
        eyePass.addEventListener('click', function() {
            if (this.classList.contains('fe-eye')) {
                this.classList.remove('fe-eye');
                this.classList.add('fe-eye-off');
                inputPass.type = 'text';
            } else {
                this.classList.add('fe-eye');
                this.classList.remove('fe-eye-off');
                inputPass.type = 'password';
            }

        })
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $("#submitForm").validate({
                submitHandler: function() {
                    let data = $("#submitForm").serialize();
                    $('.error').text('');
                    $.ajax({
                        url: '{{ route('register.url') }}',
                        type: "post",
                        data: data,
                        beforeSend: function() {
                            $('.createBtn').html('Please Wait.....')
                        },
                        success: function(res) {
                            if (res.status === true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "You are successfully Registered!",
                                });
                                setTimeout(() => {
                                    window.location = '{{ route('login') }}'
                                }, 500);

                            }
                        },
                        error: function(xhr) {
                            $.each(xhr.responseJSON.errors, function(index, message) {
                                $(`.${index}_error`).text(message[0]).css('color',
                                    'red');
                            });
                        },
                        complete: function() {
                            $('.createBtn').html('Create Account')
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
