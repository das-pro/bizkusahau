<div class="divbg-white middle-leftcolumn">

    <ul class="joblist_category">
         <li><a href="<?php echo site_url('jobpost_list/'); ?>"><i class="" ></i> Job Posts Category</a></li>
        <?php
        $active_jobpost_cat = '';
        if(isset($_GET['cat_id'])){
         $active_jobpost_cat = decode_id($_GET['cat_id']);  
        }
        $cvx_list = $this->common_model->get_professional_list(null, 0, 'PAGE')->result();
        foreach ($cvx_list as $key => $value) {
            ?>
         <li><a class="<?php echo ($active_jobpost_cat== $value->id ? 'left_active_link':''); ?>" href="<?php echo site_url('jobpost_list/?cat_id=' . encode_id($value->id)) ?>"><i class="<?php echo $value->css; ?>" ></i> <?php echo $value->name . ' (' . number_format(count_jobpost_bycategory($value->id)) . ')'; ?></a></li>
        <?php } ?> 
    </ul>

</div>



