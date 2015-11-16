<?php
if(!isset($userinfo_user_id)){
  $userinfo_user_id = current_user()->id;  
}

$selected_userx = current_user($userinfo_user_id);

?>
<div style="padding-bottom: 30px; padding-left: 15px;">
    <?php if($selected_userx->status == 0 || $selected_userx->status == 1){ ?>
<div class="userinfo-title">CONTACT INFORMATION</div>

<?php
    }

$user_field_list = $this->user_field->contact_fields;

foreach ($user_field_list as $key => $value) {
    echo '<div id="'.$key.'-wrapper">';
  echo $this->user_field->{'view_'.$key}($userinfo_user_id);
    echo '</div>';
}
?>

</div>