<?php
if ($this->session->flashdata('message') != '') {
    echo $this->session->flashdata('message');
}else if(isset ($message)){
    echo $message;
}
$current_user_data = current_user();
?>
<div style="height: 5px;"></div>
<div id="account-setup-header">CREATE JOB POST</div>
<div id="timeline-container-wrapper">
    <div class="column260" style="width: 229px;">
        <?php include 'jobpost_leftcolumn.php'; ?>
    </div>
    <div class="column529" style="width: 560px;">
        <?php
        include 'jobpost_rightcolumn.php';
        ?>
    </div>
    <div class="clearboth"></div>
</div>