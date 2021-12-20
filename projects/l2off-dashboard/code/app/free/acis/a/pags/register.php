<div class="rules">
    <article>
        <h4 class="text-center mt-3 title">RULES</h4>
        <ul>
            <li>
                <p><?= $textCfg['rule1'] ?></p>
            </li>
            <li>
                <p><?= $textCfg['rule2'] ?></p>
            </li>
            <li>
                <p><?= $textCfg['rule3'] ?></p>
            </li>
            <li>
                <p><?= $textCfg['rule4'] ?></p>
            </li>
        </ul>
    </article>
</div>
<div class="register">
    <h1>Account <i class="material-icons" id="admin-icon-click">verified_user</i></h1>
    <form method="POST" action="">
        <label class="sr-only" for="targetLogin">Login</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Max 16</div>
            </div>
            <input type="text" class="form-control" name="login" id="targetLogin" autocomplete="off" maxlength="16" placeholder="login">
        </div>

        <label class="sr-only" for="targetPassword">Password</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Min 4 Max 16</div>
            </div>
            <input type="password" class="form-control" name="password" id="targetPassword" autocomplete="off" maxlength="16" placeholder="password">
        </div>

        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" name="rules" class="custom-control-input" id="targetRules" value="true" required>
            <label class="custom-control-label" for="targetRules">Agree to terms and conditions</label>
        </div>
        
        <input type="hidden" name="token_user_recaptacha" id="token_recaptacha_id_register" value="">
        <input type="hidden" name="form_register" value="true">
        <input type="submit" class="btn btn-dark" value="Create">

        <?php /* Response */ ?>
        <?php if ($response['register']['success'] === true) { ?>
            <div class="alert mt-2 alert-success text-center" role="alert"><?= $response['register']['msg'] ?></div>
        <?php } ?>
        <?php if ($response['register']['error'] === true) { ?>
            <div class="alert mt-2 alert-danger text-center" role="alert"><?= $response['register']['msg'] ?></div>
        <?php } ?>

    </form>
</div>