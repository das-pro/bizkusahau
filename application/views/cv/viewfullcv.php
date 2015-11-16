<?php
if (!isset($userinfo_user_id)) {
    $userinfo_user_id = current_user()->id;
}
$userbasicinfo = current_user($userinfo_user_id);
?>
<div id="fullcvtop">Autoupdates | Suggest Edits</div>



<div class="fullcvcontent">
    
    <ul id="tabs">
        <li><a href="#" name="#tab1">CV</a></li>
        <li><a href="#" name="#tab2">NOTEPAD</a></li>   
    </ul>

    <div id="bizcontent" class="divbg-white">

        <div id="tab1">
            <img src="<?php echo PROFILE_IMG_PATH.$userbasicinfo->profile_photo; ?>" class="pull-right" id="fullcvphoto"/>
            <div>
            <div class="cvfullviewrow" style="font-weight: bold; margin-bottom: 20px;"><?php echo $userbasicinfo->firstname . ' ' . $userbasicinfo->othername . ' ' . $userbasicinfo->lastname; ?></div>
            <div class="cvfullviewrow"><span class="cvlabel">Gender</span> : <?php echo $userbasicinfo->gender; ?></div> 
            <div class="cvfullviewrow"><span class="cvlabel">Phone</span> : <?php echo implode(', ', get_user_contact($userbasicinfo->id, 'MOBILE', false, true)); ?></div> 
            <div class="cvfullviewrow"><span class="cvlabel">Email</span> : <?php echo implode(', ', get_user_contact($userbasicinfo->id, 'EMAIL', false, true)); ?></div> 
            <div class="cvfullviewrow"><span class="cvlabel">Address</span> : <?php echo implode(', ', get_user_contact($userbasicinfo->id, 'POSTAL', false, true)); ?></div> 
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
        if($skl <> ''){
        echo '<span class="fullcvskillsview">'. $skl .'</span>';
        }
    }
}
?>
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





        <div id="tab2">
            <h2>NOTEPAD INFORMATION GOES HERE....</h2>
           
        </div>


    </div>
</div>



<script>
    function resetTabs() {
        jQuery("#bizcontent > div").hide(); //Hide all content
        jQuery("#tabs a").attr("id", ""); //Reset id's      
    }

    var myUrl = window.location.href; //get URL
    var myUrlTab = myUrl.substring(myUrl.indexOf("#")); // For localhost/tabs.html#tab2, myUrlTab = #tab2     
    var myUrlTabName = myUrlTab.substring(0, 4); // For the above example, myUrlTabName = #tab

    jQuery(function($) {
        $("#bizcontent > div").hide(); // Initially hide all content
        $("#tabs li:first a").attr("id", "bxcurrent"); // Activate first tab
        $("#bizcontent > div:first").fadeIn(); // Show first tab content

        $("#tabs a").on("click", function(e) {
            e.preventDefault();
            if ($(this).attr("id") == "bxcurrent") { //detection for current tab
                return
            }
            else {
                resetTabs();
                $(this).attr("id", "bxcurrent"); // Activate this
                $($(this).attr('name')).fadeIn(); // Show content for current tab
            }
        });

        for (i = 1; i <= $("#tabs li").length; i++) {
            if (myUrlTab == myUrlTabName + i) {
                resetTabs();
                $("a[name='" + myUrlTab + "']").attr("id", "bxcurrent"); // Activate url tab
                $(myUrlTab).fadeIn(); // Show url tab content        
            }
        }
    });
</script>