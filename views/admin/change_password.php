<div class="container">

    <?php if ($user->verified === 0): //? User has not verified email?>

    <form id="sendValidationEmailForm" action="/admin/mail_verification" method="POST" class="mt-2">
        <input type="text" name="email"
            value="<?php echo $user->email/* Attribute Escaping Required */ ?>"
            hidden>
        <input type="submit" value="Verify Email" class="btn btn-dark">
    </form>

    <?php else:?>

    <?php if($id && $verif_code)://? Reset Password Request Recevied?>

    <form id="passwordResetForm" action="/admin/change-password" method="POST">
        <input type="password" name="password" id="password" placeholder="Password">
        <input type="password" name="c_password" id="c_password" placeholder="Confirm Password">

        <input type="hidden" name="id"
            value="<?php echo $request->param("id") ?>">
        <input type="hidden" name="verif_code"
            value="<?php echo $request->param("verif_code") ?>">
        <input type="submit" value="Password Reset">
    </form>

    <?php else: //? Send Password Reset Request?>

    <form id="passwordResetRequestForm" action="/admin/change-password/request" method="POST">
        <input type="email" name="email" id="email" placeholder="Email">
        <input type="submit" value="Password Reset">
    </form>

    <?php endif;?>

    <?php endif;?>
</div>