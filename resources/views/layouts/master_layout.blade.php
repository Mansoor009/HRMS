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
    <title>Laravel - @yield('title', 'website')</title>
    @stack('style')
</head>
<style>

</style>

<body class="main-body app sidebar-mini ltr">
    <!-- Loader -->
    <div id="global-loader">
        <img src="assets/img/loaders/loader-4.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->
<div class="page custom-index">
<!-- main-header -->
<div class="main-header side-header sticky nav nav-item">
<div class="container-fluid main-container ">
    <div class="main-header-left ">
        <div class="app-sidebar__toggle mobile-toggle" data-bs-toggle="sidebar">
            <a class="open-toggle" href="javascript:void(0);"><i class="header-icons" data-eva="menu-outline"></i></a>
            <a class="close-toggle" href="javascript:void(0);"><i class="header-icons" data-eva="close-outline"></i></a>
        </div>
        <div class="responsive-logo">
            <a href="index.html" class="header-logo"><img src="assets/img/brand/logo.png" class="logo-11"></a>
            <a href="index.html" class="header-logo"><img src="assets/img/brand/logo-white.png" class="logo-1"></a>
        </div>
        <ul class="header-megamenu-dropdown  nav">
            <li class="nav-item">
                <div class="btn-group dropdown">
                    <button aria-expanded="false" aria-haspopup="true" class="btn btn-link dropdown-toggle" data-bs-toggle="dropdown" id="dropdownMenuButton2" type="button"><span><i class="fe fe-settings"></i> Settings </span></button>
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-header header-img p-3">
                            <div class="drop-menu-inner">
                                <div class="header-content text-start d-flex">
                                    <div class="text-white">
                                        <h5 class="menu-header-title">Setting</h5>
                                        <h6 class="menu-header-subtitle mb-0">Overview of theme</h6>
                                    </div>
                                    <div class="my-auto ms-auto">
                                        <span class="badge bg-pill bg-warning float-end">View all</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="setting-scroll">
                            <div>
                                <div class="setting-menu ">
                                    <a class="dropdown-item" href="profile.html"><i class="mdi mdi-account-outline tx-16 me-2 mt-1"></i>Profile</a>
                                    <a class="dropdown-item" href="contacts.html"><i class="mdi mdi-account-box-outline tx-16 me-2"></i>Contacts</a>
                                    <a class="dropdown-item" href="settings.html"><i class="mdi mdi-account-location tx-16 me-2"></i>Accounts</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="about.html"><i class="typcn typcn-briefcase tx-16 me-2"></i>About us</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="mdi mdi-application tx-16 me-2"></i>Getting start</a>
                                </div>
                            </div>
                        </div>
                        <ul class="setting-menu-footer flex-column ps-0">
                            <li class="divider mb-0 pb-0 "></li>
                            <li class="setting-menu-btn">
                                <button class=" btn-shadow btn btn-success btn-sm">Cancel</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <div class="dropdown-menu-rounded btn-group dropdown">
                    <button aria-expanded="false" aria-haspopup="true" class="btn btn-link dropdown-toggle" data-bs-toggle="dropdown" id="dropdownMenuButton3" type="button"><span><i class="nav-link-icon fe fe-briefcase"></i> Projects </span></button>
                    <div class="dropdown-menu-lg dropdown-menu" x-placement="bottom-left">
                        <div class="dropdown-menu-header">
                            <div class="dropdown-menu-header-inner header-img p-3">
                                <div class="header-content text-start d-flex">
                                    <div class="text-white">
                                        <h5 class="menu-header-title">Projects</h5>
                                        <h6 class="menu-header-subtitle mb-0">Overview of Projects</h6>
                                    </div>
                                    <div class="my-auto ms-auto">
                                        <span class="badge bg-pill bg-warning float-end">View all</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="dropdown-item  mt-2" href="javascript:void(0);"><i class="dropdown-icon"></i>Mobile Application</a>
                        <a class="dropdown-item" href="javascript:void(0);"><i class="dropdown-icon"></i>PSD Projects</a>
                        <a class="dropdown-item" href="javascript:void(0);"><i class="dropdown-icon"></i>PHP Project</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0);"><i class="dropdown-icon"></i>Wordpress Projects</a>
                        <a class="dropdown-item mb-2" href="javascript:void(0);"><i class="dropdown-icon "></i>HTML & CSS3 Projects</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <button class="navbar-toggler nav-link icon navresponsive-toggler vertical-icon ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
    </button>
    <div class="mb-0 navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0  mg-lg-s-auto">
        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <div class="main-header-right">
                <div class="nav nav-item nav-link" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button type="reset" class="btn btn-default">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button type="submit" class="btn btn-default nav-link">
                                    <i class="fe fe-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                <li class="dropdown nav-item main-layout">
                    <a class="new theme-layout nav-link-bg layout-setting">
                        <span class="dark-layout"><i class="fe fe-moon"></i></span>
                        <span class="light-layout"><i class="fe fe-sun"></i></span>
                    </a>
                </li>
                <div class="nav nav-item  navbar-nav-right mg-lg-s-auto">
                    <div class="nav-item full-screen fullscreen-button">
                        <a class="new nav-link full-screen-link" href="javascript:void(0);"><i class="fe fe-maximize"></i></span></a>
                    </div>
                    <div class="dropdown  nav-item main-header-message ">
                        <a class="new nav-link" href="javascript:void(0);"><i class="fe fe-mail"></i><span class=" pulse-danger"></span></a>
                        <div class="dropdown-menu">
                            <div class="menu-header-content bg-primary-gradient text-start d-flex">
                                <div class="">
                                    <h6 class="menu-header-title text-white mb-0">5 new Messages</h6>
                                </div>
                                <div class="my-auto mg-s-auto">
                                    <a class="badge bg-pill bg-warning float-end" href="javascript:void(0);">Mark All Read</a>
                                </div>
                            </div>
                            <div class="main-message-list chat-scroll">
                                <a href="mail.html" class="p-3 d-flex border-bottom">
                                    <div class="drop-img  cover-image  " data-bs-image-src="assets/img/faces/3.jpg">
                                        <span class="avatar-status bg-teal"></span>
                                    </div>

                                    <div class="wd-90p">
                                        <div class="d-flex">
                                            <h5 class="mb-1 name">Paul Molive</h5>
                                            <p class="time mb-0 text-end ms-auto float-end">10 min ago</p>
                                        </div>
                                        <p class="mb-0 desc">I'm sorry but i'm not sure how...</p>
                                    </div>
                                </a>
                                <a href="mail.html" class="p-3 d-flex border-bottom">
                                    <div class="drop-img cover-image" data-bs-image-src="assets/img/faces/2.jpg">
                                        <span class="avatar-status bg-teal"></span>
                                    </div>
                                    <div class="wd-90p">
                                        <div class="d-flex">
                                            <h5 class="mb-1 name">Sahar Dary</h5>
                                            <p class="time mb-0 text-end ms-auto float-end">13 min ago</p>
                                        </div>
                                        <p class="mb-0 desc">All set ! Now, time to get to you now......</p>
                                    </div>
                                </a>
                                <a href="mail.html" class="p-3 d-flex border-bottom">
                                    <div class="drop-img cover-image" data-bs-image-src="assets/img/faces/9.jpg">
                                        <span class="avatar-status bg-teal"></span>
                                    </div>
                                    <div class="wd-90p">
                                        <div class="d-flex">
                                            <h5 class="mb-1 name">Khadija Mehr</h5>
                                            <p class="time mb-0 text-end ms-auto float-end">20 min ago</p>
                                        </div>
                                        <p class="mb-0 desc">Are you ready to pickup your Delivery...</p>
                                    </div>
                                </a>
                                <a href="mail.html" class="p-3 d-flex border-bottom">
                                    <div class="drop-img cover-image" data-bs-image-src="assets/img/faces/12.jpg">
                                        <span class="avatar-status bg-danger"></span>
                                    </div>
                                    <div class="wd-90p">
                                        <div class="d-flex">
                                            <h5 class="mb-1 name">Barney Cull</h5>
                                            <p class="time mb-0 text-end ms-auto float-end">30 min ago</p>
                                        </div>
                                        <p class="mb-0 desc">Here are some products ...</p>
                                    </div>
                                </a>
                                <a href="mail.html" class="p-3 d-flex border-bottom">
                                    <div class="drop-img cover-image" data-bs-image-src="assets/img/faces/5.jpg">
                                        <span class="avatar-status bg-teal"></span>
                                    </div>
                                    <div class="wd-90p">
                                        <div class="d-flex">
                                            <h5 class="mb-1 name">Petey Cruiser</h5>
                                            <p class="time mb-0 text-end ms-auto float-end">35 min ago</p>
                                        </div>
                                        <p class="mb-0 desc">I'm sorry but i'm not sure how...</p>
                                    </div>
                                </a>
                            </div>
                            <div class="text-center dropdown-footer">
                                <a href="mail.html">VIEW ALL</a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown nav-item main-header-notification">
                        <a class="new nav-link" href="javascript:void(0);"><i class="fe fe-bell"></i><span class=" pulse"></span></a>
                        <div class="dropdown-menu">
                            <div class="menu-header-content bg-primary-gradient text-start d-flex">
                                <div class="">
                                    <h6 class="menu-header-title text-white mb-0">7 new Notifications</h6>
                                </div>
                                <div class="my-auto ms-auto">
                                    <a class="badge bg-pill bg-warning float-end" href="javascript:void(0);">Mark All Read</a>
                                </div>
                            </div>
                            <div class="main-notification-list Notification-scroll">
                                <a class="d-flex p-3 border-bottom" href="javascript:void(0);">
                                    <div class="notifyimg bg-success-transparent">
                                        <i class="la la-shopping-basket text-success"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="notification-label mb-1">New Order Received</h5>
                                        <div class="notification-subtext">1 hour ago</div>
                                    </div>
                                    <div class="ms-auto">
                                        <i class="las la-angle-right text-end text-muted"></i>
                                    </div>
                                </a>
                                <a class="d-flex p-3 border-bottom" href="javascript:void(0);">
                                    <div class="notifyimg bg-danger-transparent">
                                        <i class="la la-user-check text-danger"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="notification-label mb-1">22 verified registrations</h5>
                                        <div class="notification-subtext">2 hour ago</div>
                                    </div>
                                    <div class="ms-auto">
                                        <i class="las la-angle-right text-end text-muted"></i>
                                    </div>
                                </a>
                                <a class="d-flex p-3 border-bottom" href="javascript:void(0);">
                                    <div class="notifyimg bg-primary-transparent">
                                        <i class="la la-check-circle text-primary"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="notification-label mb-1">Project has been approved</h5>
                                        <div class="notification-subtext">4 hour ago</div>
                                    </div>
                                    <div class="ms-auto">
                                        <i class="las la-angle-right text-end text-muted"></i>
                                    </div>
                                </a>
                                <a class="d-flex p-3 border-bottom" href="javascript:void(0);">
                                    <div class="notifyimg bg-pink-transparent">
                                        <i class="la la-file-alt text-pink"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="notification-label mb-1">New files available</h5>
                                        <div class="notification-subtext">10 hour ago</div>
                                    </div>
                                    <div class="ms-auto">
                                        <i class="las la-angle-right text-end text-muted"></i>
                                    </div>
                                </a>
                                <a class="d-flex p-3 border-bottom" href="javascript:void(0);">
                                    <div class="notifyimg bg-warning-transparent">
                                        <i class="la la-envelope-open text-warning"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="notification-label mb-1">New review received</h5>
                                        <div class="notification-subtext">1 day ago</div>
                                    </div>
                                    <div class="ms-auto">
                                        <i class="las la-angle-right text-end text-muted"></i>
                                    </div>
                                </a>
                                <a class="d-flex p-3" href="javascript:void(0);">
                                    <div class="notifyimg bg-purple-transparent">
                                        <i class="la la-gem text-purple"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="notification-label mb-1">Updates Available</h5>
                                        <div class="notification-subtext">2 days ago</div>
                                    </div>
                                    <div class="ms-auto">
                                        <i class="las la-angle-right text-end text-muted"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer">
                                <a href="javascript:void(0);">VIEW ALL</a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown main-profile-menu nav nav-item nav-link">

                        <a class="profile-user d-flex" href=""><img src="assets/img/faces/6.jpg" alt="user-img" class="rounded-circle mCS_img_loaded"><span></span></a>

                        <div class="dropdown-menu">
                            <div class="main-header-profile header-img">
                                <div class="main-img-user"><img alt="" src="assets/img/faces/6.jpg"></div>
                                <h6>Petey Cruiser</h6><span>Premium Member</span>
                            </div>
                            <a class="dropdown-item" href="profile.html"><i class="far fa-user"></i> My Profile</a>
                            <a class="dropdown-item" href="profile.html"><i class="far fa-edit"></i> Edit Profile</a>
                            <a class="dropdown-item" href="profile.html"><i class="far fa-clock"></i> Activity Logs</a>
                            <a class="dropdown-item" href="profile.html"><i class="fas fa-sliders-h"></i> Account Settings</a>
                            <a class="dropdown-item" href="signup.html"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
                        </div>
                    </div>
                    <div class="dropdown main-header-message right-toggle">
                        <a class="nav-link pe-0" data-bs-toggle="sidebar-right" data-bs-target=".sidebar-right">
                            <i class="ion ion-md-menu tx-20 bg-transparent"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /main-header -->

