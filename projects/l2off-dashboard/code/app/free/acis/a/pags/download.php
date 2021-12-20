<?php $client =  explode(";", $textCfg["clientLink"]); ?>
<div class="download text-center">

    <div class="title">
        <h3><?= $textCfg["downloadTitle"] ?></h3>
        <p class="text-light"><?= $textCfg["downloadDescription"] ?></p>
    </div>

    <br>
    <br>
    <div class="client-title">
        <h3>CLIENT</h3>
    </div>

    <div class="client-link">
        <ul>
            <li><a href="<?= $textCfg['clientLink']?>" class="btn btn-link">Lin1</a></li>
        </ul>
    </div>

    <div class="patch-title">
        <h3>PATCH</h3>
    </div>

    <div class="patch-link">
        <ul>
            <li><a href="<?= $textCfg['pachLink1'] ?>" class="btn btn-link">Lin1</a></li>
            <li><a href="<?= $textCfg['pachLink2'] ?>" class="btn btn-link">Lin2</a></li>
            <li><a href="<?= $textCfg['pachLink3'] ?>" class="btn btn-link">Lin3</a></li>
        </ul>
    </div>

</div>