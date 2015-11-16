<?php
$step = '';
if (isset($_GET['step'])) {
    $step = $_GET['step'];
}
?>
<div id="account-setup-header">ACCOUNT SETUP AND APPROVAL</div>
<div  id="account-setup-container">
    <div class="column260">
        <div class="divbg-white">

            <ul class="middle-ul">
                <li class="<?php echo ($step == 1 ? 'active-middle-link' : ($step == '' ? 'active-middle-link' : '' )); ?>">
                    <a class="change_url" href="<?php echo site_url('gettingstarted/?step=1'); ?>">Personal Information<span class="active-middle-linkimg"></span></a>
                </li> 
                <li class="<?php echo ($step == 2 ? 'active-middle-link' : ''); ?>">
                    <a class="change_url"  href="<?php echo site_url('gettingstarted/?step=2'); ?>">Contact Information<span class="active-middle-linkimg"></span></a>
                </li> 
                <li class="<?php echo ($step == 3 ? 'active-middle-link' : ''); ?>">
                    <a class="change_url"  href="<?php echo site_url('gettingstarted/?step=3'); ?>">Upload Profile/CV Photo<span class="active-middle-linkimg"></span></a>
                </li> 
            </ul>

        </div>
    </div>
    <div class="column529">
        <div class="divbg-white ">
            <div id="account-setup-content">
                <?php
                if ($step == 2) {
                    include VIEWPATH . '/userinfo/user_contact.php';
                } else if ($step == 3) {
                    include VIEWPATH . '/userinfo/upload_profile.php';
                } else {
                    include VIEWPATH . '/userinfo/basic_info.php';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="clearboth"></div>
</div>



<script type="text/javascript">

    jQuery.noConflict();
    jQuery(function($) {

        var outerHeight = $("#account-setup-container").height();
        $(".column260").css('min-height', outerHeight);
        $(".column529").css('min-height', outerHeight);
        $(".divbg-white").css('min-height', outerHeight);



    });

</script>
