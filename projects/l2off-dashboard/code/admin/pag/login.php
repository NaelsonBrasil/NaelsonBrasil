<?php
 include '../config.php';
 session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LIN2RPG</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-12 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">
                            <div class="brand-logo">
                                <img src="<?= $baseUrl . 'assets/images/logo.png'; ?>" alt="logo">
                            </div>
                            <h4>Welcome back!</h4>
                            <h6 class="font-weight-light">Happy to see you again!</h6>
                            <form class="pt-3" method="post" action="<?= $baseUrl . "run.php"; ?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-account-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="email" name="email" class="form-control form-control-lg border-left-0" id="email" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-lock-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="password" name="password" class="form-control form-control-lg border-left-0" id="password" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div>

                                <div class="mb-2 d-flex">
                                    <!-- <button type="button" class="btn btn-facebook auth-form-btn flex-grow mr-1">
                                        <i class="mdi mdi-facebook mr-2"></i>Facebook
                                    </button>
                                    <button type="button" class="btn btn-google auth-form-btn flex-grow ml-1">
                                        <i class="mdi mdi-google mr-2"></i>Google
                                    </button> -->
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Don't have an account? <a href="register" class="text-primary">Create</a>
                                </div>
                                <input type="hidden" name="target_login" value="true">
                                <input type="hidden" name="token_user_recaptacha" id="token_recaptacha_id" value="">
                                <div class="my-3">
                                    <input type="submit" class="btn btn-block btn-dark btn-lg font-weight-medium auth-form-btn" value="Login" id="loginForm">
                                </div>
                                <br>
                                <?php if (isset($_SESSION['login_error']) and !empty($_SESSION['login_error_msg'])) {  ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=$_SESSION['login_error_msg'] ?>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->

    <script src="../assets/js/template/off-canvas.js"></script>
    <script src="../assets/js/template/hoverable-collapse.js"></script>
    <script src="../assets/js/template/template.js"></script>
    <script src="../assets/js/template/off-canvas.js"></script>
    <script src="../assets/js/template/hoverable-collapse.js"></script>
    <script src="../assets/js/template/template.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LdvOLEUAAAAAE_LC-Nn-_z8zLOhTSee2SyYN29E"></script>
    <!-- endinject -->
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LdvOLEUAAAAAE_LC-Nn-_z8zLOhTSee2SyYN29E', {
                action: 'login'
            }).then(function(token) {
                document.getElementById("token_recaptacha_id").value = token;
            });
        });
    </script>

</body>

</html>