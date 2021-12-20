<?php
session_start();
require 'inc.php';

?>
<!doctype html>
<html lang="<?= $lang ?>">

<head>
    <?php include 'import/meta.php' ?>
    <?php include 'import/stylesheet.php'; ?>
    <link rel="stylesheet" href="assets/css/connect.css">
    <title>Welcome</title>
</head>

<body>

    <?php if (isset($_SESSION['field_erros'])) { ?>
    <div class="alert alert-custom alert-danger text-center w-25 mt-2" role="alert">
        <?php echo $_SESSION['field_erros']; ?>&nbsp<i class="far fa-grin-beam-sweat bg-dark"></i>
        <?php unset($_SESSION['field_erros']); ?>
    </div>
    <?php } ?>

    <?php if (isset($_SESSION['connect'])) { ?>
    <div class="alert alert-custom alert-danger text-center w-25 mt-2" role="alert">
        <?php echo $_SESSION['connect']; ?>&nbsp<i class="far fa-grin-beam-sweat text-dark"></i>
        <?php unset($_SESSION['connect']); ?>
    </div>
    <?php } ?>

    <div class="container-fluid">
        <div class="row">

            <div class="col-3">
                <!-- empty -->
            </div>
            <div class="col-9">
                <div class="mt-5">
                    <div class="title p-2">
                        <div>
                            <h2>TO CONNECT WITH YOUR EMULATOR</h2>
                        </div>
                        <div class="icon-simbol"><i class="fab text-primary fa-connectdevelop"></i></div>
                    </div>
                    <form method="POST" action="<?= $baseUrl . "redirect.php" ?>">
                        <div class="form-group">
                            <label for="targetPlataform">TYPE</label>
                            <select class="form-control" name="type" id="targetPlataform">
                                <option value="divul" disabled >PAG DISCLOSURE</option>
                                <option value="site">SITE</option>

                            </select>
                            <small for="targetPlataform">Disabled&nbsp;<span class="badge badge-danger">L2OFF</span></small>
                        </div>
                        <div class="form-group">
                            <label for="targetPlataform">PLATAFORM</label>
                            <select class="form-control" name="plataform" id="targetPlataform">
                                <option value="java">JAVA</option>
                                <option value="pts" disabled>PTS</option>
                            </select>
                            <small for="targetPlataform">Disabled&nbsp;<span class="badge badge-danger">L2OFF</span></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectGender">PROJECT</label>
                            <select class="form-control" name="project" id="exampleSelectGender">
                                <option value="frozen">FROZEN</option>
                                <option value="acis">ACIS</option>
                                <option value="l2off" disabled>L2OFF</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">OK</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'import/javascript.php'; ?>
</body>

</html>