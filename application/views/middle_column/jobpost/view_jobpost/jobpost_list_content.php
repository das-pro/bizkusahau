<?php
if ($this->session->flashdata('message') != '') {
    echo $this->session->flashdata('message');
}

$current_user_data = current_user();
?>

<div id="account-setup-header">JOBS & EMPLOYMENTS OPPORTUNITIES</div>
<div id="timeline-container-wrapper">
    <div class="column260">
        <?php include 'leftcolumn_joblist.php'; ?>
    </div>
    <div class="column529" style="padding-bottom: 100px;">
        <?php
        include 'rightcolumn_joblist.php';
        ?>
    </div>
    <div class="clearboth"></div>
</div>