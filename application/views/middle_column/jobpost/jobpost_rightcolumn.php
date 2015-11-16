<div class="divbg-white" style="border: 1px solid #d6d7da;">

<?php

if ($tabinfo == 'jobpost_basic' || $tabinfo=='') {
    include 'jobpost_basic.php';
} else if ($tabinfo == 'jobpost_salary') {
    include 'jobpost_salary.php';
} else if ($tabinfo == 'jobpost_target') {
    include 'jobpost_target.php';
} else if ($tabinfo == 'jobpost_location') {
    include 'jobpost_location.php';
} else if ($tabinfo == 'jobpost_question') {
    include 'jobpost_question.php';
} else if ($tabinfo == 'jobpost_add_edit_question') {
    include 'jobpost_add_edit_question.php';
} else if ($tabinfo == 'jobpost_preview') {
    include 'jobpost_preview.php';
}
?>
</div>