<?php
$userbasicinfo = current_user($userinfo_user_id);
?>
<style>
    .modal-dialog{
        width: 800px; 
        top: 10px;
        z-index: 1002;
    }

    .modal-body{
        max-height: 500px;
        overflow: auto;

    }
</style>

<div class="modal-header">
    <button data-dismiss="modal" class="close  closepopup_cv"  type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
    <h4 id="myModalLabel" class="modal-title">CV :: <?php echo $userbasicinfo->firstname . ' ' . $userbasicinfo->othername . ' ' . $userbasicinfo->lastname; ?></h4>
</div>
<div class="modal-body">



    <img src="<?php echo PROFILE_IMG_PATH . $userbasicinfo->profile_photo; ?>" class="pull-right" id="fullcvphoto"/>
  
    <div>
        <div class="cvfullviewrow"><span class="cvlabel">Gender</span> : <?php echo $userbasicinfo->gender; ?></div> 
        <div class="cvfullviewrow"><span class="cvlabel">Phone</span> : <?php echo ($showfullcv == 1 ? implode(', ', get_user_contact($userbasicinfo->id, 'MOBILE', false, true)) : BUY_CV_TO_SEEINFO); ?></div> 
        <div class="cvfullviewrow"><span class="cvlabel">Email</span> : <?php echo ($showfullcv == 1 ? implode(', ', get_user_contact($userbasicinfo->id, 'EMAIL', false, true)) : BUY_CV_TO_SEEINFO); ?></div> 
        <div class="cvfullviewrow"><span class="cvlabel">Address</span> : <?php echo ($showfullcv == 1 ? implode(', ', get_user_contact($userbasicinfo->id, 'POSTAL', false, true)) : BUY_CV_TO_SEEINFO); ?></div> 
        <div class="cvfullviewrow"><span class="cvlabel">Nationality</span> : <?php echo $userbasicinfo->nationality; ?></div> 
        <div class="cvfullviewrow"><span class="cvlabel">Languages</span> : <?php echo $userbasicinfo->language; ?></div> 
        <div class="cvfullviewrow" style="font-weight: bold; margin-bottom: 10px; margin-top: 20px;"><span class="cvlabel">OVERVIEW</span></div>
        <?php
        $overview = get_user_workexperience($userbasicinfo->id);
