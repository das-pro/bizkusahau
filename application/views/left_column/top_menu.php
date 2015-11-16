<?php
$current_user = current_user();
?>
<ul class="main-menu-ul">
    <li><a href="#">
            <img class="currentuser-profile_photo" style="height: 30px; width: 30px;" src="<?php echo PROFILE_IMG_PATH.$current_user->profile_photo;  ?>"/>
            &nbsp; <span class="currentuser-firstname"><?php echo $current_user->firstname; ?></span>   <span class="currentuser-lastname"><?php echo $current_user->lastname; ?></span>
        </a></li>
</ul>
<div class="menu-diveder-line"></div>
<ul class="main-menu-ul">
    <li><a href="#"><i class="bizhuru- bizhuru-professional-feed"></i> Professional Feeds</a></li>
    <li><a href="#"><i class="bizhuru- bizhuru-messages"></i> Messages</a></li>
    <li><a href="<?php echo site_url('mystore'); ?>"><i class="bizhuru- bizhuru-mystore"></i> My Store</a></li>
    <li><a href="#"><i class="bizhuru- bizhuru-insight"></i> Insight</a></li>
</ul>
