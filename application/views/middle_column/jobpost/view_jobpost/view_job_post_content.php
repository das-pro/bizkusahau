<?php
if ($this->session->flashdata('message') != '') {
    echo $this->session->flashdata('message');
}

$current_user_data = current_user();
?>

<div id="account-setup-header">JOB POST VIEW IN DETAILS</div>
<div id="timeline-container-wrapper">
    <div class="column260">
        <?php include 'leftcolumn.php'; ?>
    </div>
    <div class="column529" style="padding-bottom: 100px;">
        <?php
        include 'rightcolumn.php';
        ?>
    </div>
    <div class="clearboth"></div>
</div>