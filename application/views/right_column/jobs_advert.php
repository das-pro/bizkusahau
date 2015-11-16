<div id="right_column_pannel_advert">
<?php

$jobs_advert = $this->jobpost_model->job_adverts();

if(count($jobs_advert) > 0){
    foreach ($jobs_advert as $key => $value) { 
        $user_poster = current_user($value->createdby);
        ?>
        
<div class="jobs_advert_div" >
    <div class="jobs_advert_logo">
        <a href="<?php echo site_url('timeline/'.$user_poster->username); ?>"><img src="<?php echo PROFILE_IMG_PATH.$user_poster->profile_photo; ?>"  class="timeline-user-img"/></a>
    </div>
    <div class="jobs_advert_content">
        <div><a href="<?php echo site_url('timeline/'.$user_poster->username); ?>" class="text-bizhuru" style="text-transform: uppercase; font-size: 10px; font-weight: bold;"><?php echo $user_poster->firstname.' '.$user_poster->lastname; ?></a></div>
        <div style="font-size: 10px;"><?php echo date('l H:i, d M Y ',  strtotime($value->publishedon)); ?></div>
        <div style="font-size: 10px;"><?php echo word_extract($value->introduction).'.......'; ?></div>
        <div style="font-size: 10px; text-align: right;"><a class="text-bizhuru" href="<?php echo site_url('view_jobpost/?jobpost_id='.  encode_id($value->id)); ?>">Read more</a></div>
    </div>
    <div class="clearboth"></div>
</div> 
    <?php } ?>

 
<?php }else{ ?>

 <div id="no_jobpost_available">No new job post currently available </div>

<?php } ?>

</div>

