<?php
$tabinfo = '';
if (isset($_GET['tabinfo'])) {
    $tabinfo = $_GET['tabinfo'];
}
?>
<div class="divbg-white middle-leftcolumn">
    <ul class="middle-ul" style="min-height: 100px;">
       
        <li class="<?php echo (($tabinfo == 'jobpost_basic' || $tabinfo == '') ? 'active-middle-link' : ''); ?>"><a href="<?php echo site_url('jobpost/?tabinfo=jobpost_basic'.(isset($jobpost_id) ? '&jobpost_id='.$jobpost_id:'')); ?>">Job Basics</a></li>
        <?php if(isset($jobpost_id)){ ?>
        <li class="<?php echo (($tabinfo == 'jobpost_salary' || $tabinfo == '') ? 'active-middle-link' : ''); ?>"><a href="<?php echo site_url('jobpost/?tabinfo=jobpost_salary&jobpost_id='.$jobpost_id); ?>">Salary & Benefits</a></li>
        <li class="<?php echo (($tabinfo == 'jobpost_target' || $tabinfo == '') ? 'active-middle-link' : ''); ?>"><a href="<?php echo site_url('jobpost/?tabinfo=jobpost_target&jobpost_id='.$jobpost_id); ?>">Targets</a></li>
        <li class="<?php echo (($tabinfo == 'jobpost_location' || $tabinfo == '') ? 'active-middle-link' : ''); ?>"><a href="<?php echo site_url('jobpost/?tabinfo=jobpost_location&jobpost_id='.$jobpost_id); ?>">Our Location & Direction</a></li>
        <li class="<?php echo (($tabinfo == 'jobpost_question' || $tabinfo == '') ? 'active-middle-link' : ''); ?>"><a href="<?php echo site_url('jobpost/?tabinfo=jobpost_question&jobpost_id='.$jobpost_id); ?>">Questions</a></li>
        <li class="<?php echo (($tabinfo == 'jobpost_add_edit_question' || $tabinfo == '') ? 'active-middle-link' : ''); ?>"><a href="<?php echo site_url('jobpost/?tabinfo=jobpost_add_edit_question&jobpost_id='.$jobpost_id); ?>">Add & Edit Question</a></li>
        <li class="<?php echo (($tabinfo == 'jobpost_preview' || $tabinfo == '') ? 'active-middle-link' : ''); ?>"><a href="<?php echo site_url('jobpost/?tabinfo=jobpost_preview&jobpost_id='.$jobpost_id); ?>">Preview & Post</a></li>
        <?php } ?>
    </ul>
    
</div>