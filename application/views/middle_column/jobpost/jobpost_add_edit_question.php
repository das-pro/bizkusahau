<div class="education-title">ADD & EDIT QUESTIONS</div>
<?php
$current_user = current_user();
echo form_open("jobpost/?tabinfo=jobpost_add_edit_question&jobpost_id=" . $jobpost_id);
?>

<div class="educationinfoform" style="background-color: #fff; border-bottom: 0px; margin-left:0px; margin-right: 0px;">
    <?php
    $section = $this->db->query("SELECT DISTINCT(qs.section_id) as id,os.name as name FROM jobpost_question as qs INNER JOIN question_section as os ON qs.section_id=os.id WHERE qs.jobpost_id=" . decode_id($jobpost_id))->result();
    foreach ($section as $key => $value) {
        ?>
        <div class="education-title" style="text-align: center;"><?php echo $value->name; ?></div>
        <?php
        $section2 = $this->db->query("SELECT DISTINCT(qs.quest_cat) as id,os.name as name FROM jobpost_question as qs INNER JOIN question_category as os ON qs.quest_cat=os.id WHERE os.section_id=$value->id AND qs.jobpost_id=" . decode_id($jobpost_id))->result();
        foreach ($section2 as $key2 => $value2) {
            ?> 
            <div class="education-title" style="font-size: 12px;"><?php echo $value2->name; ?></div> 
            <ul class="jobpost_qn">
                <?php
                $section3 = $this->db->query("SELECT os.*,qs.id as qnt_id  FROM  question_list as os INNER JOIN  jobpost_question as qs ON qs.qn_id=os.id WHERE qs.section_id=$value->id AND qs.quest_cat=$value2->id AND qs.jobpost_id=" . decode_id($jobpost_id))->result();
                foreach ($section3 as $key3 => $value3) {
                    $check = $this->db->get_where("jobpost_question", array('jobpost_id' => decode_id($jobpost_id), 'qn_id' => $value3->id))->row();
                    ?> 
                    <li><i class="glyphicon glyphicon-star"></i>
                        <span class="qn_left"><?php echo $value3->question; ?></span>
                        <span class="qnck pull-right"><a href="<?php echo site_url('jobpost/?tabinfo=jobpost_add_edit_question&jobpost_id=' . $jobpost_id . '&rmid=' . encode_id($value3->qnt_id)); ?>" class="rmid" style="color: #000;"><i class="glyphicon glyphicon-remove"></i></a></span>
                        <div style="clear: both;"></div>
                    </li>

                <?php } ?>
                <li style="text-align: center; padding-top: 5px;">
                     <?php if((isset($jobpostinfo) && $jobpostinfo->status == 0) || !isset($jobpostinfo)){ ?>
                    <a href="javascript:void(0);" style="color: brown;" id="linkno<?php echo $value2->id; ?>" cat="<?php echo $value2->id; ?>" class="openform"><i class="glyphicon glyphicon-plus" style="float: none;"></i> Add Your Own <?php echo ucwords(strtolower($value->name)); ?> Technical Question </a>
                    <div id="inputbox<?php echo $value2->id; ?>" style="display: none;">
                        Add Your Own <?php echo ucwords(strtolower($value->name)); ?> Technical Question<br/>
                        <textarea style="height: 50px;" name="newqn[<?php echo $value->id . '_' . $value2->id ?>]"  class="inputbizhuru"></textarea>

                    </div>
                     <?php }?>
                </li>
            </ul> <?php }
        } ?>



    <input type="hidden" name="jobpost_id" value="<?php echo (isset($jobpost_id) ? $jobpost_id : encode_id(0)); ?>"/>

    <div class="save_footer" >
         <?php if((isset($jobpostinfo) && $jobpostinfo->status == 0) || !isset($jobpostinfo)){ ?>
        <input  type="submit" name="savedata" value="Save Information" name="save" class="  btn btn-sm btnsubmit">
         <?php } ?>
        <a  class="btn btn-sm btncancel" href="<?php echo site_url('jobpost/?tabinfo=jobpost_preview&jobpost_id=' . $jobpost_id); ?>">Skip</a> 
    </div>







</div>

<script>
    jQuery(document).ready(function($) {

        $("body").on('click', '.rmid', function() {
            var conf = confirm('Are you sure you want to delete selected question ?');
            if (conf) {
                return true;
            }

            return false;
        });


        $("body").on('click', '.openform', function() {
            var cat = $(this).attr('cat');
            $("#inputbox" + cat).show();
            $("#linkno" + cat).hide();
        });


    });
</script>