<?php

if(!isset($userinfo_user_id)){
  $userinfo_user_id = current_user()->id;  
}

$education_cat = $this->common_model->education_cat()->result();
?>

<div style="padding-bottom: 30px; padding-left: 15px;">
    <?php
    foreach ($education_cat as $key => $value) { ?>
    <div class="education-title"><?php echo strtoupper($value->name); ?></div>
    <div class="text-brown edu_add_link"><a class="text-brown eduinfo-edit" pk="" userid="<?php echo $userinfo_user_id; ?>"  href="javascript:void(0);" cat="<?php echo $value->id; ?>"><div class="addplusx"> <i class="glyphicon glyphicon-plus"></i> </div> Add <?php echo $value->name; ?></a><span id="educatloader_add<?php echo $value->id.'-'; ?>"></span></div>
    <div  id="edu-wrapper-<?php echo $value->id.'-'; ?>"></div>
    
    <div id="xouter-<?php echo $value->id; ?>">
   
    <?php 
    
    echo $this->education->view($userinfo_user_id,$value->id);
    
    echo ' </div>';
    } ?>
    
   
</div>

