<div class="education-title">QUESTIONS</div>
<?php 
$current_user = current_user();
echo form_open("jobpost/?tabinfo=jobpost_question&jobpost_id=" . $jobpost_id); 

?>

<div class="educationinfoform" style="background-color: #fff; border-bottom: 0px; margin-left:0px; margin-right: 0px;">
    <?php
    $section = $this->db->get('question_section')->result();
    foreach ($section as $key => $value) {
        ?>
        <div class="education-title" style="text-align: center;"><?php echo $value->name; ?></div>
        <?php
        $section2 = $this->db->query("SELECT * FROM question_category WHERE section_id= '$value->id' AND ( user_id=0 OR user_id=$current_user->id )")->result();
        foreach ($section2 as $key2 => $value2) {
            ?> 
            <div class="education-title" style="font-size: 12px;"><?php echo $value2->name; ?></div> 
            <ul class="jobpost_qn">
                <?php
                $section3 = $this->db->query("SELECT * FROM question_list WHERE section_id = $value->id AND quest_cat =  $value2->id AND ( user_id=0 OR user_id=$current_user->id ) ")->result();
                foreach ($section3 as $key3 => $value3) {
                    $check = $this->db->get_where("jobpost_question",array('jobpost_id'=>  decode_id($jobpost_id),'qn_id'=>$value3->id))->row();
                    ?> 
                <li><i class="glyphicon glyphicon-star"></i>
                    <span class="qn_left"><?php echo $value3->question; ?></span>
                    <span class="qnck pull-right"><input name="qn[]" type="checkbox" <?php echo ($check ? 'checked="checked"':''); ?> value="<?php echo $value3->id ?>"/></span>
                    <div style="clear: both;"></div>
                </li>

        <?php } ?>
            </ul> <?php } } ?>



    <input type="hidden" name="jobpost_id" value="<?php echo (isset($jobpost_id) ? $jobpost_id : encode_id(0)); ?>"/>

    <div class="save_footer" >
         <?php if((isset($jobpostinfo) && $jobpostinfo->status == 0) || !isset($jobpostinfo)){ ?>
        <input  type="submit" name="savedata" value="Save Information" name="save" class="  btn btn-sm btnsubmit">
         <?php } ?>
        <a  class="btn btn-sm btncancel" href="<?php echo site_url('jobpost/?tabinfo=jobpost_add_edit_question&jobpost_id=' . $jobpost_id); ?>">Skip</a> 
    </div>







</div>