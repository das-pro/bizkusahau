<div class="menu-title">ADD & EDITS</div>
<ul class="main-menu-ul">
    <li><a class="<?php echo (isset($left_active_link) ? ($left_active_link == 'create_cv' ? 'left_active_link':''):'') ?>" href="<?php echo site_url('create_cv'); ?>"><i class="bizhuru- bizhuru-settings" ></i> Create or Edit CV</a></li>
    <li><a href="#"><i class="bizhuru- bizhuru-settings" ></i> Create Work Posts</a></li>
    <!--<li><a href="#"><i class="bizhuru- bizhuru-settings"></i> Create Job Posts</a></li>-->
     <li><a class="<?php echo (isset($left_active_link) ? ($left_active_link == 'jobpost' ? 'left_active_link':''):'') ?>" href="<?php echo site_url('jobpost'); ?>"><i class="bizhuru- bizhuru-settings" ></i> Create Job Posts</a></li>
    <li><a href="#"><i class="bizhuru- bizhuru-settings"></i> Create Adverts</a></li>
</ul>