<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
<div class="sticky">
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="index.html"><img src="assets/img/brand/logo.png" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="index.html"><img src="assets/img/brand/logo-white.png" class="main-logo" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="index.html"><img src="assets/img/brand/favicon.png" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="index.html"><img src="assets/img/brand/favicon-white.png" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="main-sidebar-loggedin">
            <div class="app-sidebar__user">
                <div class="dropdown user-pro-body text-center">
                    <div class="user-pic">
                        <img src="assets/img/faces/6.jpg" alt="user-img" class="rounded-circle mCS_img_loaded">
                    </div>
                    <div class="user-info">
                        <h6 class=" mb-0 text-dark"></h6>
                        <span class="text-muted app-sidebar__user-name text-sm">Administrator</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar-navs">
            <ul class="nav  nav-pills-circle">
                <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Settings" aria-describedby="tooltip365540">
                    <a class="nav-link text-center m-2">
                        <i class="fe fe-settings"></i>
                    </a>
                </li>
                <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Chat" aria-describedby="tooltip143427">
                    <a class="nav-link text-center m-2">
                        <i class="fe fe-mail"></i>
                    </a>
                </li>
                <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Followers">
                    <a class="nav-link text-center m-2">
                        <i class="fe fe-user"></i>
                    </a>
                </li>
                <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Logout">
                    <a class="nav-link text-center m-2" href="{{ route('logut') }}">
                        <i class="fe fe-power"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
            </svg></div>
        <ul class="side-menu ">
            <li class="slide">
                <a class="side-menu__item" href="/mansoor/admin/dashboard.php/"><i class="side-menu__icon fe fe-airplay"></i><span class="side-menu__label">Dashboard</span></a>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="/mansoor/admin/all-employee-admin.php"><i class="side-menu__icon fe fe-box"></i><span class="side-menu__label">All Employee</span></a>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="/mansoor/admin/employee-leaves.php"><i class="side-menu__icon fe fe-award "></i><span class="side-menu__label">Leaves(Employee)</span></a>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="/mansoor/admin/holidays.php"><i class="side-menu__icon fe fe-layers "></i><span class="side-menu__label">Holidays</span></a>
            </li>

        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
            </svg></div>
    </div>
</aside>
</div>
<!-- main-content -->
<div class="main-content app-content">

<!-- container -->
<div class="main-container container-fluid">
    <main>
        @hasSection('section')
            @yield('section')
        @else
            <h2>Content Not Found</h2>
        @endif

    </main>
</div>
</div>
    <footer>
        <div class="main-footer ht-45">
			<div class="container-fluid pd-t-0-f ht-100p">
					<span> Copyright © 2022 <a   href="javascript:void(0);" class="text-primary">Azira</a>. Designed with <span class="fa fa-heart text-danger"></span> by <a   href="javascript:void(0);"> Spruko </a> All rights reserved.</span>
			</div>
		</div>
    </footer>
    <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
</div>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/ionicons/ionicons.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/p-scroll.js') }}"></script>
    <script src="{{ asset('assets/js/eva-icons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/side-menu/sidemenu.js') }}"></script>
    <script src="{{ asset('assets/js/sticky.js') }}"></script>
    <script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>
    <script src="{{ asset('assets/plugins/sidebar/sidebar-custom.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/themecolor.js') }}"></script>
    <script src="{{ asset('assets/js/swither-styles.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ 'https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js' }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
    @stack('script')
</body>

</html>
