<?php

if(!isset($userinfo_user_id)){
  $userinfo_user_id = current_user()->id;  
}

?>

<div style="padding-bottom: 30px; padding-left: 15px;">
 
    <div class="education-title">EMPLOYMENT</div>
    <div class="text-brown edu_add_link"><a class="text-brown workinfo-edit" pk="" userid="<?php echo $userinfo_user_id; ?>"  href="javascript:void(0);"><div class="addplusx"> <i class="glyphicon glyphicon-plus"></i> </div> Add Employment History</a><span id="workloader_add<?php echo $userinfo_user_id.'-'; ?>"></span></div>
    <div  id="work-wrapper-<?php echo $userinfo_user_id.'-'; ?>"></div>
    <div id="work-xouter-<?php echo $userinfo_user_id; ?>">
    <?php 
    
    echo $this->work->view($userinfo_user_id);
    
     ?>
    </div>
</div>