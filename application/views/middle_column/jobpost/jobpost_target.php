
<div class="education-title">TARGETS</div>
<?php echo form_open("jobpost/?tabinfo=jobpost_target&jobpost_id=" . $jobpost_id); ?>

<div class="educationinfoform" style="background-color: #fff; border-bottom: 0px; margin-left:0px; margin-right: 0px;">
    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Professional Industry</div>
        <div class="userinfo-value-edit" style="line-height: 20px;">
            <?php
            $sel = (isset($targetinfo) ? explode(',', $targetinfo->industry) : (isset($_POST['industry']) ? $_POST['industry'] : array()) );
           
            ?>
            <select class="inputbizhuru " multiple="multiple" id="industry"  name="industry[]">
                <option value=""> -- Select --</option>
                <?php
                foreach (tags_data('professional_category', 'id', 'name', array('type' => 'PAGE')) as $key => $value) {
                    ?>
                <option <?php echo (in_array($value['id'],$sel) ? 'selected="selected"' : ''); ?> value="<?php echo $value['id']; ?>"><?php echo $value['text']; ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('industry[]'); ?>
        </div>
        <div class="clearboth"></div>
    </div>
    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Academic Category</div>
        <div class="userinfo-value-edit" style="line-height: 20px;">
            <select class="inputbizhuru" id="category" multiple="multiple" name="category[]">
                <option value=""> Select Category</option>
                <?php
                $professionalism = $this->common_model->get_professional_list(null, 0)->result();
                foreach ($professionalism as $key => $v) {
                    ?>

                    <optgroup label="<?php echo $v->name; ?>">
                        <?php
                        $sub = $this->common_model->get_professional_list(null, $v->id)->result();
                        $sel = (isset($targetinfo) ? combine_byhash(explode(',', $targetinfo->category), explode(',', $targetinfo->sub_category)) : (isset($_POST['category']) ? $_POST['category'] : array()) );
                        foreach ($sub as $sub_key => $sub_value) {
                            ?>
                        <option <?php echo (in_array($v->id . '#' . $sub_value->id,$sel) ? 'selected="selected"' : ''); ?>  value="<?php echo $v->id . '#' . $sub_value->id; ?>"><?php echo $sub_value->name; ?></option>
                        <?php } ?>
                    </optgroup>
                <?php } ?>
            </select>
            <?php echo form_error('industry[]'); ?>
        </div>
        <div class="clearboth"></div>
    </div>

    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Gender</div>
        <div class="userinfo-value-edit">
            All &nbsp;<input type="radio" value="" checked="checked" name="gender"/>
            &nbsp; &nbsp; Male &nbsp;<input <?php echo (isset($targetinfo) ? ($targetinfo->gender == 'Male' ? 'checked="checked"':''): (set_value('gender') == 'Male' ? 'checked="checked"':'')); ?> type="radio" value="Male" name="gender"/>
            &nbsp; &nbsp; Female &nbsp;<input <?php echo (isset($targetinfo) ? ($targetinfo->gender == 'Female' ? 'checked="checked"':''):(set_value('gender') == 'Female' ? 'checked="checked"':'')); ?> type="radio" value="Female" name="gender"/>
            <?php echo form_error('gender'); ?>
        </div>
        <div class="clearboth"></div>
    </div>

    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Age</div>
        <div class="userinfo-value-edit">
            <div class="clearboth"></div>
            <div style="display: inline-block; width: 130px;">
                Min<input type="text" value="<?php echo (isset($targetinfo) ? $targetinfo->min_age : set_value('min_age'));?>" class="inputbizhuru" name="min_age" style="width: 100px;"/>
                <?php echo form_error('min_age'); ?>
            </div> 
            <div style="display: inline-block; width: 130px;" >
                Max <input type="text" value="<?php echo (isset($targetinfo) ? $targetinfo->max_age : set_value('max_age'));?>" class="inputbizhuru" name="max_age" style="width: 100px;"/>
                <?php echo form_error('max_age'); ?>
            </div>
        </div>
        <div class="clearboth"></div>
    </div>

    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Nationality</div>
        <div class="userinfo-value-edit">
            <select class="inputbizhuru " id="nationality"  name="nationality">
                <option value=""> -- Select --</option>
                <?php
                $sel = (isset($targetinfo) ? $targetinfo->nationality : set_value('nationality'));
                foreach (tags_data('nationality', 'name', 'name') as $key => $value) {
                    ?>
                    <option <?php echo ($value['id'] == $sel ? 'selected="selected"' : ''); ?> value="<?php echo $value['id']; ?>"><?php echo $value['text']; ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('nationality'); ?>
        </div>
        <div class="clearboth"></div>
    </div>

    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Languages</div>
        <div class="userinfo-value-edit" style="line-height: 20px;">
            <select class="inputbizhuru " multiple="multiple" id="industry"  name="languages[]">
                <option value=""> -- Select --</option>
                <?php
                $sel = (isset($targetinfo) ? explode(',', $targetinfo->languages) : (isset($_POST['languages']) ? $_POST['languages'] : array()));
                foreach (tags_data('languages', 'name', 'name') as $key => $value) {
                    ?>
                    <option <?php echo (in_array($value['id'],$sel) ? 'selected="selected"' : ''); ?> value="<?php echo $value['id']; ?>"><?php echo $value['text']; ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('languages[]'); ?>
        </div>
        <div class="clearboth"></div>
    </div>
    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Location </div>
        <div class="userinfo-value-edit" style="line-height: 20px;">
            <input type="text" id="cityx" value="<?php echo (isset($targetinfo) ? $targetinfo->location : set_value('location'));?>" name="location" class=" inputbizhuru"/>
            <?php echo form_error('location'); ?>
        </div>
        <div class="clearboth"></div>
    </div>


    <input type="hidden" name="jobpost_id" value="<?php echo (isset($jobpost_id) ? $jobpost_id : encode_id(0)); ?>"/>

    <div class="save_footer" >
         <?php if((isset($jobpostinfo) && $jobpostinfo->status == 0) || !isset($jobpostinfo)){ ?>
        <input  type="submit" name="savedata" value="Save Information" name="save" class="  btn btn-sm btnsubmit">
         <?php } ?>
        <a  class="btn btn-sm btncancel" href="<?php echo site_url('jobpost/?tabinfo=jobpost_location&jobpost_id=' . $jobpost_id); ?>">Skip</a> 
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="dynamic" data-keyboard="false" >
        <div class="modal-dialog">
            <div class="modal-content"> <div style="height: 100px; line-height: 100px; text-align: center;"> <img src="<?php echo base_url(); ?>images/loader_round.gif"/> Loading....</div></div>
        </div>
    </div>







</div>

<script>
    jQuery(document).ready(function($) {

        $("#industry,#category,#nationality").select2();


    });
</script>

<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&language=en"></script>
<script>
    var input = document.getElementById("cityx");
    var autocomplete = new google.maps.places.Autocomplete(input);
</script>
