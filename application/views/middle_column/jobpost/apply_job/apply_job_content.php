<?php
if ($this->session->flashdata('message') != '') {
    echo $this->session->flashdata('message');
}

$current_user_data = current_user();
?>

<div id="account-setup-header">JOB APPLICATIONS</div>
<div id="timeline-container-wrapper">
    <div class="column260">
        <?php include VIEWPATH.'middle_column/jobpost/view_jobpost/leftcolumn.php'; ?>
    </div>
    <div class="column529" style="padding-bottom: 100px;">
        <?php
        include 'rightcolumn.php';
        ?>
    </div>
    <div class="clearboth"></div>
</div>