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

            <h5 class="text-primary text-center">Contact</h5>

            <form method="POST" action="">

                <div class="form-group">
                    <label for="target_email">Your Email</label>
                    <input type="email" class="form-control" name="email" id="target_email" maxlength="50" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="target_message">Message</label>
                    <textarea class="form-control" name="message" maxlength="500" id="target_message" rows="3"></textarea>
                </div>

                <input type="hidden" name="form_contact" value="true">
                <input type="submit" class="btn w-100 btn-dark" value="Send">

                <?php /* Response */ ?>
                <?php if ($response['contact']['success'] === true) { ?>
                    <div class="alert mt-2 alert-success text-center" role="alert">Success</div>
                <?php } ?>
                <?php if ($response['contact']['error'] === true) { ?>
                    <div class="alert mt-2 alert-danger text-center" role="alert">Error</div>
                <?php } ?>

            </form>
        </div>

    </div> <!-- END ADMIN -->
</div><!-- END CONTENT -->