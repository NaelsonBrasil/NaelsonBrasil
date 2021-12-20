<?= verifyCookie($db, "?pag=main"); ?>

<div class="ad-main" id="adm-open">
    <!-- BEGIN CONTENT -->

    <div class="icon-admin" id="admin-click">
        <i class="material-icons" id="admin-icon-click">arrow_back</i>
    </div>

    <div class="admin">
        <!-- BEGIN ADMIN -->

        <div class="menu-admin">
            <nav>
                <ul>
                    <li><a href="?pag=admin-home">Admin Home</a></li>
                    <li><a href="?pag=admin-unlock">Unlock Char</a></li>
                    <li><a href="?pag=admin-password">Change Password</a></li>
                    <li><a href="?pag=admin-recover-pw">Recover &Others</a></li>
                    <li><a href="?pag=admin-contact">Contact</a></li>
                </ul>
            </nav>
        </div>


        <div class="pw-change">

            <h5 class="text-primary text-center">UNLOCK PASSWORD</h5>

            <form method="POST" action="">

                <?php if (isset($_COOKIE["w-login"])) $count = count(selectCharacters($db, $_COOKIE["w-login"])); ?>
                <div class="form-group">
                    <select name="char_n" class="form-control form-control-sm">
                        <?php for ($i = 0; $i < $count; $i++) { ?>
                            <option value="<?= selectCharacters($db, $_COOKIE["w-login"])[$i][0]; ?>"><?= selectCharacters($db, $_COOKIE["w-login"])[$i][0]; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <?php $spawUnlocked = explode(";", $textCfg['spawnUnlocked']); ?>
                <input type="hidden" name="loc_x" value="<?= $spawUnlocked[0] ?>">
                <input type="hidden" name="loc_y" value="<?= $spawUnlocked[1] ?>">
                <input type="hidden" name="loc_z" value="<?= $spawUnlocked[2] ?>">
                
                <input type="hidden" name="token_user_recaptacha" id="token_recaptacha_id" value="">
                <input type="hidden" name="form_unlock" value="true">
                <button type="submit" class="btn w-100 btn-dark">Active Unlock</button>

                <?php /* Response */ ?>
                <?php if ($response['unlock']['success'] === true) { ?>
                    <div class="alert mt-2 alert-success text-center" role="alert"><?= $response['unlock']['msg'] ?></div>
                <?php } ?>
                <?php if ($response['unlock']['error'] === true) { ?>
                    <div class="alert mt-2 alert-danger text-center" role="alert">Error</div>
                <?php } ?>

            </form>
        </div>


    </div> <!-- END ADMIN -->
</div><!-- END CONTENT -->