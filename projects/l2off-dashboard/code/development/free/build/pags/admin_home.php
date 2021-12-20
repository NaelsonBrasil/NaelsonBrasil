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


        <h1 class="text-light text-center welcome-admin mt-5">WELCOME ADMIN</h1>
        <!-- <button type="button" class="btn btn-success">Donate</button> -->

    </div> <!-- END ADMIN -->
</div><!-- END CONTENT -->