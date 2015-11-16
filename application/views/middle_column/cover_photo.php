<script src="<?php echo base_url(); ?>media/js/jquery-ui.min.js" type="text/javascript"></script>
<?php
if (isset($selected_user_id)) {
    $selected_user = current_user($selected_user_id);
} else {
    $selected_user = current_user();
}
$current_user = current_user();
?>
<div id="cover-photo">
    <div id="cover-photo-status">" <span class="profilestatus currentuser-profilestatus"><?php echo $selected_user->profilestatus; ?></span> "</div>

    <div id="cover-photo-bg">
        <?php
        if ($selected_user->profile_background <> '') {
            $bgposition = explode(":", $selected_user->profile_background_position);
            ?>

            <img style="left: <?php echo $bgposition[0] ?>; top: <?php echo $bgposition[1]; ?>; position:relative;" src="<?php echo PROFILE_IMG_PATH . $selected_user->profile_background; ?>">
        <?php } ?>
    </div>
    <div id="cover-photo-insideNav">
        <ul>
            <?php
            //Check security issue
            if ($current_user->id == $selected_user->id) {
                ?>
                <li class="biz-cam- biz-cam-camera"><a href="#" id="upload-bgPhoto"> <?php echo $selected_user->profile_background <> '' ? ' Change' : ' Add' ?> Cover Photo </a>
                    <form hidden="hidden" id="bgimageform" method="post" enctype="multipart/form-data" action="<?php echo site_url('ajax_uploadCoverPhoto') ?>">

                        <input type="file" name="bgphotoimg" id="bgphotoimg" class="custom-file-input">

                    </form>
                </li>
                <?php if ($current_user->status == 1) { ?>
                    <li class="biz-cam- biz-cam-camera"><a> Messages </a></li>

                    <?php
                }
            } else if ($current_user->id != $selected_user->id) {
                ?>
                <?php if ($selected_user->account_type == 'USER') { ?>
                    <li><a href="javascript:void(0);" class="send_frndrqst" userid="<?php echo $selected_user->id; ?>"> Connect </a></li> 
                    <li><a> Message </a></li> 
                <?php } else { ?>
                    <li class="biz-cam- "><a> Follow </a></li>
                <?php }
            }
            ?>
        </ul>
    </div>
    <!--<div id="cover-photo-linkicon">SSS</div>-->

    <div id="cover-photo-profilepic">
        <img class="user-photo currentuser-profile_photo" src="<?php echo PROFILE_IMG_PATH . $selected_user->profile_photo; ?>"/>
    </div>
    <?php
//check security issue
    if ($current_user->id == $selected_user->id) {
        ?>
        <div id="change-profile-photo"><div id="inside-changeprofile" class="biz-cam- biz-cam-camera">
                <form id="upload-userprofile" action="<?php echo site_url('ajax_uploadProfilePic'); ?>" method="post" enctype="multipart/form-dat">
                    <input type="file" style="height: 32px; cursor: pointer; width: 32px;" name="userphoto" id="userphoto-upload" class="userphoto-upload"/>
                </form>
            </div></div>
    <?php } ?>
    <div id="cover-photo-profilename">
        <div id="cover-photo-profilename-top"><?php if ($selected_user->status == 0) { ?><span id="cover-photo-welcome-text" class="text-bizhuru">Welcome! </span> <?php } ?><span class="user-fullname"><?php echo '<span class="currentuser-firstname">' . $selected_user->firstname . '</span>  <span class="currentuser-othername">' . $selected_user->othername . '</span> <span class="currentuser-lastname">' . $selected_user->lastname . '</span>' ?></span></div>
        <div id="cover-photo-profilename-bottom"><span class="user-position"><?php echo $selected_user->description; ?></span></div>
    </div>

    <div id="cover-photo-navLink">
        <?php if ($current_user->status == 1) { ?>
            <ul>
                <li>
                    <a>Test</a>
                </li>
                <li>
                    <a>Create Page</a>
                </li>

            </ul>
        <?php } ?>
        <div class="clearboth"></div>
    </div>

</div>

<div id="cover-photo-error"></div>

