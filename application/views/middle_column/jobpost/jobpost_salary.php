
<div class="education-title">SALARY & BENEFITS</div>
<?php echo form_open("jobpost/?tabinfo=jobpost_salary&jobpost_id=" . $jobpost_id); ?>

<div class="educationinfoform" style="background-color: #fff; border-bottom: 0px; margin-left:0px; margin-right: 0px;">
    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Salary Band (Currency)</div>
        <div class="userinfo-value-edit">
            <select class="inputbizhuru currency1"  name="currency">
                <option value=""> -- Select --</option>
                <?php
                $sel = (isset($salaryinfo) ? $salaryinfo->currency : set_value('currency'));
                foreach (tags_data('currency', 'code', 'name') as $key => $value) {
                    ?>
                    <option <?php echo ($value['id'] == $sel ? 'selected="selected"' : ''); ?> value="<?php echo $value['id']; ?>"><?php echo $value['text']; ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('currency'); ?>
        </div>
        <div class="clearboth"></div>
    </div>

    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">Salary Amount</div>
        <div class="userinfo-value-edit"><input type="text" name="amount" value="<?php echo (isset($salaryinfo) ? $salaryinfo->amount : set_value('amount')); ?>" style="text-align: right;"   class="inputbizhuru amountformat"  />

            <?php echo form_error('amount'); ?>
        </div>
        <div class="clearboth"></div>
    </div>

    <div class="educationinfo-row-edit">
        <div class="userinfo-label-edit">&nbsp;</div>
        <div class="userinfo-value-edit">
            <div  style="font-size: 15px; text-align: center; display: block;">
                Gross <input type="radio" value="Gross" checked="checked" name="salary_type"/>
                &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; Net <input type="radio" value="Net" name="salary_type"/>
            </div>
            <div style="display: block; font-size: 15px;">
                Benefits <input type="checkbox" value="1" <?php echo (isset($salaryinfo) ? ($salaryinfo->is_benefit == 1 ? 'checked="checked"':'') :(set_value('benefit') ? 'checked="checked"' : '')); ?> name="benefit" id="benefit"/>
                <a style="display: none;" id="benefit_clicklink" class="popup_panel" href="<?php echo site_url('popup_benefit') ?>" data-toggle="modal" data-remote="<?php echo site_url('popup_benefit') ?>"  data-target="#myModal" ></a>
            </div>
            <div style="display: block; line-height: 20px !important; display: none;" id="benefitlistdiv">
                <select class="inputbizhuru" multiple="multiple" id="benefitlist"  name="benefitlist[]">
                    <?php
                    $sel = (isset($salaryinfo) ? explode(',', $salaryinfo->benefit) : (isset($_POST['benefitlist']) ? $_POST['benefitlist'] : array()) );
                    foreach (tags_data('jobpost_benefit', 'id', 'name') as $key => $value) {
                        ?>
                        <option <?php echo (in_array($value['id'], $sel) ? 'selected="selected"' : ''); ?> value="<?php echo $value['id']; ?>"><?php echo $value['text']; ?></option>
                    <?php } ?>
                </select>
                 <?php echo form_error('benefitlist[]'); ?>
            </div>
        </div>
        <div class="clearboth"></div>
    </div>
     <input type="hidden" name="jobpost_id" value="<?php echo (isset($jobpost_id) ? $jobpost_id : encode_id(0)); ?>"/>

     <div class="save_footer" >
          <?php if((isset($jobpostinfo) && $jobpostinfo->status == 0) || !isset($jobpostinfo)){ ?>
        <input  type="submit" name="savedata" value="Save Information" name="save" class="  btn btn-sm btnsubmit">
          <?php } ?>
        <a  class="btn btn-sm btncancel" href="<?php echo site_url('jobpost/?tabinfo=jobpost_target&jobpost_id='.$jobpost_id); ?>">Skip</a> 
    </div>



    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="dynamic" data-keyboard="false" >
        <div class="modal-dialog">
            <div class="modal-content"> <div style="height: 100px; line-height: 100px; text-align: center;"> <img src="<?php echo base_url(); ?>images/loader_round.gif"/> Loading....</div></div>
        </div>
    </div>







</div>

<script>
    jQuery(document).ready(function($) {

        $(".currency1,#benefitlist").select2();
        
        $("body").on("change", '.benefititempopup', function() {
           if($(this).is(":checked")){
               var val = $(this).val();
               //$('body select#benefitlist option[value="'+$(this).val()+'"]').prop("selected",true);
              $("#benefitlist option[value='" + val+ "']").prop("selected", true);
              $("#benefitlist").select2().trigger("change");
           }else{
                var val = $(this).val();
              $("#benefitlist option[value='" + val+ "']").removeAttr("selected"); 
               $("#benefitlist").select2().trigger("change");
           }
        });



        if($("#benefit").is(":checked")){
            $("#benefitlistdiv").show();
        }
        
        $("body").on('change', '#benefit', function() {
            if ($(this).is(":checked")) {
                $(".popup_panel").click();
                $("#benefitlistdiv").show();

            } else {
                $("#benefitlistdiv").hide();
                $("#benefitlist option").each(function (){
                   var val = $(this).val();
              $("#benefitlist option[value='" + val+ "']").removeAttr("selected"); 
               $("#benefitlist").select2().trigger("change");    
                });
                return false;
            }
        });


        $("body").on("click", ".popup_panel", function(e) {

            var model = $(".modal-content");
            model.empty();
            model.html('<div style="height: 100px; line-height: 100px; text-align: center;"> ' + round_imgloader1 + ' Loading....</div>');
            model.load($(this).attr("href"));
        });



        $(".amountformat").val(function(index, value) {

            var x = value.replace(/[^0-9\.]/g, '');
            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
            return  parts.join(".");


        });

        $("body").on("keypress keyup blur", ".amountformat", function(event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');


            var x = $(this).val().replace(/[^0-9\.]/g, '');
            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $(this).val(parts.join("."));

            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });





    });
</script>
