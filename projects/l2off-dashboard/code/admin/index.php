<?php
require 'layout.php';
sessionVerify($keyJwt, $timeJwt);
checkCookieExp();
$vars = array(
    'secret_key_recaptcha' => $secretKeyRecaptcha,
    'recaptcha_enable' => $recaptchaEnable,
    'system_operational' => SYSTEM_OPRATIONAL
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>lin2rpg</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />

    <!-- End custom js for this page-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="assets/js/jquery.countdown.min.js"></script>

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
                <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                    <button class="navbar-toggler text-light navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-sort-variant"></span>
                    </button>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <!-- Search Disabled -->
                <!-- <ul class="navbar-nav mr-lg-4 w-100">
                    <li class="nav-item nav-search d-none d-lg-block w-100">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="search">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
                        </div>
                    </li>
                </ul> -->
                <ul class="navbar-nav navbar-nav-right">

                    <!-- <li class="nav-item dropdown mr-1">
                        <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
                            <i class="mdi mdi-message-text mx-0"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                            <a class="dropdown-item">
                                <div class="item-thumbnail">
                                    <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                                </div>
                                <div class="item-content flex-grow">
                                    <h6 class="ellipsis font-weight-normal">David Grey
                                    </h6>
                                    <p class="font-weight-light small-text text-muted mb-0">
                                        The meeting is cancelled
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item">
                                <div class="item-thumbnail">
                                    <img src="assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                                </div>
                                <div class="item-content flex-grow">
                                    <h6 class="ellipsis font-weight-normal">Tim Cook
                                    </h6>
                                    <p class="font-weight-light small-text text-muted mb-0">
                                        New product launch
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item">
                                <div class="item-thumbnail">
                                    <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                                </div>
                                <div class="item-content flex-grow">
                                    <h6 class="ellipsis font-weight-normal"> Johnson
                                    </h6>
                                    <p class="font-weight-light small-text text-muted mb-0">
                                        Upcoming board meeting
                                    </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown mr-4">
                        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="#" data-toggle="dropdown">
                            <i class="mdi mdi-bell mx-0"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                            <a class="dropdown-item">
                                <div class="item-thumbnail">
                                    <div class="item-icon bg-success">
                                        <i class="mdi mdi-information mx-0"></i>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <h6 class="font-weight-normal">Application Error</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Just now
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item">
                                <div class="item-thumbnail">
                                    <div class="item-icon bg-warning">
                                        <i class="mdi mdi-settings mx-0"></i>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <h6 class="font-weight-normal">Settings</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Private message
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item">
                                <div class="item-thumbnail">
                                    <div class="item-icon bg-info">
                                        <i class="mdi mdi-account-box mx-0"></i>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <h6 class="font-weight-normal">New user registration</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        2 days ago
                                    </p>
                                </div>
                            </a>
                        </div>
                    </li> -->
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">

                            <!-- <img src="assets/images/faces/face5.jpg" alt="profile" /> -->
                            <span class="nav-profile-name text-light"><?= $_COOKIE['name'] ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item">
                                <i class="mdi mdi-settings text-primary"></i>
                                Setting
                            </a>
                            <a class="dropdown-item" href="<?= hrefRedirect('pag/login'); ?>">
                                <i class="mdi mdi-logout text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-dark sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index">
                            <i class="mdi mdi-home menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <?php if (admVisible($_SESSION['id'], $_COOKIE['password']) === true) { ?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                                <i class="mdi mdi-circle-outline menu-icon"></i>
                                <span class="menu-title">Admin</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="product">Register Product</a></li>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#websites" aria-expanded="false" aria-controls="auth">
                            <i class="mdi mdi-screwdriver menu-icon"></i>
                            <span class="menu-title">My website</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="websites">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="orders">Orders</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                            <i class="mdi mdi-account menu-icon"></i>
                            <span class="menu-title">Pages</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="<?= $baseUrlOne . 'connect' ?>">Connection
                                        Server</a></li>
                                <li class="nav-item"> <a class="nav-link" href="pag/register">Register Account</a></li>
                                <li class="nav-item"> <a class="nav-link" href="pag/login">Login</a></li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl."suport"; ?>">
                            <i class="mdi mdi-eye mr-3 menu-icon"></i>
                            <span class="menu-title">Suport</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <?php views($_SERVER['REQUEST_URI'], array('indexUrl' => $baseUrlOne, 'adminUrl' => $baseUrl,'global' => $vars)) ?>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">All rights reserved by template Admin <a href="https://www.urbanui.com/" target="_blank">Urbanui</a></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="assets/vendors/base/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="assets/js/template/off-canvas.js"></script>
    <script src="assets/js/template/hoverable-collapse.js"></script>
    <script src="assets/js/template/template.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/template/dashboard.js"></script>
    <script src="assets/js/template/data-table.js"></script>
    <script src="assets/js/template/jquery.dataTables.js"></script>
    <script src="assets/js/template/dataTables.bootstrap4.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LdvOLEUAAAAAE_LC-Nn-_z8zLOhTSee2SyYN29E"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LdvOLEUAAAAAE_LC-Nn-_z8zLOhTSee2SyYN29E', {
                action: 'index'
            }).then(function(token) {
                 document.getElementById("token_recaptacha_id").value = token;
            });
        });
    </script>
</body>

</html>