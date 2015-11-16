<?php
$tabinfo = '';
if (isset($_GET['tabinfo'])) {
    $tabinfo = $_GET['tabinfo'];
}
$current_user = current_user();
?>
<div class="divbg-white middle-leftcolumn">
    <ul class="middle-ul">
        <li class=""><a href="#">Pinned (10)</a></li>
        <li><a href="#">Applied (10)</a></li>
        <?php
        $purchased = count_number_occurence('purchased_cv', 'id', array("purchaser = '$current_user->id'","(type='USER' OR type='PAGE')"));
        ?>
        <li class="<?php echo ($tabinfo == 'purchasetab' ? 'active-middle-link' : ''); ?>"><a href="<?php echo site_url('mystore/?tabinfo=purchasetab'); ?>">Purchased (<?php echo number_format($purchased); ?>)</a></li>
        <li><a href="#">Rejected (10)</a></li>
        <li><a href="#">Interviewed (10)</a></li>
        <li><a href="#">Dropped (10)</a></li>
        <li><a href="#">Job Offered (10)</a></li>
        <li><a href="#">Employed (10)</a></li>
        <li><a href="#">Deals (10)</a></li>
        <li><a href="#">Ex-Employed (10)</a></li>
    </ul>
    
</div>