<style type="text/css">
    .userinfo-label{
        width: 200px;
    } 
</style>
<?php
$current_user_verify = current_user();
?>
<div id="account-verificationdv">
    <span class="currentuser-firstname"><?php echo $current_user_verify->firstname; ?> </span>! Go to <span class="currentuser-email"><?php echo $current_user_verify->email; ?></span> to complete the sign-up process.
    <br/> <a href="javascript:void(0);" id="resend_email_accountverify">Re-send Email</a> &nbsp;  &nbsp; | &nbsp; &nbsp;  <a href="javascript:void(0);" id="account-verify-change-email">Change Email Address</a>
    <div id="change_emailaddress" style="margin-top: 20px;">
        </div>
</div>
<div id="account-setup-header">ACCOUNT SETUP AND APPROVAL</div>
<div  id="account-setup-container" class="divbg-white" style="border: 1px solid #ccc;">
    <div class="column260" style="border: 0px; width: 190px;">
      <div class="userinfo-title">BASIC INFORMATION</div>
    </div>
    <div class="column529" style="border: 0px; width: 580px; padding-top: 40px;">
      
            <div id="account-setup-content" style="border: 0px;">
                <?php
               
                    include VIEWPATH . '/userinfo/basic_info.php';
                
                ?>
        </div>
    </div>
    <div class="clearboth"></div>
</div>

<div  id="account-setup-container" class="divbg-white" style="border: 1px solid #ccc; min-height: fit-content !important; ">
    <div class="column260" style="border: 0px; width: 190px;">
      <div class="userinfo-title">CONTACT INFORMATION</div>
    </div>
    <div class="column529" style="border: 0px; width: 580px;">
      
            <div id="account-setup-content" style="border: 0px; padding-top: 40px;">
                <?php
               
                    include VIEWPATH . '/userinfo/user_contact.php';
                
                ?>
        </div>
    </div>
    <div class="clearboth"></div>
</div>

<!--<script type="text/javascript">

    jQuery.noConflict();
    jQuery(function($) {

        var outerHeight = $("#account-setup-container").height();
        $(".column260").css('min-height', outerHeight);
        $(".column529").css('min-height', outerHeight);
        $(".divbg-white").css('min-height', outerHeight);



    });

</script>-->
