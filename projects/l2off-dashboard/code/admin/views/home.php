<?php
require 'websites/manipule-webs.php';

$serverStatus = getConnectionStatus($myWN);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $secretKeyRecaptcha = $global['secret_key_recaptcha'];
    $getResponse = $_POST['token_user_recaptacha'];
    $getJ = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKeyRecaptcha&response=$getResponse");
    $json = json_decode($getJ);

    if (isset($_FILES['upload'])) {

        if ($json->success === $global['recaptcha_enable']) {

            if ($serverStatus == true and count(getAllWebNameById($_SESSION['id'])) > 0) {

                uploadFileConfig($_FILES, directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__),$global['system_operational']) . "app/template/" . $myWN . "/", $myTK, getAllWebNameById($_SESSION['id']));
          
            } else {
                echo '<div class="alert alert-primary" role="alert"> Error status off or not exist! </div>';
            }
        } else {
            echo '<div class="alert alert-primary" role="alert">Error recaptcha</div>';
        }
    }

    if (guardIndex($_SESSION['id'], $_COOKIE['password']) === true) {

        if (isset($_POST['free']) and !empty($_POST['free']) and $_POST['free'] == 1) {

            deleteFree(directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__),$global['system_operational']) . "app/template/");
            
        }

        if (isset($_POST['paid']) and !empty($_POST['paid']) and $_POST['paid'] == 1) {

            deletePaid(directoryRoot($_SERVER['REQUEST_URI'], dirname(__DIR__),$global['system_operational']) . "app/template/");
        }
    }
    
}

?>


<div class="row">
    <div class="col-md-8">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-end flex-wrap">
                <div class="mr-md-3 mr-xl-5">
                    <h1 class="display-3 text-center">Welcome Lin2rpg</h1>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Analytics</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <?php if (count(getAllWebNameById($_SESSION['id'])) > 0) { ?>
                <?php foreach (getAllWebNameById($_SESSION['id']) as $item) { ?>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text text-dark" id="basic-addon3">Copy</span>
                        </div>
                        <div class="form-control bg-dark text-success"><?= $indexUrl . $item['name']; ?></div>
                    </div>

                <?php } ?>
            <?php } else { ?>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text text-dark" id="basic-addon3">Copy</span>
                    </div>
                    <div class="form-control bg-dark text-warning"><?= $indexUrl; ?><i class="mdi mdi-emoticon-sad" style="color: yellow;"></i></div>
                </div>
            <?php } ?>
        </div>
        <?php if (guardIndex($_SESSION['id'], $_COOKIE['password']) === true) { ?>
            <div class="mt-5 count-web">
                <div class="qt-count">
                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="free" value="1">
                        <button type="submit" class="btn btn-dark">Free <span><?= DisplayFree(); ?></span> Delete All</button>
                    </form>
                </div>
                <div class="qt-count">
                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="paid" value="1">
                        <button type="submit" class="btn btn-dark">Paid <span><?= DisplayPaidOut(); ?></span> Delete All</button>
                    </form>
                </div>
            </div>
        <?php } ?>

        <div class="mt-5">
            <h1 class="display-4 text-center">EXPIRED AFTER FINISHED</h1>
            <div id="getting-started"></div>
        </div>

    </div>
    <div class="col-md-4">
        <h1 class="display-4 text-center">STATUS</h1>
        <div class="card">

            <div class="card-body web-status">

                <!-- <div class="card-title text-secondary w-50 text-center">VISITS <strong class="text-primary">0</strong></div> -->
                <div class="card-title text-secondary w-50 text-center">TOTAL VIEWS <strong class="text-primary"><?= getTotalViews($myWN); ?></strong></div>

            </div>
            <div class="card-body web-status">

                <?php if (count(getAllWebNameById($_SESSION['id'])) == 0) { ?>
                    <div class="card-title text-secondary w-50 text-center">WEB <img height="16" src="<?= $adminUrl . 'assets/images/off.png'; ?>"></div>
                <?php } else {  ?>
                    <div class="card-title text-secondary w-50 text-center">WEB <img height="16" src="<?= $adminUrl . 'assets/images/on.png'; ?>"></div>
                <?php }  ?>

                <?php if ($serverStatus === true) { ?>
                    <div class="card-title text-secondary w-50 text-center">SERVER <img height="16" src="<?= $adminUrl . 'assets/images/on.png'; ?>"></div>
                <?php } else {  ?>
                    <div class="card-title text-secondary w-50 text-center">SERVER <img height="16" src="<?= $adminUrl . 'assets/images/off.png'; ?>"></div>
                <?php }  ?>

            </div>
            <canvas id="total-sales-chart"></canvas>
            <div class="mt-2  p-2">
                <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Upload File</label>
                        <input type="file" name="upload" id="file-text" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" id="file-text-name" class="form-control file-upload-info" disabled placeholder="Upload File">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-info btn-icon-text" id="file-text-config" type="button"><i class="mdi mdi-upload btn-icon-prepend"></i>
                                    Upload</button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" type="button" class="btn btn-dark btn-icon-text float-right">
                            <i class="mdi mdi-file-check btn-icon-prepend" style="visibility: hidden;" id="icon-file-uploaded"></i>
                            Submit
                        </button>
                    </div>
                    <input type="hidden" name="token_user_recaptacha" id="token_recaptacha_id" value="">
                </form>

            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="mt-5">

                    <?php if (count(getAllWebNameById($_SESSION['id'])) > 0) { ?>
                        <?php foreach (getAllWebNameById($_SESSION['id']) as $item) { ?>
                            Download file for config your website!
                            <a href="<?= $indexUrl . 'app/template/' . $item['name'] . '/' . $item['token'] . '.txt'; ?>" download="<?= $item['name'] . '_config' . '.txt'; ?>" class=" text-info text-center" target="_self"><button type="button" class="btn btn-light bg-white btn-icon mr-3 d-none d-md-block ">
                                    <i class="mdi mdi-download text-muted"></i>
                                </button></a>

                            <div class="alert alert-primary" role="alert">
                                <pre>
                                                                                                  <?php print_r($myData); ?>
                                                                                                </pre>
                            </div>

                        <?php } ?>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('file-text-config').addEventListener('click', openDialog);

    function openDialog() {
        document.getElementById('file-text').click();
    }

    $('#file-text').change(function(e) {

        var fileData = e.target.files[0].name;

        if (e.target.files[0].name.length > 0 && e.target.files[0].type == "text/plain") {

            $('#icon-file-uploaded').css('visibility', 'visible').css('color', '#0FFB29');

        } else {

            var restult = confirm("Type file not's text");
            if (restult === true || restult === false) window.location.reload();
        }

        $('#file-text-name').val(fileData);

    });


    $("#getting-started")
        .countdown("<?= getDataTemp(getAllWebNameById($_SESSION['id'])[0]['id']); ?>", function(event) {
            $(this).text(
                event.strftime('%D Days %H:%M:%S')
            );
        });
</script>