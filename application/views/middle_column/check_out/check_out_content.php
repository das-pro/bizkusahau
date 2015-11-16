<?php
if ($this->session->flashdata('message') != '') {
    echo $this->session->flashdata('message');
}

$current_user_data = current_user();
?>
<div id="timeline-container-wrapper">
    <div class="column260">
        <?php include 'checkout_leftcolumn.php'; ?>
    </div>
    <div class="column529">
        <?php
        include 'checkout_rightcolumn.php';
        ?>
    </div>
    <div class="clearboth"></div>
</div>