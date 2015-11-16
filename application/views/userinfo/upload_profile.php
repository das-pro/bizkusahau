<div style="padding-bottom: 30px; padding-left: 15px;">
<div class="userinfo-title">SET YOUR DECENT PHOTO</div>
<?php
$selected_user = current_user();
?>

<div id="cover-photo-profilepic-userinfo">
        <img class="user-photo currentuser-profile_photo" src="<?php echo PROFILE_IMG_PATH . $selected_user->profile_photo; ?>"/>
    </div>

<div id="change-profile-photo-userinfo"><div id="inside-changeprofile" class="biz-cam- biz-cam-camera">
                <form id="upload-userprofile" action="<?php echo site_url('ajax_uploadProfilePic'); ?>" method="post" enctype="multipart/form-dat">
                    <input type="file" style="height: 32px; cursor: pointer; width: 32px;" name="userphoto" id="userphoto-upload" class="userphoto-upload"/>
                </form>
            </div></div>

<div style="text-align: center; margin-top: 40px;">
    <?php if($selected_user->status == 0){ ?>
    <a href="<?php echo site_url('accountverification'); ?>" class="btn btn-sm btnsubmit">NEXT STEP</a>
    <?php } ?>
</div>
</div> 