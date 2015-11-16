<?php
$filter_title = '';
$filter_title2 = 'USER';
if (isset($_GET['filterinfo'])) {
    $filterinfo = $_GET['filterinfo'];
    if ($filterinfo == 'cvtab') {
        $filter_title = 'CV';
        $filter_title2 = 'USER';
    } else if ($filterinfo == 'profiletab') {
        $filter_title = 'PROFILES';
        $filter_title2 = 'PAGE';
    }
}

$parent_cat = null;
if (isset($_GET['catid'])) {
    $parent_cat = decode_id($_GET['catid']);
}

$main_category = $this->common_model->get_professional_list(null, $parent_cat, $filter_title2)->result();
?>
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





<div id="cvfilter-top">
    <div id="cvfilter-top-left"><?php echo $filter_title; ?></div>
    <div id="cvfilter-top-right"><input id="cvfilter_search" type="text"/></div>
    <div class="clearboth"></div>
</div>

<div id="cvfilter-searchcriteria">
    <div id="cvfilter-catgrlist">
        <?php
        foreach ($main_category as $key => $value) {
            if ($value->parent <> 0) {
                $parentinfo = $this->common_model->get_professional_list($value->parent)->row();
                // $sub_category = $this->common_model->get_professional_list(null, $value->id, $filter_title2)->result();
                // print_r($sub_category);
                // foreach ($sub_category as $keyx => $valuex) {
                ?>
                <div class="filtersubcat_list"><?php echo $parentinfo->name . ' - ' . $value->name ?> <input type="checkbox" value="<?php echo $value->id; ?>" class="pull-right subcat_values "/>
                    <div class="clearboth"></div>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <div>
        <div class="cvfilter-search-mayninputrow">
            <div class="cvfilter-search-column" style="margin-left: 0px;">
                <select class="cvfilter_searchinputbiz" id="gender">

                    <option  value="">Gender: All</option>
                    <?php foreach (gender() as $key => $value1) { ?>
                        <option  value="<?php echo $key ?>"><?php echo $key ?></option>
                    <?php }
                    ?>
                </select>
            </div>
            <div class="cvfilter-search-column">
                <select class="cvfilter_searchinputbiz selectcheckbox" id="education" multiple="multiple">

                    <?php
                    $awardtype = autosuggest_data('education_award', 'id', 'name');
                    foreach ($awardtype as $key => $v) {
                        ?>
                        <option  value="<?php echo $v['value'] ?>"><?php echo $v['data'] ?></option>
                    <?php }
                    ?>
                </select>
            </div>
            <div class="cvfilter-search-column">
                <select class="cvfilter_searchinputbiz selectcheckboxnationality" id="nationality"  multiple="multiple">

                    <?php
                    $nationality = $this->common_model->get_nationality();
                    foreach ($nationality as $key => $v) {
                        ?>
                        <option  value="<?php echo $v->name ?>"><?php echo $v->name; ?></option>
                    <?php }
                    ?>
                </select>   
            </div>
            <div class="cvfilter-search-column pull-right" style="margin-right:  0px;">

                <select class="cvfilter_searchinputbiz selectcheckboxlevel" id="levelx" multiple="multiple">

                    <?php
                    $nationality = tags_data("work_level", 'id', 'name');
                    foreach ($nationality as $key => $v) {
                        ?>
                        <option  value="<?php echo $v['id'] ?>"><?php echo $v['text']; ?></option>
                    <?php }
                    ?>
                </select> 

            </div>
            <div class="clearboth"></div>
        </div>


        <!--        <div class="cvfilter-search-mayninputrow">
                    <div class="cvfilter-search-column" style="margin-left: 0px;">xx</div>
                    <div class="cvfilter-search-column">xx</div>
                    <div class="cvfilter-search-column">xx</div>
                    <div class="cvfilter-search-column pull-right" style="margin-right:  0px;">xx</div>
                    <div class="clearboth"></div>
                </div>-->

        <div class="cvfilter-search-mayninputrow">
            <div style="margin-right: 30px;">

                <div class="pull-left" id="showloaderuper" style="width: 600px; text-align: right;"></div>
                <button class="pull-right btn btn-sm btnsubmit" id="filterdata">Search</button>
            </div>
            <div class="clearboth"></div>
        </div>


    </div>
</div>

<div id="cvfilter-resulttop">
    <div id="cvfilter-resulttop-left"><div>
            CATEGORY : <span id="resultcattitle1"> <?php echo (isset($_GET['catid']) ? get_value('professional_category', decode_id($_GET['catid']), 'name') : 'ALL') ?></span>
        </div>
    </div>
    <div id="cvfilter-resulttop-right"><div>Level :
            <span style="position: relative; display: inline-block;">
                <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="true"><span id="resultcattitleright">All</span> &nbsp; &nbsp;<i class="fa fa-angle-down"></i></a>
                <ul class="dropdown-menu" >
                    <li>
                        <a href="javascript:void(0);" val="" class="resultcattitleselected" tabindex="-1">

                            All
                        </a>
                    </li>
                    <?php
                    $levellist = tags_data("work_level", 'id', 'name');
                    foreach ($levellist as $key => $value) {
                        ?>
                        <li>
                            <a href="javascript:void(0);" val=" <?php echo $value['id']; ?>" class="resultcattitleselected" tabindex="-1">
                                <?php echo $value['text']; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </span>

        </div></div>
    <div class="clearboth "></div>
</div>






<div id="cv_filterview">
    <div class="clearboth"></div>
    <div id="showfiltereddata">

    </div>
    <div class="clearboth"></div>
    <div id="showloaderbottom"></div>
    <div id="lastidload" style="display: none;">0</div>
</div>
<div class="clearboth"></div>



<script>
    var loader_img_cv = '<div style="text-align:center;"><img  src="' + BASE_URL + 'images/loader.gif"/></div>';
    var loader_img_round = '<div style="text-align:center;" class="text-bizhuru"><img  src="' + BASE_URL + 'images/loader_round.gif"/> Loading...</div>';
    var filter_type = "<?php echo $filter_title2 ?>";
    var filter_main_cat = "<?php echo $parent_cat ?>";
    var filter_sub_cat = '';
    var filter_level = '';
    var search_education_Select = '';
    var search_nationality_Select = '';
    var search_Level_Select = '';
    jQuery(function($) {
        $("body").on("click", ".preview_userCV", function(e) {
            var model = $(".modal-content");
            model.empty();
            model.html('<div style="height: 100px; line-height: 100px; text-align: center;"> <img src="<?php echo base_url(); ?>images/loader_round.gif"/> Loading....</div>');
            model.load($(this).attr("href"));
        });



        search_education_Select = $(".selectcheckbox").multiselect({
            selectedText: "# of # selected",
            noneSelectedText: "Education: All",
            classes: "cvfilter_searchinputbiz"
//            header: false
        });
        search_nationality_Select = $(".selectcheckboxnationality").multiselect({
            selectedText: "# of # selected",
            noneSelectedText: "Nationality: All",
            classes: "cvfilter_searchinputbiz"
//            header: false
        });

        search_Level_Select = $(".selectcheckboxlevel").multiselect({
            selectedText: "# of # selected",
            noneSelectedText: "Level: All",
            classes: "cvfilter_searchinputbiz"
                    // header: false
        });

        $("body").on("click", ".resultcattitleselected", function() {
            var selected_text = $(this).html();
            $("#resultcattitleright").html(selected_text);

        });


        $("body").on("click", ".resultcattitleselected", function() {
            filter_level = $(this).attr('val');
            pullCV('LOADER_UP', '');
        });


        pullCV('LOADER_UP', '');

        $("body").on("click", ".subcat_values", function() {
            var selected_sub = '';
            $(".subcat_values").each(function(k, v) {
                if ($(v).is(":checked")) {
                    selected_sub += $(v).val() + ',';
                }
            });

            if (selected_sub.length > 0) {
                var tmp_selected_sub = selected_sub.substring(0, selected_sub.length - 1);
                selected_sub = tmp_selected_sub;
            }
            filter_sub_cat = selected_sub;
        });



        $("body").on("click", "#filterdata", function() {
            pullCV('LOADER_UP', 'RESET');
        });


        $(window).scroll(function() {
            if ($(window).scrollTop() > ($(document).height() - $(window).height() - 200)) {
                // ajax call get data from server and append to the div
                pullCV('LOADER_DOWN', 'YES');
                // alert("BOTOM");
            }
        });



    });






    function pullCV(loaderpos, is_scroll) {
        if (loaderpos == "LOADER_UP") {
            jQuery("#showloaderuper").html(loader_img_cv);
        } else {
            jQuery("#showloaderbottom").html(loader_img_round);
        }
        var gender = jQuery("#gender").val();
        var education = jQuery("#education").val();
        var nationality = jQuery("#nationality").val();
        var levelx = jQuery("#levelx").val();
        var lastidload = jQuery("#lastidload").html();

        if (education !== null) {
            education = education.join();
        }
        if (nationality !== null) {
            nationality = nationality.join();
        }
        if (levelx !== null) {
            levelx = levelx.join();
        }

        var data = {filtertype: filter_type, main_cat: filter_main_cat, sub_cat: filter_sub_cat, level: filter_level,
            gender: gender, education: education, nationality: nationality, levelx: levelx,
            lastidload: lastidload, is_scroll: is_scroll};
        jQuery.ajax({
            type: 'POST',
            url: SITE_URL + "ajax_filter_cv",
            data: data,
            dataType: 'json',
            success: function(data, textStatus, jqXHR) {

                if (data.status_server === 1) {
                    if (is_scroll === 'YES') {
                        jQuery("#showfiltereddata").append(data.msg);
                    } else {
                        jQuery("#showfiltereddata").html(data.msg);
                    }
                    jQuery("#lastidload").html(data.lastidload);
                    if ('main_cat' in data) {
                        jQuery("#resultcattitle1").html(data.main_cat);
                    }
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

                jQuery("#showloaderuper").html('');
            },
            error: function(jqXHR, textStatus, errorThrown) {

                jAlert("Error (" + jqXHR.status + ") found", "BizHuru | Alert");
                jQuery("#showloaderuper").html('');
                jQuery("#showloaderbottom").html('');
            }
        });

    }



</script>