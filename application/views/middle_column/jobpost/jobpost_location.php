<div class="education-title">OUR LOCATION & DIRECTION</div>
<?php echo form_open("jobpost/?tabinfo=jobpost_location&jobpost_id=" . $jobpost_id); ?>

<div class="educationinfoform" style="background-color: #fff; border-bottom: 0px; margin-left:0px; margin-right: 0px;">

     <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Address </div>
        <div class="userinfo-value-edit" style="line-height: 20px;">
            <textarea class="inputbizhuru" style="height: 100px;" name="address"><?php echo (isset($locationinfo) ? $locationinfo->address : set_value('address'));?></textarea>
            <?php echo form_error('address'); ?>
        </div>
        <div class="clearboth"></div>
    </div>
    
    
    
    <input type="hidden" name="jobpost_id" value="<?php echo (isset($jobpost_id) ? $jobpost_id : encode_id(0)); ?>"/>

    <div class="save_footer" >
         <?php if((isset($jobpostinfo) && $jobpostinfo->status == 0) || !isset($jobpostinfo)){ ?>
        <input  type="submit" name="savedata" value="Save Information" name="save" class="  btn btn-sm btnsubmit">
         <?php } ?>
        <a  class="btn btn-sm btncancel" href="<?php echo site_url('jobpost/?tabinfo=jobpost_question&jobpost_id=' . $jobpost_id); ?>">Skip</a> 
    </div>








</div>