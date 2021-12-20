<?php
require 'libary.php';
require 'request.php';
$regressive = explode(";", $myData['regressive']);
?>
<!doctype html>
<html lang="<?= $myData["lang"] ?>">

<head>
  <!-- Required meta tags -->

  <title><?= $myData["title"] ?></title>
<link rel="image_src" href="images/image_src.html" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="<?= $myData["metaKeyWords"] ?>">
<meta http-equiv="Content-Type" content="text/html" charset="<?= $myData["charset"] ?>">
<meta property="og:title" content="Lineage 2 <?= $myData["title"] ?>" />
<meta property="og:site_name" content="Lineage 2" />
<meta property="og:url" content="<?= "http://www.lin2rpg.com/".$myData["metaSiteName"] ?>" />
<meta property="og:description" content="Lineage 2 <?= $myData["metaDescription"] ?>"/>
<meta property="og:type" content="website" />
<meta property="og:image" content="images/image_src.html" />

<!--Style Sheet-->
<link rel="shortcut icon" href="<?= $baseUrlApp . "css/images/favicon.png" ?>" />
<link rel="stylesheet" type="text/css" href="<?= $baseUrlApp . 'css/style.css'; ?>" media="all" />
<link rel="stylesheet" type="text/css" href="<?= $baseUrlApp . 'css/style-system.css'; ?>" media="all" />
<link rel="stylesheet" type="text/css" href="<?= $baseUrlApp . 'css/bootstrap.min.css'; ?>" media="all" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
  <?php if ($dbSrv->error === true) { ?>
    <div class="offline">
      <div class="info-offline">
        <h1><?= $config['wbn']; ?> is <strong>OFFLINE</strong>
          <div><?= $myData["offilineMsg"] ?></div>
        </h1>
      </div>
    </div>
  <?php } ?>

  <?php if ($verifyExpired === true) { ?>
    <div class="offline">
      <div class="info-expired">
        <h1><?= $config['wbn']; ?> is <strong>EXPIRED</strong>
        </h1>
      </div>
    </div>
  <?php } ?>


  <div class="main">
    <!-- BEGIN MAIN -->

    <div class="header">

      <ul class="menu">
        <li><a href="?pag=main">Home</a></li>
        <li><a href="?pag=info">Info</a></li>
        <li><a href="?pag=register">Register</a></li>
        <li><a href="?pag=download">Download</a></li>
        <li><a href="?pag=rules">Rules</a></li>
        <li><a href="?pag=admin-contact">Contact</a></li>
      </ul>

      <h1 class="webname"><?= $myData["metaSiteName"] ?></h1>

      <div class="status">
        <p>GAME <img src="<?= $baseUrlApp . 'css/images/online.png'; ?>"></p>
      </div>

      <div class="login">
        <form method="POST" action="?pag=main">
          <h1 class="title-login">Login</h1>
          <input type="text" class="form-control" name="login" autocomplete="off" placeholder="login">
          <input type="password" class="form-control" name="password" autocomplete="off" placeholder="password">
          <input type="submit" class="btn badge-dark" value="login">
          <input type="hidden" name="form_enter" value="true">
          <input type="hidden" name="token_user_recaptacha" id="token_recaptacha_id_login" value="">
          <?php /* Response */ ?>
          <?php if ($response['login']['success'] === true) { ?>
            <div class="alert mt-2 alert-success text-center" role="alert" style="position: absolute; width: 250px;">Success</div>
          <?php } ?>
          <?php if ($response['login']['error'] === true) { ?>
            <div class="alert mt-2 alert-danger text-center" role="alert" style="position: absolute; width: 250px;">Error</div>
          <?php } ?>

        </form>

        <div class="carousel m-auto slider-lin2rpg-com">

          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active circle">
                <div class="target"></div>
              </li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1" class="circle">
                <div class="target"></div>
              </li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2" class="circle">
                <div class="target"></div>
              </li>
            </ol>


            <div class="info-slider">
              <small class="text-justify"><?= $myData["sliderMessage"] ?>
              </small>

            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="<?= $baseUrlApp . 'css/images/slide1.jpg'; ?>" alt="First slide" height="260">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="<?= $baseUrlApp . 'css/images/slide2.jpg'; ?>" alt="Second slide" height="260">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="<?= $baseUrlApp . 'css/images/slide3.jpg'; ?>" alt="Third slide" height="260">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>

          </div>
        </div>
      </div>
      <div class="content">
        <!-- Display the countdown timer in an element -->
        <?php if ($_GET["pag"] == "main" || $_GET["pag"] == "") { ?>
          <div class="regressive">
            <div id="demo"></div>
          </div>
        <?php } ?>
        <br>
        <?= dinamicPag($pag, $dbSrv, $myData, $baseUrlApp, $actual_link, $response) ?>
      </div>
      <div class="others">
        <div class="btn-left">
          <ul>
            <li><a type="button" href="#" class="btn badge-dark">Forum</a></li>
            <li><a type="button" href="#" class="btn badge-dark">Top 200</a></li>
          </ul>
        </div>
      </div>



      <div class="fb-page" id="fanpag" data-href="<?= $myData["urlLikeFacebook"] ?>" data-tabs="timeline" data-width="250" data-height="385" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
        <blockquote cite="<?= $myData["urlLikeFacebook"] ?>" class="fb-xfbml-parse-ignore"><a href="<?= $myData["urlLikeFacebook"] ?>">Vipcriativo</a></blockquote>
      </div>


    </div><!-- END MAIN -->
    <?php if ($myData["likeFacebook"] == 1) { ?>
      <div class="face-float">
        <div class="like">
          <span class="close-like"><i class="material-icons">close</i></span>
          <div class="fb-page" id="fb-pag-float" data-href="<?= $myData["urlLikeFacebook"] . "/?modal=admin_todo_tour" ?>" data-width="300" data-height="350" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
            <blockquote cite="<?= $myData["urlLikeFacebook"] . "/?modal=admin_todo_tour" ?>" class="fb-xfbml-parse-ignore"><a href="<?= $myData["urlLikeFacebook"] . "/?modal=admin_todo_tour" ?>"><?= $myData["metaSiteName"] ?></a></blockquote>
          </div>
        </div>
      </div>
    <?php } ?>

    <script type=" text/javascript" src="<?= $baseUrlApp . 'js/jquery-3.4.1.slim.min.js'; ?> "></script>
    <script type="text/javascript" src="<?= $baseUrlApp . 'js/global.js'; ?> "></script>
    <script type=" text/javascript" src="<?= $baseUrlApp . 'js/bootstrap.min.js'; ?> "></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LdvOLEUAAAAAE_LC-Nn-_z8zLOhTSee2SyYN29E"></script>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v4.0"></script>

    <?php if ($myData["likeFacebook"] == 1) { ?>
      <script>
        $(function() {

          let like = localStorage.getItem("like");

          if (!like) {
            $('.face-float').css('display', 'inline');
            localStorage.setItem("like", "true");
          }

          $('.close-like').click(function() {
            $('.face-float').css('display', 'none');
          });

        });

        countDown(<?= $regressive[0] ?>, <?= $regressive[1] ?>, <?= $regressive[2] ?>, "<?= $regressive[3] ?>");

        grecaptcha.ready(function() {
            grecaptcha.execute('6LdvOLEUAAAAAE_LC-Nn-_z8zLOhTSee2SyYN29E', {
                action: 'index'
            }).then(function(token) {
                document.getElementById("token_recaptacha_id_login").value = token;
                document.getElementById("token_recaptacha_id_register").value = token;
                document.getElementById("token_recaptacha_id_change_password").value = token;
                document.getElementById("token_recaptacha_id_unlock_char").value = token;
            });
        });
      </script>
    <?php } ?>
</body>

</html>