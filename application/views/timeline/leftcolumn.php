<div id="middleleftcontentfix" style="padding-bottom: 50px;">
<?php
if (isset($selected_user_id)) {
    $selected_user = current_user($selected_user_id);
} else {
    $selected_user = current_user();
}
$current_user = current_user();
?>

<div class="divbg-white middle-leftcolumn">
    <div class="titlediv">Ranking</div>

    <div class="row_icon_middleleftcolumn">
        <div class="icon_data_middleleftcolumn">
            <div class="img_middleleftcolumn">
                <span class="img_img pull-left"><i class=" bhuru- bhuru-complement"></i></span><span class="img_count pull-right">20000001</span></div>
            <div class="clearboth"></div>
            <div class="img_desctiption_title">COMPLIMENTS</div>
        </div>
        <div class="icon_data_middleleftcolumn pull-right">
            <div class="img_middleleftcolumn">
                <span class="img_img pull-left"><i class=" bhuru- bhuru-connect"></i></span><span class="img_count pull-right">20000001</span></div>
            <div class="clearboth"></div>
            <div class="img_desctiption_title">CONNECTS</div>
        </div>
        <div class="clearboth"></div>
    </div>
    <div class="row_icon_middleleftcolumn">
        <div class="icon_data_middleleftcolumn">
            <div class="img_middleleftcolumn">
                <span class="img_img pull-left"><i class=" bhuru- bhuru-posts"></i></span><span class="img_count pull-right"><?php echo number_format($selected_user->post_count); ?></span></div>
            <div class="clearboth"></div>
            <div class="img_desctiption_title">POSTS</div>
        </div>
        <div class="icon_data_middleleftcolumn pull-right">
            <div class="img_middleleftcolumn">
                <span class="img_img pull-left"><i class=" bhuru- bhuru-comments"></i></span><span class="img_count pull-right"><?php echo number_format($selected_user->comment_count); ?></span></div>
            <div class="clearboth"></div>
            <div class="img_desctiption_title">COMMENTS</div>
        </div>
        <div class="clearboth"></div>
    </div>

    <?php
    if ($current_user->id == $selected_user->id) {
        ?>
        <div class="titlediv_middleleftcolumn">
            Job <div></div>
        </div>

        <div class="row_icon_middleleftcolumn">
            <div class="icon_data_middleleftcolumn">
                <div class="img_middleleftcolumn">
                    <span class="img_img pull-left"><i class=" bhuru- bhuru-applied"></i></span><span class="img_count pull-right">0</span></div>
                <div class="clearboth"></div>
                <div class="img_desctiption_title">APPLIED</div>
            </div>
            <div class="icon_data_middleleftcolumn pull-right">
                <div class="img_middleleftcolumn">
                    <span class="img_img pull-left"><i class=" bhuru- bhuru-interviews"></i></span><span class="img_count pull-right">0</span></div>
                <div class="clearboth"></div>
                <div class="img_desctiption_title">INTERVIEWED</div>
            </div>
            <div class="clearboth"></div>
        </div>
        <div class="row_icon_middleleftcolumn">
            <div class="icon_data_middleleftcolumn">
                <div class="img_middleleftcolumn">
                    <span class="img_img pull-left"><i class=" bhuru- bhuru-dropped"></i></span><span class="img_count pull-right">0</span></div>
                <div class="clearboth"></div>
                <div class="img_desctiption_title">DROPPED</div>
            </div>
            <div class="icon_data_middleleftcolumn pull-right">
                <div class="img_middleleftcolumn">
                    <span class="img_img pull-left"><i class=" bhuru- bhuru-job-offers"></i></span><span class="img_count pull-right">0</span></div>
                <div class="clearboth"></div>
                <div class="img_desctiption_title">JOB OFFERED</div>
            </div>
            <div class="clearboth"></div>
        </div>
        <div class="row_icon_middleleftcolumn">
            <div class="icon_data_middleleftcolumn">
                <div class="img_middleleftcolumn">
                    <span class="img_img pull-left"><i class=" bhuru- bhuru-employment"></i></span><span class="img_count pull-right">0</span></div>
                <div class="clearboth"></div>
                <div class="img_desctiption_title">EMPLOYED</div>
            </div>
            <div class="icon_data_middleleftcolumn pull-right">
                <div class="img_middleleftcolumn">
                    <span class="img_img pull-left"><i class=" bhuru- bhuru-exemployed"></i></span><span class="img_count pull-right">0</span></div>
                <div class="clearboth"></div>
                <div class="img_desctiption_title">Ex-EMPLOYED</div>
            </div>
            <div class="clearboth"></div>
        </div>




    <?php } ?>
</div>