//          echo '<pre>';
//          print_r($overview);
//          echo '</pre>';
        ?>
        <div class="cvfullviewrow"><span class="cvlabel">Titles</span> : <?php
            if (count($overview['TITLE']) > 0) {
                $title = '';
                foreach ($overview['TITLE'] as $key => $value) {
                    $title .= $value['name'] . ($value['experience'] <> '' ? '(' . number_format(($value['experience'] / 365), 1) . ')' : '') . ', ';
                }

                echo rtrim($title, ', ');
            };
            ?></div> 
        <div class="cvfullviewrow"><span class="cvlabel">Levels</span> :
            <?php
            if (count($overview['LEVEL']) > 0) {
                $title = '';
                foreach ($overview['LEVEL'] as $key => $value) {
                    $title .= $value['name'] . ($value['experience'] <> '' ? '(' . number_format(($value['experience'] / 365), 1) . ')' : '') . ', ';
                }

                echo rtrim($title, ', ');
            }
            ?></div> 
        <div class="cvfullviewrow"><span class="cvlabel">Departments</span> :    <?php
            if (count($overview['DEPARTMENT']) > 0) {
                $title = '';
                foreach ($overview['DEPARTMENT'] as $key => $value) {
                    $title .= $value['name'] . ($value['experience'] <> '' ? '(' . number_format(($value['experience'] / 365), 1) . ')' : '') . ', ';
                }

                echo rtrim($title, ', ');
            }
            ?></div> 
        <div class="cvfullviewrow"><span class="cvlabel">Current</span> :  <?php
            if (count($overview['CURRENT']) > 0) {
                $title = '';
                foreach ($overview['CURRENT'] as $key => $value) {
                    $title .= $value['name'] . ($value['experience'] <> '' ? '(' . number_format(($value['experience'] / 365), 1) . ')' : '') . ', ';
                }

                echo rtrim($title, ', ');
            }
            ?></div> 
        <div class="cvfullviewrow"><span class="cvlabel">Previous</span> : 
            <?php
            if (count($overview['PREVIOUS']) > 0) {
                $title = '';
                foreach ($overview['PREVIOUS'] as $key => $value) {
                    $title .= $value['name'] . ($value['experience'] <> '' ? '(' . number_format(($value['experience'] / 365), 1) . ')' : '') . ', ';
                }

                echo rtrim($title, ', ');
            }
            ?>
        </div> 
        <div class="cvfullviewrow"><span class="cvlabel">Industries</span> : <?php echo $userbasicinfo->language; ?></div> 
        <div class="cvfullviewrow"><span class="cvlabel">Total Experience</span> : 
            <?php
            if (count($overview['EXPERIENCE']) > 0) {
                $title = '';
                foreach ($overview['EXPERIENCE'] as $key => $value) {
                    $title .= ($value <> '' ? number_format(($value / 365), 1) . ' years' : '') . ', ';
                }

                echo rtrim($title, ', ');
            }
            ?>
        </div> 
        <div class="cvfullviewrow"><span class="cvlabel">Educational Awards</span> :
            <?php
            if (count($overview['EDUCATION']) > 0) {
                $title = '';
                foreach ($overview['EDUCATION'] as $key => $value) {
                    $title .= $value['name'] . ($value['experience'] <> '' ? '(' . number_format(($value['experience'] / 365), 1) . ')' : '') . ', ';
                }

                echo rtrim($title, ', ');
            }
            ?>
        </div> 

        <div class="cvfullviewrow" style="font-weight: bold; margin-bottom: 10px; margin-top: 20px;"><span class="cvlabel">SKILLS</span></div>

        <?php
        $skills_list = $this->common_model->get_user_skills($userinfo_user_id);
        $check_exist = array();
        foreach ($skills_list as $key => $value) {
            if (!in_array($value->skill_id, $check_exist)) {
                $skl = get_value('skills', $value->skill_id);
                if ($skl <> '') {
                    echo '<span class="fullcvskillsview">' . $skl . '</span>';
                }
            }
        }
        ?> <?php if ($showfullcv == 1) { ?>
            <div class="clearboth"></div>

            <div class="cvfullviewrow" style="font-weight: bold; margin-bottom: 10px; margin-top: 20px;"><span class="cvlabel">EMPLOYMENT</span></div>
            <style type="text/css">
                .work_listdiv{
                    margin: 0px;
                    padding-left:  20px;
                    font-size: 14px !important;
                    margin-bottom: 20px;

                }

                .work_item_content{
                    font-size: 14px !important;
                    color: #777;
                    padding-left: 10px;
                }
                .workform_data{
                    width: 650px;
                    padding-left: 10px;
                }
                .work_companytitle{
                    width: 650px; 
                }
                .skilllistcv{
                    font-weight: normal !important;
                    color: #000;
                }
            </style>
            <?php
            echo $this->work->public_view($userinfo_user_id);
            ?>

            <div class="cvfullviewrow" style="font-weight: bold; margin-bottom: 10px; margin-top: 20px;"><span class="cvlabel">EDUCATION</span></div>

            <?php
            $check = $this->db->query("SELECT DISTINCT education_cat as id FROM users_education WHERE user_id='$userinfo_user_id'")->result();
            foreach ($check as $key => $value) {
                ?>
                <div class="cvfullviewrow" style="font-weight: bold; text-align: center; text-transform: uppercase; margin-bottom: 20px;"><?php echo get_value('education_cat', $value->id); ?></div>
                <?php
                echo $this->education->public_view($userinfo_user_id, $value->id);
            }
            ?>

        </div>


    </div>
<?php } else {
    
    ?>
 
<div id="purchase_long_text">

 <?php echo BUY_CV_TO_SEEINFO_LONGTEXT; ?>
    <div style="width: 200px; margin-top: -30px;" class="pull-right">
    <span  id="addcart_loader" style="color: blue; height: 13px; margin-bottom: 5px; font-size: 11px; display: block;" ></span>
 <?php if(!is_cvno_exist_in_cart($userinfo_user_id)) { ?>
    <button  class="btn btn-small btnsubmit " account_type="<?php echo $userbasicinfo->account_type; ?>" cv_no="<?php echo $userinfo_user_id; ?>" id="add_to_cart_frompreview">Add to Cart</button>
 <?php }else{ ?>
    <span style="color: blue; height: 13px; margin-bottom: 5px; font-size: 11px; display: block;" ><img src="<?php echo base_url() ?>media/img/tick.png"/> Already added in cart</span>
 <?php }?>
    </div>
   
</div>
<?php } ?>
