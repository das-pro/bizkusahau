<?php
if (isset($selected_user_id)) {
    $selected_user = current_user($selected_user_id);
} else {
    $selected_user = current_user();
}
$current_user = current_user();
?>
<input id="wall_selected_user" type="hidden" value="<?php echo $selected_user->id; ?>"/>
<div class="timelinepost_input">
    <textarea id="inputpost" class="inputbizhuru inputautogrouw" placeholder="Keep it Professional.."></textarea>
    <div id="img_overview_post" style="display: none;">
        <div id="img_overview_post_list">
            
            <div class="clearboth"></div>
        </div>
        <div class="clearboth"></div>
        <input id="hidden_img_ids" type="hidden"  />
    </div>
    <div id="users_tags_input" style="display: none;">
        <input class="inputbizhuru" type="text"/>
    </div>
    <div id="inputpostfooter">
        <div id="post_action_icon" style="width: auto; margin-left:  20px;" class="pull-left">
            <form enctype="multipart/form-data" id="post_upoloadform" style="display: none;" action="<?php echo site_url('ajax_postimg_upload'); ?>" method="post">
                <input type="file" name="imgphotoupload" id="imgphotoupload_post"/>
            </form>
            <a href="javascript:void(0);" id="post_cameraclicked" class="glyphicon glyphicon-camera"><span id="post-loaderimg"></span></a> 
            <a href="javascript:void(0);" class="glyphicon glyphicon-user"></a>
        </div>
        <div style="width: auto;  display: inline-block; margin-right: 20px; margin-top:  3px;" class="pull-right">
            <button class="btnpost" id="user_postcontent"><i class="glyphicon glyphicon-ok"></i> Go</button>
        </div>
        <div class="clearboth"></div>
    </div>
    <div id="timeline_loader"></div>
</div>


<div id="timeline_wrapper">
    <?php
    echo $this->walllib->get_wallpost($selected_user->id);
    ?>
</div>













    
<script>
    jQuery(document).ready(function (){
      jQuery('.inputautogrouw').autogrow(); 
    });
</script>



 <script src="<?php echo base_url(); ?>media/js/timeline.js" type="text/javascript"></script>
   