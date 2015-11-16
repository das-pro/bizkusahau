<div class="divbg-white">
  
<div class="education-title"> <?php echo 'JOB TITLE : '.$jobpostinfo->jobtitle; ?></div>

<div class="educationinfoform" style="background-color: #fff; border-bottom: 0px; margin-left:0px; margin-right: 0px;">
    <?php
    $posted_user = current_user($jobpostinfo->createdby);
    $location = $this->jobpost_model->get_jobpost_location($jobpostinfo->id)->row();
    $jobpost_target = $this->jobpost_model->get_jobpost_target($jobpostinfo->id)->row();
    $salaryinfo = $this->jobpost_model->get_jobpost_salary($jobpostinfo->id)->row();
    
    ?>
    
   <span class="pull-right text-bizhuru" style="font-size: 14px;"><?php
        $date = date('Y-m-d');
        if($jobpostinfo->status == 2){
          echo $deadline_text =   '<b>CLOSED</b>';  
        }else{
       echo $deadline_text =  jobpost_remain_time($date, $jobpostinfo->deadline);
        }
        ?></span>
    <div style="padding-top: 10px; clear: both;">
        <div style="margin-top: -20px !important;">
        <img style="width: 100px; height: 100px; float: left; margin-right: 15px;" src="<?php echo PROFILE_IMG_PATH.$posted_user->profile_photo; ?>"/>
        <span style="display: block; width: 380px; margin-top: 20px; float: left; line-height: 25px; font-size: 18px;"><?php echo $posted_user->firstname.' '.$posted_user->lastname; ?>
            <br/>
            
           
        </span>
      
        <div style="clear: both;"></div>
        </div>
    </div>
    
    <div class="cvfullviewrow" style="font-weight: bold; margin-bottom: 10px; margin-top: 20px;"><span class="cvlabel">INTRODUCTION</span></div> 
    <div class="cvfullviewrow"> <?php echo $jobpostinfo->introduction ?>.</div> 
    
     <div class="cvfullviewrow" style="font-weight: bold; margin-bottom: 10px; margin-top: 20px;"><span class="cvlabel">JOB TITLE : <?php echo $jobpostinfo->jobtitle; ?></span></div>
  
<div class="cvfullviewrow"><span class="cvlabel">Location </span> : <?php echo ($location)? $location->address:'Any Location'; ?></div> 
<div class="cvfullviewrow"><span class="cvlabel">Job Title </span> : <?php echo $jobpostinfo->jobtitle; ?></div> 
<div class="cvfullviewrow"><span class="cvlabel">Level </span> : <?php echo get_value('work_level', $jobpostinfo->level, 'name'); ?></div> 
<div class="cvfullviewrow"><span class="cvlabel">Hours (Status) </span> : <?php echo get_value('position_type', $jobpostinfo->position_type, 'name'); ?></div> 
<div class="cvfullviewrow"><span class="cvlabel">Gender </span> : <?php echo ($jobpost_target->gender <> '' ? $jobpost_target->gender : 'All'); ?></div> 
<div class="cvfullviewrow"><span class="cvlabel">Minimum Experience </span> : <?php echo $jobpostinfo->experience.' Yrs.'?></div> 
<div class="cvfullviewrow"><span class="cvlabel">Education </span> : <?php $edu_level = explode(',',$jobpostinfo->academic_level);
$edu_level_tmp=''; 
foreach ($edu_level as $key => $value) {
     $edu_level_tmp.= get_value('education_award', $value,'name').', ';
 }
 echo rtrim($edu_level_tmp,', ');
?></div> 

<div class="cvfullviewrow"><span class="cvlabel">Industry </span> : <?php $industry = ($jobpost_target ? explode(',',$jobpost_target->industry) :array());
$industry_tmp=''; 
foreach ($industry as $key => $value) {
     $industry_tmp.= get_value('professional_category', $value,'name',array('type'=>'PAGE')).', ';
 }
 echo rtrim($industry_tmp,', ');
?></div> 

<div class="cvfullviewrow"><span class="cvlabel">Field (Category) </span> : <?php $industry = ($jobpost_target ? combine_byhash(explode(',', $jobpost_target->category), explode(',', $jobpost_target->sub_category)) :array());
$industry_tmp=''; 
foreach ($industry as $key => $value) {
    $exp = explode('#', $value);
     $industry_tmp.= get_value('professional_category', $exp[0],'name').' - '.get_value('professional_category', $exp[1],'name') .', ';
 }
 echo rtrim($industry_tmp,', ');
