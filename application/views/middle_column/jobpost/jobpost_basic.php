
<div class="education-title">JOB POST BASIC INFORMATION</div>
<?php

echo form_open("jobpost/?tabinfo=jobpost_basic".(isset($jobpost_id) ? '&jobpost_id='.$jobpost_id:''));
?>
<div class="educationinfoform" style="background-color: #fff; border-bottom: 0px; margin-left:0px; margin-right: 0px;">
    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Listing Type</div>
        <div class="userinfo-value-edit">
            <select class="inputbizhuru" name="listing">
                <option value=""> -- Select --</option>
                <?php
                $sel = (isset($jobpostinfo) ? $jobpostinfo->listing : set_value('listing'));
                foreach (tags_data('jobpost_listing', 'id', 'name') as $key => $value) {
                    ?>
                    <option <?php echo ($value['id'] == $sel ? 'selected="selected"' : ''); ?> value="<?php echo $value['id']; ?>"><?php echo $value['text']; ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('listing'); ?>
        </div>
        <div class="clearboth"></div>
    </div>

    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Recruiter</div>
        <div class="userinfo-value-edit">
            <select class="inputbizhuru" name="recruiter">
                <option value=""> -- Select --</option>
                <?php
                $sel = (isset($jobpostinfo) ? $jobpostinfo->recruiter : set_value('recruiter'));
                foreach (tags_data('jobpost_recruiter', 'id', 'name') as $key => $value) {
                    ?>
                    <option <?php echo ($value['id'] == $sel ? 'selected="selected"' : ''); ?> value="<?php echo $value['id']; ?>"><?php echo $value['text']; ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('recruiter'); ?>
        </div>
        <div class="clearboth"></div>
    </div>

    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Academic Levels</div>
        <div class="userinfo-value-edit" style="line-height:20px !important;">

            <select multiple="multiple" class="inputbizhuru multiselectejQuery"  name="academic_level[]">

                <?php
                $sel = (isset($jobpostinfo) ? explode(',', $jobpostinfo->academic_level) : (isset($_POST['academic_level']) ? $_POST['academic_level'] : array()) );
                foreach (tags_data('education_award', 'id', 'name') as $key => $value) {
                    ?>
                    <option   <?php echo (in_array($value['id'], $sel) ? 'selected="selected"' : ''); ?> value="<?php echo $value['id']; ?>"><?php echo $value['text']; ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('academic_level[]'); ?>
        </div>
        <div class="clearboth"></div>
    </div>
    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Academic Qualifications</div>
        <div class="userinfo-value-edit" style="line-height: 20px !important;">

            <select multiple="multiple" class="inputbizhuru skills_tag"  name="academic[]">

                <?php
                $sel = (isset($jobpostinfo) ? explode(',',$jobpostinfo->academic) : (isset($_POST['academic']) ? $_POST['academic'] : array()) );
                foreach (tags_data('programme', 'id', 'name') as $key => $value) {
                    ?>
                    <option   <?php echo (in_array($value['id'], $sel) ? 'selected="selected"' : ''); ?> value="<?php echo $value['id']; ?>"><?php echo $value['text']; ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('academic[]'); ?>

        </div>
        <div class="clearboth"></div>
    </div>

    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Minimum Experience</div>
        <div class="userinfo-value-edit"><input type="text" placeholder="Number of Years e.g 4" name="experience" value="<?php echo (isset($jobpostinfo) ? $jobpostinfo->experience : set_value('experience')); ?>"   class="inputbizhuru"  />
            
        <div class="clearboth"></div>
<div style="font-size:10px; line-height:normal; ">(In years)</div>
            <?php echo form_error('experience'); ?>
        </div>
        <div class="clearboth"></div>
    </div>

    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Job Tittle</div>
        <div class="userinfo-value-edit"><input type="text" name="jobtitle" value="<?php echo (isset($jobpostinfo) ? $jobpostinfo->jobtitle : set_value('jobtitle')); ?>"  class="inputbizhuru"  />

            <?php echo form_error('jobtitle'); ?>
        </div>
        <div class="clearboth"></div>
    </div>
    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Level</div>
        <div class="userinfo-value-edit">
            <select class="inputbizhuru" name="level">
                <option value=""> -- Select --</option>
                <?php
                $sel = (isset($jobpostinfo) ? $jobpostinfo->level : set_value('level'));
                foreach (tags_data('work_level', 'id', 'name') as $key => $value) {
                    ?>
                    <option <?php echo ($value['id'] == $sel ? 'selected="selected"' : ''); ?>  value="<?php echo $value['id']; ?>"><?php echo $value['text']; ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('level'); ?>
        </div>
        <div class="clearboth"></div>
    </div>
    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Hours (Status)</div>
        <div class="userinfo-value-edit">
            <select class="inputbizhuru" name="position_type">
                <option value=""> -- Select --</option>
                <?php
                $sel = (isset($jobpostinfo) ? $jobpostinfo->position_type : set_value('position_type'));

                foreach (tags_data('position_type', 'id', 'name') as $key => $value) {
                    ?>
                    <option <?php echo ($value['id'] == $sel ? 'selected="selected"' : ''); ?> value="<?php echo $value['id']; ?>"><?php echo $value['text']; ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('position_type'); ?>
        </div>
        <div class="clearboth"></div>
    </div>
    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Job Post Introduction</div>
        <div class="userinfo-value-edit">
            <textarea style="height:100px; line-height:18px;" class="inputbizhuru allowfullscreen" name="jobpost_introduction" id="jobpost_introduction" ><?php echo (isset($jobpostinfo) ? $jobpostinfo->introduction : set_value('jobpost_introduction')); ?></textarea>
            <a href="javascript:void(0);" targettitle="Job Post Introduction" target="jobpost_introduction" class="open_bootbox glyphicon glyphicon-fullscreen"></a>

            <?php echo form_error('jobpost_introduction'); ?>
            <div class="clearboth"></div>
        </div>
        <div class="clearboth"></div>
    </div>
    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Job Description</div>
        <div class="userinfo-value-edit">

            <textarea style="height:100px; line-height:18px;" class="inputbizhuru allowfullscreen" name="jobpost_description" id="job_description" ><?php echo (isset($jobpostinfo) ? $jobpostinfo->description : set_value('job_description')); ?> </textarea>
            <a href="javascript:void(0);" targettitle="Job Description" target="job_description" class="open_bootbox glyphicon glyphicon-fullscreen"></a>
            <div class="clearboth"></div>
            <div style="font-size:10px; line-height:normal; margin-top:-10px;">(Every responsibility should start in new line)</div>
            <?php echo form_error('job_description'); ?>
        </div>
        <div class="clearboth"></div>
    </div>
    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Skills Required:</div>
        <div class="userinfo-value-edit" style="line-height:20px !important;">
            <select class="inputbizhuru skills_tag" multiple="" style="height: 15px;" name="skills[]">

                <?php
                $sel = (isset($jobpostinfo) ? explode(',',$jobpostinfo->skills) : (isset($_POST['skills']) ? $_POST['skills'] : array()) );
                foreach (tags_data('skills', 'id', 'name') as $key => $value) {
                    ?>
                    <option  <?php echo (in_array($value['id'], $sel) ? 'selected="selected"' : ''); ?> value="<?php echo $value['id']; ?>"><?php echo $value['text']; ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('skills[]'); ?>
        </div>
        <div class="clearboth"></div>
    </div>
    <input type="hidden" name="jobpost_id" value="<?php echo (isset($jobpost_id) ? $jobpost_id : encode_id(0)); ?>"/>

    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Deadline:</div>
        <div class="userinfo-value-edit">
            <select class="inputbizhuruauto"  name="year">
                <option value="">Year</option>
                <?php 
                $sel = (isset($jobpostinfo) ? date('Y',  strtotime($jobpostinfo->deadline)) : set_value('year'));
                for ($x = date('Y'); $x < (date('Y') + 2); $x++) { ?>

                    <option <?php echo ($x == $sel ? 'selected="selected"' : ''); ?>  value="<?php echo $x; ?>"> <?php echo $x ?></option>;
                <?php } ?>
            </select>

            <select  class="inputbizhuruauto" name="month">
                <option value="">Month</option>
                <?php
                 $sel = (isset($jobpostinfo) ? date('m',  strtotime($jobpostinfo->deadline)) : set_value('month'));
                foreach (monthlist() as $ky => $vx) { ?>
                    <option <?php echo ($ky == $sel ? 'selected="selected"' : ''); ?> value="<?php echo $ky; ?>"><?php echo $vx ?></option>';
                <?php } ?> 
            </select>
            <select class="inputbizhuruauto" name="day">
                <option value="">Day</option>
                <?php
                 $sel = (isset($jobpostinfo) ? date('d',  strtotime($jobpostinfo->deadline)) : set_value('day'));
                for ($x = 1; $x < 32; $x++) { ?>
                    <option  <?php echo ($x == $sel ? 'selected="selected"' : ''); ?>  value="<?php echo $x; ?>"> <?php echo $x; ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('deadline'); ?>
        </div>
        <div class="clearboth"></div>
    </div>
    <div class="save_footer" >
        <?php if((isset($jobpostinfo) && $jobpostinfo->status == 0) || !isset($jobpostinfo)){ ?>
        <input  type="submit" name="savedata" value="Save Information" name="save" class="  btn btn-sm btnsubmit">
        <?php } if(isset($jobpostinfo)){ ?>
        
         <a  class="btn btn-sm btncancel" href="<?php echo site_url('jobpost/?tabinfo=jobpost_salary&jobpost_id=' . $jobpost_id); ?>">Skip</a> 
         <?php } ?>
    </div>


</div>

<script>





    jQuery(document).ready(function($) {

        $(function() {
            $(".multiselectejQuery").select2();
        });

        $(".skills_tag").select2({
            tags: true,
            multiple: true,
            tokenSeparators: [',', ',']

        });




    });
</script>