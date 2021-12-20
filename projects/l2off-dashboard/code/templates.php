<?php
require_once 'inc.php';
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'import/meta.php' ?>
    <?php include 'import/stylesheet.php'; ?>

    <link rel="stylesheet" href="assets/css/templates.css">
    <title>Choose Website</title>

</head>

<body>


    <div class="container-fluid">

        <?php if (isset($_SESSION['success']) and !empty($_SESSION['success'])) { ?>
        <div class="alert btn-successful-connection alert-success text-center" role="alert">
            <?= $_SESSION['success']; ?>
        </div>
        <?php  } else if (empty($_SESSION['success'])) {
            header('Location:' . $baseUrl . 'connect');
        } ?>

        <div class="row">
            <div class="modal" tabindex="-1" role="dialog" aria-hidden="true" id="myModel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title">Necessary sign in</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Lin2web report bugs or suggestion <a href="">link</a></p>
                        </div>
                        <div class="modal-footer">
                            <a href="<?= $baseUrl . "admin/pag/login"; ?>"><button type="button" class="btn btn-danger">sign In</button></a>
                            <a href="<?= $baseUrl . "admin/pag/register"; ?>"><button type="button" class="btn btn-danger">Sign up</button></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-0">
            </div>
            <div class="col-12">

                <?php if (isset($_SESSION['templates_error']) and !empty($_SESSION['templates_error_msg'])) {  ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?= $_SESSION['templates_error_msg'] ?>
                </div>
                <?php } ?>
                <div class="form-cloose-chronic">

                    <form class="p-2" method="post" action="<?= $baseUrl . 'admin/process'; ?>">
                        <div class="input-group mb-2 mr-sm-2 w-75 check-name">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><span class="badge badge-refresh badge-secondary">lin2rpg.com/</span><span class="badge badge-refresh" id="write-refresh-name"></span></div>
                            </div>
                            <input type="text" class="form-control p-4" name="wName" id="targetName" maxlength="30" autocomplete="off" placeholder="your web name" required>
                            <button type="button" class="btn bg-dark text-light btn-check-name w-25 ">Verify</button>
                        </div>

                        <div class="custom-control custom-radio text-justify">
                            <input type="radio" class="radio custom-control-input" id="customControlValidation2" name="radio" value="1" onclick="selectChecked(1)" required>
                            <label class="custom-control-label" for="customControlValidation2">Pro</label>
                        </div>

                        <div class="custom-control custom-radio mb-3 text-justify">
                            <input type="radio" class="radio custom-control-input" id="customControlValidation3" name="radio" value="0" onclick="selectChecked(1)" required>
                            <label class="custom-control-label" for="customControlValidation3">Free</label>
                        </div>

                        <main>
                            <ul class="template"></ul>
                            <div class="alert alert-danger mt-3" role="alert" id="unavailable_template">Unavailable!</div>
                        </main>

                        <!-- <input type="hidden" name="wName" id="targetName" value=""> -->
                        <input type="hidden" name="tempID" id="targetId" value="">
                        <input type="hidden" name="token_user_recaptacha" id="token_recaptacha_id" value="">
                        <div class="col-auto my-1">
                            <input type="submit" class="btn btn-dark w-25 auto" disabled value="Next Process">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php include 'import/javascript.php'; ?>
    <script src="https://www.google.com/recaptcha/api.js?render=6LdvOLEUAAAAAE_LC-Nn-_z8zLOhTSee2SyYN29E"></script>
    <script type="text/javascript" src="assets/javascript/zoom.js"></script>
    <script>
        function enableSubmit() {

            if (document.getElementById('targetName').value.length > 0 && document.getElementById('targetId').value.length > 0) {
                $('input[type="submit"]').prop('disabled', false);
            }

        }
        $(function() {

            let countM = 3000;
            $('#targetName').on('input', function() {

                $('#write-refresh-name').css('background-color', 'rgb(204, 44, 44)');
                document.getElementById('write-refresh-name').innerHTML = $(this).val();

            });

            $('.btn-check-name').click(function() {

                <?php if (empty($_SESSION['id'])) { ?>

                $('#myModel').modal('show');

                <?php } else { ?>

                let data = $('#targetName').val();

                if (data.length > 0) {

                    if (alphanumeric(data)) {

                        $.ajax({
                            url: "<?= $baseUrl . "admin/run.php"; ?>",
                            type: "POST",
                            contentType: "application/json; charset=utf-8",
                            data: JSON.stringify({

                                webName: $('#targetName').val(),
                                //token_user_recaptacha: $('#token_recaptacha_id').val()

                            }),
                            cache: false,
                            dataType: "json",
                            success: function(json) {

                                if (json.recaptcha)
                                    console.log(json.recaptcha);

                                if (json.already === true) alert("unAvailable");

                                if (json.success === true) {
                                    $('#targetName').val(json.name);
                                    $('#write-refresh-name').css('background-color', 'rgb(44, 204, 105)');
                                }

                                if (json.empty === true)
                                    alert("Empty!");

                                if (json.size === true)
                                    alert("Web name very long!");

                                //     if (json.recaptcha) {
                                //     alert(json.recaptcha['error-codes'][0]);
                                //     window.location = "<?= $baseUrl; ?>";
                                // }

                            },
                            error: function(json) {
                                console.log("Error ajax");
                            }
                        });

                    } else {
                        alert("Alpha numeric not allowed! Alowned only [0-9a-zA-Z] ");
                    }
                } else {
                    alert("Empty field!");
                }

                <?php } ?>
            });


            $(".radio").change(function() {

                $.ajax({

                    url: "<?= $baseUrl . "admin/run.php"; ?>",
                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({
                        plan: $(this).val(),
                        project: '<?= $_SESSION['configs']['project'] ?>',
                        plataform: '<?= $_SESSION['configs']['plataform'] ?>',
                       // token_user_recaptacha: $('#token_recaptacha_id').val()
                    }),
                    cache: false,
                    dataType: "json",
                    success: function(json) {

                        console.log(json);

                        if (json.length === 0) {

                            $('#unavailable_template').css('display', 'block');

                        } else {

                            $('#unavailable_template').css('display', 'none');

                        }

                        //if (json.recaptcha) console.log(json.recaptcha);

                        if ($(".template").html('')) {

                            for (let i = 1; i < countArrayObj(json) + 1; i++) {

                                let msgPrice = '';
                                if (json[i - 1].free === 0) {

                                    msgPrice = '14 Dyas FREE';

                                } else {
                                    msgPrice = '$'+json[i - 1].price+' Mensal';
                                }

                                $(".template").append(
                                    '<li onclick="selected(' + i + ',' + json[i - 1].id + '); selectClick(' + i + '); enableSubmit();" id="div' + i + '">' +
                                    '<div class="row">' +
                                    '<div class="col-sm-3">' +
                                    '<div class="card w-100 img-zoom-container" style="width: 18rem;">' +
                                    '<div id="id-theme">' + json[i - 1].project + '</div>' +
                                    '<div id="price">' + msgPrice +'</div>' +
                                    '<img src="admin/uploaded/' + json[i - 1].image + '" class="card-img-top" alt="..." id="myimage' + i + '">' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="col-sm-9 m-0 p-0 t-content">' +
                                    '<div class="card w-75">' +
                                    '<div id="myresult' + i + '" class="img-zoom-result"></div>' +
                                    '</div>' +
                                    '<div class="w-25">' +
                                    '<h6 class="text-secondary">Resources</h6>' +
                                    '<ul class="resources">' + json[i - 1].html +
                                    '<li>CSRF&nbsp<i class="fas fa-check text-success"></i></li>' +
                                    '<li>XSS&nbsp<i class="fas fa-check text-success"></i></li>' +
                                    '<li>INJECTION&nbsp<i class="fas fa-check text-success"></i></li>' +
                                    '<li>RECAPTCHA&nbsp<i class="fas fa-check text-success"></i></li>' +
                                    '<li>DDOS HOST&nbsp<i class="fas fa-check text-success"></i></li>' +
                                    '<li>' +
                                    '</li>' +
                                    '</ul>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</li>');

                                //Initiate zoom effect:
                                imageZoom("myimage" + i, "myresult" + i);
                            }
                        }
                    },
                    error: function(json) {
                        console.log("error plan");
                    }
                });
            });
        });

        grecaptcha.ready(function() {
            grecaptcha.execute('6LdvOLEUAAAAAE_LC-Nn-_z8zLOhTSee2SyYN29E', {
                action: 'templates'
            }).then(function(token) {
                document.getElementById("token_recaptacha_id").value = token;
            });
        });
    </script>
</body>

</html>