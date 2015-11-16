<?php
if ($this->session->flashdata('message') != '') {
    echo $this->session->flashdata('message');
}

$current_user_data = current_user();
?>
<div style="height: 5px;"></div>
<div id="account-setup-header">MY STORE CV</div>
<div id="timeline-container-wrapper">
    <div class="column260" style="width: 229px;">
        <?php include 'mystore_leftcolumn.php'; ?>
    </div>
    <div class="column529" style="width: 560px;">
        <?php
        include 'mystore_rightcolumn.php';
        ?>
    </div>
    <div class="clearboth"></div>
</div>