
<h2>Hello <?php echo $current_user->firstname . ' ' . $current_user->lastname; ?></h2>
Thanks for signing up!.
<br/><br/>
Your account has been created, Click  in the link below to activate your account for fully BizHuru access.<br/>
    LINK : <a href="<?php echo site_url('account_activation/?id=' . encode_id($current_user->id) . '&code=' . $current_user->confirm_code) ?>">Activation Link</a>


<br/>
<br/>
    Your login email address is : <span style="color: brown; font-size: 16px;"><?php echo $current_user->email; ?></span>

<br/>
<br/>

    Regards,<br/>
    BizHuru Team<br/>
    NIC Investment House<br/>
    13th Floor Samora / Mirambo Avenue<br/>
    Dar es Salaam, Tanzania

