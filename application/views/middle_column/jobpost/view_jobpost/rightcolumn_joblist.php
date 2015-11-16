<div class="divbg-white">
    <div style="border-bottom: 1px solid #ccc; font-weight: bold; font-size: 15px; margin-bottom: 10px; padding-bottom: 5px;">JOB POSTS</div>

    <div id="cv_filterview">
        <div class="clearboth"></div>
        <div id="showfiltereddata">

        </div>
        <div class="clearboth"></div>
        <div id="showloaderbottom"></div>
        <div id="lastidload" style="display: none;">0</div>
        <div id="jobpost_cat_value" style="display: none;"><?php
            if (isset($_GET['cat_id'])) {
                echo decode_id($_GET['cat_id']);
            } else {
                echo 0;
            }
            ?></div>
    </div>
    <div class="clearboth"></div>



</div>





<script>
    var loader_img_cv = '<div style="text-align:center;"><img  src="' + BASE_URL + 'images/loader.gif"/></div>';
    var loader_img_round = '<div style="text-align:center;" class="text-bizhuru"><img  src="' + BASE_URL + 'images/loader_round.gif"/> Loading...</div>';

    jQuery(function($) {



        pullJOBPOST('');



        /*
         
         $("body").on("click", "#filterdata", function() {
         pullCV('LOADER_UP', 'RESET');
         });
         
         */

        $(window).scroll(function() {
            if ($(window).scrollTop() > ($(document).height() - $(window).height() - 200)) {
                // ajax call get data from server and append to the div
                pullJOBPOST('YES');
            }
        });



    });






    function pullJOBPOST(is_scroll) {

        jQuery("#showloaderbottom").html(loader_img_round);
        var cat_id = jQuery("#jobpost_cat_value").html();
         var lastidload = jQuery("#lastidload").html();

        var data = {cat_id: cat_id,lastidload: lastidload, is_scroll: is_scroll};
        jQuery.ajax({
            type: 'POST',
            url: SITE_URL + "pull_jobpost",
            data: data,
            dataType: 'json',
            success: function(data, textStatus, jqXHR) {
                
                 if (data.status_server === 1) {
                 if (is_scroll === 'YES') {
                 jQuery("#showfiltereddata").append(data.msg);
                 } else {
                 jQuery("#showfiltereddata").html(data.msg);
                 }
                // jQuery("#lastidload").html(data.lastidload);
                // if ('main_cat' in data) {
                 //jQuery("#resultcattitle1").html(data.main_cat);
                // }
                 if ('lastidload' in data) {
                 jQuery("#lastidload").html(data.lastidload);
                 }
                 
                 jQuery("#showloaderbottom").html('');
                 } else if (data.status_server === 2) {
                 jQuery("#showloaderbottom").html(data.msg);
                 } else {
                 jAlert(data.msg, "BizHuru | Info");
                 
                 jQuery("#showloaderbottom").html('');
                 }
                 
            },
            error: function(jqXHR, textStatus, errorThrown) {

                jAlert("Error (" + jqXHR.status + ") found", "BizHuru | Alert");

                jQuery("#showloaderbottom").html('');
            }
        });

    }



</script>