<br/>
<div class="divbg-white middle-leftcolumn">
    <div class="titlediv"><span class="pull-left"><br/>CV </span><span class="pull-right" style="font-size: 11px;">
            Active : <span id="userlast_active"><?php echo online_user($selected_user->id); ?></span><br/>
            Covered : 0%
        </span>

        <div class="clearboth"></div>
    </div>
    
    <div class="middle_leftcolumn_cv_row">
        <span class="span1">First name :</span> 
        <span class="span2"> <?php echo $selected_user->firstname; ?></span> 
         <div class="clearboth"></div>
    </div>
    <div class="middle_leftcolumn_cv_row">
        <span class="span1">Last name :</span> 
        <span class="span2"><?php echo $selected_user->lastname; ?></span> 
         <div class="clearboth"></div>
    </div>
    
     <div class="middle_leftcolumn_cv_row">
        <span class="span1">Other name :</span> 
        <span class="span2"> <?php echo $selected_user->othername; ?></span> 
         <div class="clearboth"></div>
    </div>
    <div class="middle_leftcolumn_cv_row">
        <span class="span1">Gender :</span> 
        <span class="span2"><?php echo $selected_user->gender; ?></span> 
         <div class="clearboth"></div>
    </div>
    <?php if($current_user->id == $selected_user->id){ ?>
    <div class="middle_leftcolumn_cv_row">
        <span class="span1">Birth Date :</span> 
        <span class="span2"><?php echo $selected_user->dob_md; ?></span> 
         <div class="clearboth"></div>
    </div>
    <div class="middle_leftcolumn_cv_row">
        <span class="span1">Birth Year :</span> 
        <span class="span2"><?php echo $selected_user->dob_y; ?></span> 
         <div class="clearboth"></div>
    </div>
    
    <?php } ?>
    
    <div class="middle_leftcolumn_cv_row">
        <span class="span1">Language(s) :</span> 
        <span class="span2"> <?php echo $selected_user->language;?></span> 
         <div class="clearboth"></div>
    </div>
    
    <?php
    $experience = get_user_workexperience($selected_user->id,null,null,null,'CURRENT');
    ?>
    
    <div class="middle_leftcolumn_cv_row">
        <span class="span1">Position(Current) :</span> 
        <span class="span2">
            <?php
                if (count($experience['TITLE']) > 0) {
                    $title = '';
                    foreach ($experience['TITLE'] as $key => $value) {
                        $title .= $value['name'] . ($value['experience'] <> '' ? '(' . number_format(($value['experience'] / 365), 1) . ')' : '') . ', ';
                    }

                    echo rtrim($title, ', ');
                };
                ?>
        </span> 
         <div class="clearboth"></div>
    </div>
    <div class="middle_leftcolumn_cv_row">
        <span class="span1">Level(Current) :</span> 
        <span class="span2">
             <?php
                if (count($experience['LEVEL']) > 0) {
                    $title = '';
                    foreach ($experience['LEVEL'] as $key => $value) {
                        $title .= $value['name'] . ($value['experience'] <> '' ? '(' . number_format(($value['experience'] / 365), 1) . ')' : '') . ', ';
                    }
                    echo rtrim($title, ', ');
                }?>
        </span> 
         <div class="clearboth"></div>
    </div>
    <div class="middle_leftcolumn_cv_row">
        <span class="span1">Department(Current) :</span> 
        <span class="span2">
             <?php
                if (count($experience['DEPARTMENT']) > 0) {
                    $title = '';
                    foreach ($experience['DEPARTMENT'] as $key => $value) {
                        $title .= $value['name'] . ($value['experience'] <> '' ? '(' . number_format(($value['experience'] / 365), 1) . ')' : '') . ', ';
                    }

                    echo rtrim($title, ', ');
                }
                ?>
        </span> 
         <div class="clearboth"></div>
    </div>
    
    <div style="text-align: center; margin-bottom: 10px; margin-top: 10px;">
        <!--<a href="#" class="text-brown"></a>-->
        
        <a data-toggle="modal" class="text-brown" data-remote="<?php echo site_url('preview_cv/?cvid='.  encode_id($selected_user->id)) ?>" href="<?php echo site_url('preview_cv/?cvid='.  encode_id($selected_user->id)) ?>" data-target="#myModal" class="preview_userCV">
        <i class="glyphicon glyphicon-file"></i> See full CV
        </a>
</a>
        
        
        
        
       <?php if($selected_user->id == $current_user->id){ ?> 
        &nbsp;   &nbsp; | &nbsp;  &nbsp;  <a href="<?php echo site_url('create_cv'); ?>" class="text-brown"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
       <?php } ?>
    
    </div>
    
</div>

</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="dynamic" data-keyboard="false" >
    <div class="modal-dialog">
        <div class="modal-content"> <div style="height: 100px; line-height: 100px; text-align: center;"> <img src="<?php echo base_url(); ?>images/loader_round.gif"/> Loading....</div></div>
    </div>
</div>


<script type="text/javascript">


    var last_seen = setInterval(function (){
    var str = "userid=<?php echo $selected_user->id; ?>";
            jQuery.ajax({
            type: "POST",
                    url: SITE_URL + "ajax_is_online?type=long",
                    data: str,
                    dataType: 'json',
                    cache: false,
                    success: function(data) {
                    if (data.server_status === 1){
                    jQuery("#userlast_active").html(data.msg);
                    }
                }
                    });
            }, 5000);

</script>