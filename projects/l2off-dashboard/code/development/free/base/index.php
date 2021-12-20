<?php
require 'libary.php';
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

  <h1>Pag, Index</h1>


  <div class="main">

    <div class="w-25 badge-dark">

      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="?pag=login">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="?pag=download">Download</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?pag=rules">Rules</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?pag=register">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?pag=info">Information</a>
        </li>
      </ul>

    </div>

    <div class="w-75 bg-secondary">
      <?= dinamicPag($pag, $dbSrv, $myData, $baseUrlApp, $actual_link, $response) ?>
    </div>

  </div>

  <div class="regressive">
    <div id="demo"></div>
  </div>

  </div><!-- END MAIN -->
  <?php if ($myData["likeFacebook"] == 1) { ?>
    <div class="face-float">
      <div class="like">
        <span class="close-like"><i class="material-icons">close</i></span>
        <div class="fb-page" id="fb-pag-float" data-href="<?= $myData["urlLikeFacebook"] . "/?modal=admin_todo_tour" ?>" data-width="300" data-height="300" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
          <blockquote cite="<?= $myData["urlLikeFacebook"] . "/?modal=admin_todo_tour" ?>" class="fb-xfbml-parse-ignore"><a href="<?= $myData["urlLikeFacebook"] . "/?modal=admin_todo_tour" ?>"><?= $myData["metaSiteName"] ?></a></blockquote>
        </div>
      </div>
    </div>
  <?php } ?>

  <script type=" text/javascript" src="<?= $baseUrlApp . 'js/jquery-3.4.1.slim.min.js'; ?> "></script>
  <script type="text/javascript" src="<?= $baseUrlApp . 'js/global.js'; ?> "></script>
  <script type=" text/javascript" src="<?= $baseUrlApp . 'js/bootstrap.min.js'; ?> "></script>
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v4.0"></script>
  <script src="https://www.google.com/recaptcha/api.js?render=6LdvOLEUAAAAAE_LC-Nn-_z8zLOhTSee2SyYN29E"></script>

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