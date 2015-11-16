<div class="divbg-white">

    <div class="education-title"> <?php echo 'JOB TITLE : ' . $jobpostinfo->jobtitle; ?></div>

    <div class="educationinfoform" style="background-color: #fff; border-bottom: 0px; margin-left:0px; margin-right: 0px;">
        <?php
        $posted_user = current_user($jobpostinfo->createdby);
        $location = $this->jobpost_model->get_jobpost_location($jobpostinfo->id)->row();
        $jobpost_target = $this->jobpost_model->get_jobpost_target($jobpostinfo->id)->row();
        $salaryinfo = $this->jobpost_model->get_jobpost_salary($jobpostinfo->id)->row();
        ?>

        <span class="pull-right text-bizhuru" style="font-size: 14px;"><?php
            $date = date('Y-m-d');
            if ($jobpostinfo->status == 2) {
                echo $deadline_text = '<b>CLOSED</b>';
            } else {
                echo $deadline_text = jobpost_remain_time($date, $jobpostinfo->deadline);
            }
            ?></span>
        <div style="padding-top: 10px; clear: both;">
            <div style="margin-top: -20px !important;">
                <img style="width: 100px; height: 100px; float: left; margin-right: 15px;" src="<?php echo PROFILE_IMG_PATH . $posted_user->profile_photo; ?>"/>
                <span style="display: block; width: 380px; margin-top: 20px; float: left; line-height: 25px; font-size: 18px;"><?php echo $posted_user->firstname . ' ' . $posted_user->lastname; ?>
                    <br/>


                </span>

                <div style="clear: both;"></div>
            </div>
        </div>


        <?php
        echo form_open('apply_job/?jobpost_id=' . $jobpost_id);
        $applying_question = $this->jobpost_model->get_jobpost_question($jobpostinfo->id, 1);
        if (count($applying_question) > 0) {
            ?>
            <div class="cvfullviewrow" style="font-weight: bold; margin-bottom: 10px; margin-top: 20px;"><span class="cvlabel">APPLYING QUESTION</span></div> 
            <?php foreach ($applying_question['section_cat'] as $key => $value) { ?>
                <div class="cvfullviewrow"> <span class="cvlabel"><?php
                        echo get_value('question_category', $value->quest_cat, 'name');
                        ?></span></div>  
                <div class="cvfullviewrow"> 
                    <ul class="jobpost_qn">
                        <?php
                        foreach ($applying_question['qn'][$value->quest_cat] as $key3 => $value3) {
                            ?> 
                            <li>
                                <span style="padding-left: 20px; display: block;"> <i style="margin-left: -20px; display: inline-block;" class="glyphicon glyphicon-star"></i> <?php echo get_value('question_list', $value3->qn_id, 'question'); ?></span>
                                <div>
                                    <textarea name="answer[<?php echo $value3->id ?>]" class="form-control answer_value"><?php echo (isset($feedback) ? $feedback[$value3->id] : ''); ?></textarea>
                                    <?php
                                    echo isset($feedback_error) ? '<div class="error">' . $feedback_error[$value3->id] . '</div>' : '';
                                    ?>
                                    <br/>
                                </div>

                            </li>

                        <?php } ?>
                    </ul> 



                </div> 

            <?php
            }
        } else {
            ?>
            <div class="cvfullviewrow" style="font-weight: bold; margin-bottom: 10px; margin-top: 20px;"><span class="cvlabel">APPLY JOB POST</span></div> 
            <div class="cvfullviewrow"> 
                <ul class="jobpost_qn">
                    <li>
                        <span style="padding-left: 20px; display: block;"> <i style="margin-left: -20px; display: inline-block;" class="glyphicon glyphicon-star"></i><?php echo DEFAULT_APPLY_QUESTION ?></span>
                        <div>
                            <textarea name="answer" class="form-control answer_value"><?php echo set_value('answer'); ?></textarea>
                        </div>

                    </li>   
                </ul>
            </div>
<?php } ?>

        <div style="text-align: center;">
            <input type="submit" name="mybutton" class="btn btn-sm btnsubmit mybutton" value="Apply Job"/>
        </div>
    </div>


<?php echo form_close(); ?>




</div>

<script type="text/javascript">
    jQuery("body").on("click", ".mybutton", function() {
        var empty = 0;
        
        jQuery(".answer_value").each(function(index,obj) {
            if(jQuery(obj).val() === ''){
                empty++;
            }

        });
        

        if (empty !== 0) {
            jAlert("Please fill all required field before apply this job", "BizHuru | Alert");
            return false;
        }
        return true;
    });

</script>