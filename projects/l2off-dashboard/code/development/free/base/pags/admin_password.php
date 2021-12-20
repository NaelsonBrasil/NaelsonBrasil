<?= verifyCookie($db, "?pag=main"); ?>
<div class="ad-main" id="adm-open">
    <div>
        <div class="icon-admin" id="admin-click">
            <i class="material-icons" id="admin-icon-click">arrow_back</i>
        </div><!-- BEGIN CONTENT -->
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

                <h5 class="text-primary text-center">CHANGE PASSWORD</h5>

                <form method="POST" action="">

                    <div class="form-group">
                        <label for="target_email">Email</label>
                        <input type="email" class="form-control" name="email" id="target_email" maxlength="50" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="target_pw_old">Old Password</label>
                        <input type="password" class="form-control" name="old_password" id="target_pw_old" maxlength="16" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="target_password_new">Your New Password</label>
                        <input type="password" class="form-control" name="new_password" id="target_password_new" maxlength="16" autocomplete="off">
                    </div>
                    
                    <input type="hidden" name="token_user_recaptacha" id="token_recaptacha_id" value="">
                    <input type="hidden" name="form_change_password" value="true">
                    <input type="submit" class="btn w-100 btn-dark" value="Send">

                    <?php /* Response */ ?>
                    <?php if ($response['change_password']['success'] === true) { ?>
                        <div class="alert mt-2 alert-success text-center" role="alert"><?= $response['change_password']['msg'] ?></div>
                    <?php } ?>
                    <?php if ($response['change_password']['error'] === true) { ?>
                        <div class="alert mt-2 alert-danger text-center" role="alert">Error</div>
                    <?php } ?>

                </form>
            </div>


        </div> <!-- END ADMIN -->
    </div><!-- END CONTENT -->
</div>