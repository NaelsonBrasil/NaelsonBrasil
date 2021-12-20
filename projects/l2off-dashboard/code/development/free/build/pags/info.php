<?php

$infoDescription = explode("<spc>", $textCfg["infoDescription"]);
$rate = explode("<spc>", $textCfg["InfoGameplay"]);
$enchant = explode("<spc>", $textCfg["infoEnchants"]);
$oly = explode("<spc>", $textCfg["infoOlympiad"]);
$events = explode("<spc>", $textCfg["infoEvents"]);
$clan = explode("<spc>", $textCfg["infoClan"]);
$custom = explode("<spc>", $textCfg["infoAdditional"]);
?>

<div class="info">
    <article>
        <div class="primary-title">
            <h1><?= $textCfg["infoTitle"] ?></h1>
            <?php for ($i = 0; $i < count($infoDescription); $i++) { ?>
                <p><?= $infoDescription[$i] ?></p>
            <?php } ?>
        </div>

        <div>
            <div class="title"><?= $textCfg["infoTitleGameplay"] ?></div>
            <ul>
                <?php for ($i = 0; $i < count($rate); $i++) { ?>
                    <li>-&nbsp;<?= $rate[$i] ?></li>
                <?php } ?>
            </ul>
        </div>

        <div>
            <div class="title"><?= $textCfg["infoTitleEnchants"] ?></div>
            <ul>
                <?php for ($i = 0; $i < count($enchant); $i++) { ?>
                    <li>-&nbsp;<?= $enchant[$i] ?></li>
                <?php } ?>
            </ul>
        </div>

        <div>
            <div class="title"><?= $textCfg["infoTitleOlympiad"] ?></div>
            <ul>
                <?php for ($i = 0; $i < count($oly); $i++) { ?>
                    <li>-&nbsp;<?= $oly[$i] ?></li>
                <?php } ?>
            </ul>
        </div>

        <div>
            <div class="title"><?= $textCfg["infoTitleEvents"] ?></div>
            <ul>
                <?php for ($i = 0; $i < count($events); $i++) { ?>
                    <li>-&nbsp;<?= $events[$i] ?></li>
                <?php } ?>
            </ul>
        </div>

        <div>
            <div class="title"><?= $textCfg["infoTitleClan"] ?></div>
            <ul>
                <?php for ($i = 0; $i < count($clan); $i++) { ?>
                    <li>-&nbsp;<?= $clan[$i] ?></li>
                <?php } ?>
            </ul>
        </div>

        <div>
            <div class="title"><?= $textCfg["infoTitleAdditional"] ?></div>
            <ul>
                <?php for ($i = 0; $i < count($custom); $i++) { ?>
                    <li>-&nbsp;<?= $custom[$i] ?></li>
                <?php } ?>
            </ul>
        </div>

    </article>
</div>