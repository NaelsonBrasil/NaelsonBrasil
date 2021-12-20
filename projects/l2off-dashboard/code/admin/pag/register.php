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
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-8 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="<?= $baseUrl . 'assets/images/logo.png'; ?>" alt="logo">
                            </div>
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                            <form class="pt-3" method="post" action="<?= $baseUrl . "run.php" ?>">
                                <div class="form-group">
                                    <input type="text" name="user" id="user" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" id="terms" class="form-check-input">
                                            I agree to all Terms & Conditions
                                        </label>
                                    </div>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="login" class="text-primary">Login</a>
                                </div>
                                <input type="hidden" name="target_register" value="true">
                                <input type="hidden" name="token_user_recaptacha" id="token_recaptacha_id" value="">
                                <div class="mt-3">
                                    <input type="submit" class="btn btn-block btn-dark btn-lg font-weight-medium auth-form-btn" id="registerForm">
                                </div>
                                <br>
                                <?php if (isset($_SESSION['register_error']) and !empty($_SESSION['register_error_msg'])) {  ?>
                                <div class="alert alert-info" role="alert">
                                    <?= $_SESSION['register_error_msg']; ?>
                                </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 mx-auto">

                        <div class="rules">
                            <article>
                                <h4 class="text-center mt-3 title">Terms & Conditions</h4>
                                <ul>
                                    <li>
                                        <p>01. Estejam cientes de que estamos em constantes mudança, podendo afetar todos website e também dependemos de boa estabilidade na hospedagem a qual foi contratada e não garantimos reembolso ou danos de grande proporções!</p>
                                    </li>
                                    <li>
                                        <p>02. Sabendo o tempo de expiração a qual foi finalisado, nós deletaremos todos os files deste website adquirido em nossa plataforma.</p>
                                    </li>
                                    <li>
                                        <p>03. Toda edição oferecida em nossa plataforma é de sua responsabilidade.</p>
                                    </li>
                                    <li>
                                        <p>04. Todas os dados inseridos aqui são protegidos sem garantia pelo método de cryptografica PHP; senhas cryptografadas.</p>
                                    </li>
                                    <li>
                                        <p>05. Compartilhamento de senhas, a LIN2RPG não se responsabilizá pelos danos.</p>
                                    </li>
                                    <li>
                                        <p>06. Após recebido o produto de nosso serviço iniciara a contagem e ao final o sistema deletara todos os files automaticamente.</p>
                                    </li>
                                </ul>
                            </article>
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

    <script>
        $(function() {

            $("#registerForm").click(function(e) {
                if ($("#terms").is(":checked")) {
                    e.submit();
                } else {
                    alert("Aceite os termos!");
                    e.preventDefault();
                }
            });
        });

        grecaptcha.ready(function() {
            grecaptcha.execute('6LdvOLEUAAAAAE_LC-Nn-_z8zLOhTSee2SyYN29E', {
                action: 'register'
            }).then(function(token) {
                document.getElementById("token_recaptacha_id").value = token;
            });
        });
    </script>
</body>

</html>