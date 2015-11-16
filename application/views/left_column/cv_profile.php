<?php
$filterinfo = 'cvtab';
if (isset($_GET['filterinfo'])) {
    $filterinfo = $_GET['filterinfo'];
}
?>
<div class="menu-title">
    <ul id="tabs_menu">
        <li class="liR"><a  href="<?php echo site_url('filter_cv/?filterinfo=cvtab') ?>" id="<?php echo ($filterinfo == 'cvtab' ? 'filtertabcurrent' : ''); ?>" name="#tab_cv">CV</a></li>
        <li class="liL"><a  href="<?php echo site_url('filter_cv/?filterinfo=profiletab') ?>"  id="<?php echo ($filterinfo == 'profiletab' ? 'filtertabcurrent' : ''); ?>" name="#tab_profile">PROFILES</a></li>   
    </ul>
</div>
<?php if ($filterinfo == 'cvtab') { ?>
    <div id="tab_cv">
        <ul class="main-menu-ul" style="margin-left: 20px;">
            <?php
            $cvx_list = $this->common_model->get_professional_list(null, 0)->result();
            foreach ($cvx_list as $key => $value) {
                ?>
            <li><a href="<?php echo site_url('filter_cv/?filterinfo=cvtab&catid='.encode_id($value->id)) ?>"><i class="<?php echo $value->css; ?>" ></i> <?php echo $value->name; ?></a></li>
            <?php } ?>
        </ul>
    </div>
<?php } else if ($filterinfo == 'profiletab') { ?>

    <div id="tab_profile" >
        <ul class="main-menu-ul" style="margin-left: 20px;">
            <?php
            $cvx_list = $this->common_model->get_professional_list(null, 0, 'PAGE')->result();
            foreach ($cvx_list as $key => $value) {
                ?>
            <li><a href="<?php echo site_url('filter_cv/?filterinfo=profiletab&catid='.encode_id($value->id)) ?>"><i class="<?php echo $value->css; ?>" ></i> <?php echo $value->name; ?></a></li>
            <?php } ?> 
        </ul>
    </div>
<?php } ?>

<script>
//    function resetMenuTabs() {
//        jQuery("#tabs_menu-content > div").hide(); //Hide all content
//        jQuery("#tabs_menu a").attr("id", ""); //Reset id's      
//    }
//
//    var myUrl = window.location.href; //get URL
//    var myUrlTab = myUrl.substring(myUrl.indexOf("#")); // For localhost/tabs.html#tab2, myUrlTab = #tab2     
//    var myUrlTabName = myUrlTab.substring(0, 4); // For the above example, myUrlTabName = #tab
//
//    jQuery(function($) {
//        $("#tabs_menu-content > div").hide(); // Initially hide all content
//        $("#tabs_menu-content li:first a").attr("id", "filtertabcurrent"); // Activate first tab
//        $("#tabs_menu-content > div:first").fadeIn(); // Show first tab content
//
//        $("#tabs_menu a").on("click", function(e) {
//           // e.preventDefault();
//            if ($(this).attr("id") == "filtertabcurrent") { //detection for current tab
//                return
//            }
//            else {
//                resetMenuTabs();
//                $(this).attr("id", "filtertabcurrent"); // Activate this
//                $($(this).attr('name')).fadeIn(); // Show content for current tab
//            }
//        });
//
//        for (i = 1; i <= $("#tabs_menu li").length; i++) {
//            if (myUrlTab == myUrlTabName + i) {
//                resetTabs();
//                $("a[name='" + myUrlTab + "']").attr("id", "filtertabcurrent"); // Activate url tab
//                $(myUrlTab).fadeIn(); // Show url tab content        
//            }
//        }
//    });
</script>