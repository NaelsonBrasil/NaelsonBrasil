<?php
$new1 = explode("<spc>", $textCfg["news0"]);
$new2 = explode("<spc>", $textCfg["news1"]);
$new3 = explode("<spc>", $textCfg["news2"]);
$new4 = explode("<spc>", $textCfg["news3"]);
$new5 = explode("<spc>", $textCfg["news4"]);

?>

<div class="news">

    <div class="icon-news">
        <img src="<?= $baseUrl . 'css/images/new.png'; ?>">
    </div>
    <br>
    <article>
        <div>

            <h3><?= $new1[0] ?></h3>
            <p><?= $new1[1] ?></p>
            <span><?= $new1[2] ?></span>
        </div>

        <div>
            <h3><?= $new2[0] ?></h3>
            <p><?= $new2[1] ?></p>
            <span><?= $new2[2] ?></span>
        </div>

        <div>
            <h3><?= $new3[0] ?></h3>
            <p><?= $new3[1] ?></p>
            <span><?= $new3[2] ?></span>
        </div>

        <div>
            <h3><?= $new4[0] ?></h3>
            <p><?= $new4[1] ?></p>
            <span><?= $new4[2] ?></span>
        </div>

        <div>
            <h3><?= $new5[0] ?></h3>
            <p><?= $new5[1] ?></p>
            <span><?= $new5[2] ?></span>
        </div>

    </article>

</div>