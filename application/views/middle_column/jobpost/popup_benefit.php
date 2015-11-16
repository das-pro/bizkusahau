<div class="modal-header">
    <button data-dismiss="modal" class="close  closepopup_cv"  type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
    <h4 id="myModalLabel" class="modal-title">SELECT BENEFITS</h4>
</div>
<div class="modal-body">
    <div class="col-lg-6"  id="benefitleft">
        <?php
        $result1 = $this->db->get_where('jobpost_benefit', array('position' => 0))->result();
        foreach ($result1 as $key => $value) {
            ?>
            <div><input type="checkbox" class="benefititempopup" value="<?php echo $value->id; ?>"/> &nbsp;<?php echo $value->name; ?></div> 
        <?php } ?>
    </div>
    <div class="col-lg-6"  id="benefitright">
        <?php
        $result1 = $this->db->get_where('jobpost_benefit', array('position' => 1))->result();
        foreach ($result1 as $key => $value) {
            ?>
            <div><input class="benefititempopup" type="checkbox" value="<?php echo $value->id; ?>"/> &nbsp;<?php echo $value->name; ?></div> 
        <?php } ?>
        <br/>
        <br/>
        <a href="javascript:void(0);" id="add_benefit" style="color: brown;"><i class="glyphicon glyphicon-plus"></i> Add Benefit</a>
        <div id="benefit_newdiv" style="text-align: center; display: none;">
            <input type="text" class="inputbizhuru" id="benefit_new" style="width: 200px; margin-bottom: 10px;"/>
            <a href="javascript:void(0);" class="btn btn-sm btnsubmit" id="savebenefit">Save Benefit</a><span id="errorloadingpopup"></span>

        </div>
    </div>
    <div style="clear: both;"></div>

</div>

<script>

    jQuery(document).ready(function($) {
        $("body").on("click", '#add_benefit', function() {
            $("#add_benefit").hide();
            $("#benefit_newdiv").show();
        });

        $("body").on('click', '#savebenefit', function() {
            var benefit = $("#benefit_new").val();
            if (benefit != '') {
                $("#errorloadingpopup").html(round_imgloader1 + ' Please wait...');
                $.ajax({
                    url: SITE_URL + "popup_benefitadd",
                    type: 'POST',
                    dataType: 'json',
                    data: {name: benefit},
                    success: function(data, textStatus, jqXHR) {
                        if (data.status_server === 1) {
                            $("body #benefitlist").append('<option value="' + data.msg.id + '">' + data.msg.name + '</option>');
                            $("body #benefitlist").select2().trigger("change");
                            // $("body .popup_panel").click();
                            var model = $(".modal-content");
                            model.empty();
                            model.html('<div style="height: 100px; line-height: 100px; text-align: center;"> ' + round_imgloader1 + ' Loading....</div>');
                            model.load(SITE_URL + "popup_benefit");
                        } else {
                            // jAlert(data.msg, "BizHuru | Alert");
                            $("#errorloadingpopup").html('');
                        }
                    }
                });
            } else {
                jAlert("Please fill the input before submission", "BizHuru | Alert");
            }
        });

    });

</script>