?></div> 


<div class="cvfullviewrow"><span class="cvlabel">Languages </span> : <?php echo ($jobpost_target ? $jobpost_target->languages : '') ?></div> 
<div class="cvfullviewrow"><span class="cvlabel">Salary </span> : <?php echo ($salaryinfo ? number_format($salaryinfo->amount,2).'/= '.$salaryinfo->currency.' <m style="color:#000;">'.$salaryinfo->salary_type.'</m>' : 'Negotiable') ?></div> 
<div class="cvfullviewrow"><span class="cvlabel">Benefits </span> : <?php $benefit =  ($salaryinfo ? ($salaryinfo->is_benefit ==1 ? explode(',', $salaryinfo->benefit) : 'N/A') : 'N/A') ?>

<?php 
if(is_array($benefit)){
    $benefit_tmp='';
    foreach ($benefit as $key => $value) {
      $benefit_tmp.= get_value('jobpost_benefit', $value,'name').', ';
    }  
     echo rtrim($benefit_tmp,', ');
}else{
    echo $benefit;
}
?>
</div> 
<div class="cvfullviewrow"><span class="cvlabel">Recruiter </span> : <?php echo get_value('jobpost_recruiter', $jobpostinfo->recruiter, 'name'); ?></div> 
 

<div class="cvfullviewrow" style="font-weight: bold; margin-bottom: 10px; margin-top: 20px;"><span class="cvlabel">JOB DESCRIPTIONS</span></div>
<div class="cvfullviewrow ">
    <?php
     // echo $description = explode("\n",$jobpostinfo->description);
       $display ='<div class="work_disp_skills"><span class="skilllistcv-content jobpost_preview">';
            if($jobpostinfo->description <> ''){
               $display .='<ul style="margin-bottom:0px;padding-bottom:0px;">';

            $explod_content = explode("\n", $jobpostinfo->description);
            foreach ($explod_content as $keyx => $valuex) {
                $display.='<li>' . $valuex . '</li>';
            }
            $display.= '</ul>';
            }
               $display .='</span><div class="clearboth"></div></div>';
               
               echo $display;
    ?>
</div> 
<?php 
  
  $applying_question = $this->jobpost_model->get_jobpost_question($jobpostinfo->id,1);
 
  if(count($applying_question) > 0){ ?>
     <div class="cvfullviewrow" style="font-weight: bold; margin-bottom: 10px; margin-top: 20px;"><span class="cvlabel">APPLYING QUESTION</span></div> 
     <?php
      foreach ($applying_question['section_cat'] as $key => $value) { ?>
     <div class="cvfullviewrow"> <span class="cvlabel"><?php
     echo get_value('question_category', $value->quest_cat, 'name');
     ?></span></div>  
     <div class="cvfullviewrow"> 
     <ul class="jobpost_qn">
                <?php
                foreach ($applying_question['qn'][$value->quest_cat] as $key3 => $value3) {
                   
                    ?> 
                <li>
                    <span style="padding-left: 20px; display: block;"> <i style="margin-left: -20px; display: inline-block;" class="glyphicon glyphicon-star"></i> <?php echo get_value('question_list', $value3->qn_id, 'question');?></span>
                    
                </li>

        <?php } ?>
            </ul> 
     
     
     
     </div> 
     
     <?php } }
     
     $current_user = current_user();
     if(trim($deadline_text) != '<b>CLOSED</b>' && $jobpostinfo->status == 1){?>
     <div style="text-align: center; font-size: 15px; font-weight: bold;">
         <?php if(!is_applied($current_user->id,$jobpostinfo->id)){ ?>
         <a href="<?php echo site_url('apply_job/?jobpost_id='.  encode_id($jobpostinfo->id)); ?>" class="text-bizhuru" style="">Apply Now</a>
         &nbsp; &nbsp; | &nbsp; &nbsp; <?php } ?> <a href="<?php echo site_url('share_job/?jobpost_id='.  encode_id($jobpostinfo->id)); ?>" class="text-bizhuru" style="">Share</a>
     
     </div>
      <?php }
     
     
     ?>


</div>
    
    
    
    
    
    
    
</div>