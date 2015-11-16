<div class="divbg-white" style="border: 1px solid #d6d7da;">



    <div id="cv_filterview">
        <div class="clearboth"></div>
        <div id="showfiltereddata">
            <?php
            echo $mystore_content;
            ?>
        </div>
        <div class="clearboth"></div>
        <div id="showloaderbottom"></div>
        <div id="lastidload" style="display: none;"><?php echo $last_row; ?></div>
    </div>
    <div class="clearboth"></div>

</div>



<style>
    .ui-widget-header{
        height: 20px;
        overflow: hidden;
    }
</style>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="dynamic" data-keyboard="false" >
    <div class="modal-dialog">
        <div class="modal-content"> <div style="height: 100px; line-height: 100px; text-align: center;"> <img src="<?php echo base_url(); ?>images/loader_round.gif"/> Loading....</div></div>
    </div>
</div>

<script>
  jQuery(function($) {
        $("body").on("click", ".preview_userCV", function(e) {
            var model = $(".modal-content");
            model.empty();
            model.html('<div style="height: 100px; line-height: 100px; text-align: center;"> <img src="<?php echo base_url(); ?>images/loader_round.gif"/> Loading....</div>');
            model.load($(this).attr("href"));
        });
        });

        </script>

