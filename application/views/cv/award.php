<?php

if(!isset($userinfo_user_id)){
  $userinfo_user_id = current_user()->id;  
}

?>

<div style="padding-bottom: 30px; padding-left: 15px;">
 
    <div class="education-title">AWARDS</div>
    <div class="text-brown edu_add_link"><a class="text-brown awardinfo-edit" pk="" userid="<?php echo $userinfo_user_id; ?>"  href="javascript:void(0);"><div class="addplusx"> <i class="glyphicon glyphicon-plus"></i> </div> Add Award</a><span id="awardloader_add<?php echo $userinfo_user_id.'-'; ?>"></span></div>
    <div  id="award-wrapper-<?php echo $userinfo_user_id.'-'; ?>"></div>
    <div id="award-xouter-<?php echo $userinfo_user_id; ?>">
    <?php 
    
   echo $this->award->view($userinfo_user_id);
    
     ?>
    </div>
</div>