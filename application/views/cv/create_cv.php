               
<?php
$tabinfo = '';
if (isset($_GET['tabinfo'])) {
    $tabinfo = $_GET['tabinfo'];
}
?>
<div id="account-setup-header">MY CV</div>
<div  id="account-setup-container">
    <div class="column260">
        <div class="divbg-white">
          
            <ul class="middle-ul">
                <li class="<?php echo (($tabinfo == '' || $tabinfo == 'basic_info') ? 'active-middle-link' : ''); ?>">
                    <a class="change_url" href="<?php echo site_url('create_cv/?tabinfo=basic_info'); ?>">Personal Information<span class="active-middle-linkimg"></span></a>
                </li> 
                <li class="<?php echo ($tabinfo == 'education' ? 'active-middle-link' : ''); ?>">
                    <a class="change_url"  href="<?php echo site_url('create_cv/?tabinfo=education'); ?>">Education<span class="active-middle-linkimg"></span></a>
                </li> 
                <li class="<?php echo ($tabinfo == 'work' ? 'active-middle-link' : ''); ?>">
                    <a class="change_url"  href="<?php echo site_url('create_cv/?tabinfo=work'); ?>">Employment<span class="active-middle-linkimg"></span></a>
                </li> 
                <li class="<?php echo ($tabinfo == 'award' ? 'active-middle-link' : ''); ?>">
                    <a class="change_url"  href="<?php echo site_url('create_cv/?tabinfo=award'); ?>">Awards<span class="active-middle-linkimg"></span></a>
                </li> 
                <li>
                    <a   href="<?php echo site_url('view_cv/?cvid='. encode_id(current_user()->id)); ?>">View full CV<span class="active-middle-linkimg"></span></a>
                </li> 
            </ul>

        </div>
    </div>
    <div class="column529">
        <div class="divbg-white ">
            <div id="account-setup-content">
                <?php
                
                if($tabinfo == 'education') {
                    include 'education.php';
                } else if ($tabinfo == 'award') {
                    include 'award.php';
                } else if ($tabinfo == 'work') {
                    include 'work.php';
                } else if ($tabinfo == 'viewfullcv') {
                    include 'viewfullcv.php';
                } else {
                    include 'basic_info.php';
                }
                
                ?>
            </div>
        </div>
    </div>
    <div class="clearboth"></div>
</div>


<script type="text/javascript">

    jQuery.noConflict();
    jQuery(function($) {

        var outerHeight = $("#account-setup-container").height();
       
        $(".column260").css('min-height', outerHeight);
        $(".column529").css('min-height', outerHeight);
        $(".divbg-white").css('min-height', outerHeight);
        
       var innerHeight = $(".column529").height();
       
      if(innerHeight > outerHeight){
        $(".column260").css('min-height', innerHeight);
        $(".column529").css('min-height', innerHeight);
        $(".divbg-white").css('min-height', innerHeight); 
        $("#account-setup-container").css('min-height', innerHeight); 
      }


    });

</script>


<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&language=en"></script>
 
