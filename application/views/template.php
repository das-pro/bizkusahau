<!DOCTYPE html>
<html lang="en">
    <head>
        <title> BIZHURU -  Professional Social Network</title>
        <meta name="description" content="people | companies |Groups | alumni | Professional Network." />
        <meta name="keywords" content="bizhuru, search people, search companies, resume, job, job offer, group, expert, experts, blog, blogs, web directory, internet business, web 2" />
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
        <meta content="en" http-equiv="Content-Language" />
        <meta content="follow,index" name="robots" />
        <meta content="no-cache" http-equiv="pragma" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Open Graph -->
        <meta property="og:title" content="bizhuru.com -  Professional Social Network" />
        <meta property="og:description" content="people | companies | Groups | alumni | Professional Network." />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="bizhuru" />
        <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.png" type="image/x-icon">

        <script type="text/javascript">
            var SITE_URL = "<?php echo site_url(); ?>";
            var BASE_URL = "<?php echo base_url(); ?>";
        </script>
        <!--Basic Styles-->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />

        <link id="bootstrap-rtl-link" href="<?php echo site_url(); ?>" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>media/css/magicsuggest-min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>media/css/select2.css" rel="stylesheet" />

        <link href="<?php echo base_url(); ?>media/css/jquery.alerts.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>media/css/sprite.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>media/css/style.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>media/css/timeline.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>media/css/divformater.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>media/css/jquery.multiselect.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>media/css/jquery-ui.css" rel="stylesheet" />


        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>media/js/modernizr.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>media/js/jquery.lockfixed.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>media/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <!--<script src="<?php echo base_url(); ?>media/js/script.js" type="text/javascript"></script>-->
        <script src="<?php echo base_url(); ?>media/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>media/js/jquery-ui.min.js" type="text/javascript"></script> 

        <script>
            //paste this code under head tag or in a seperate js file.
            // Wait for window load
            jQuery.noConflict();

            jQuery(document).ready(function($) {
                // Animate loader off screen

                $(".se-pre-con").fadeOut("slow");
            });
        </script>
    </head>
    <?php
    $currentuser = current_user();
    ?>
    <body>
        <div class="se-pre-con"></div>


        <div id="biz_topbar">
            <div class="biz_topbar" id="header-fix" style="position: fixed;">
                <div id="wrap-container" style="height: 50px;"> 


                    <div id="biz-nav-logo">
                        <div id="logodiv" >
                            <a href="<?php echo site_url(); ?>" class="biz-logo- biz-logo-image"></a> 
                            <a href="<?php echo site_url(); ?>" class="biz-name- biz-name-title bizname"></a> 
                            <div class="clearboth"></div>
                        </div>
                    </div>
                    <!--<div class="vbiz-col-space"></div>-->
                    <div id="biz-nav-middle">
                        <div id="search_input">
                            <form>
                                <input type="text" value="" id="search_top"/><i id="search_icon" class="glyphicon glyphicon-search"></i>
                            </form>
                        </div>
                        <div id="top_icon_menu">
                            <ul id="notifynav">
                                <li><a>Login User1</a></li>
                                <li><a><i class="biz-notify-  biz-notify-dark-switch"></i></a></li>
                                <li><a><i class="biz-notify- biz-notify-dark-bell"></i></a></li>
                                <li>
                                    <a><i class=" bhuru- bhuru-connect"></i></a>

                                    <div class="notificationContainer">
                                        <div class="notificationTitle">Notifications</div>
                                        <div class="notificationsBody">
                                        </div>
                                        <div id="notificationFooter"><a href="#">See All</a></div>
                                    </div>


                                </li>
                                <div class="clearboth"></div>
                            </ul>

                        </div>

                    </div>
                    <!--<div class="vbiz-col-space"></div>-->
                    <div id="biz-nav-advert">
                        <?php
                        if($currentuser->status == 1){ ?>
                        <div id="shopping-cart-class"><img src="<?php echo base_url() ?>media/img/shop_cart.png"/><span class="total_cart_item"> <?php echo number_format($this->cart->total_items()); ?></span>
                            <?php if(!isset($hide_cart_checkout)){ ?>
                            <span class="check_out_top"><a href="<?php echo site_url('cart_checkout'); ?>">Check Out</a></span>
                            <?php }else{ echo 'Items';} ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearboth"></div>

        <div id="wrap-container">  


            <div class="column-left" >
                <div id="autofix_left">
                    <?php
                    if (isset($left_content)) {
                        if (isset($left_data)) {
                            $this->load->view($left_content, $left_data);
                        } else {
                            $this->load->view($left_content);
                        }
                    } else {
                        echo '&nbsp;';
                    }
                    ?>
                </div>    
            </div>
            <!--<div class="vbiz-col-space"></div>-->
            <div class="column-middle" >

                <?php
                if (isset($middle_content)) {

                    if (isset($middle_data)) {
                        $this->load->view($middle_content, $middle_data);
                    } else {
                        $this->load->view($middle_content);
                    }
                }
                ?> 
            </div>
            <!--<div class="vbiz-col-space"></div>-->
            <div class="column-advert">
                <?php
                if (isset($advert_content)) {
                    if (isset($advert_data)) {
                        $this->load->view($advert_content, $advert_data);
                    } else {
                        $this->load->view($advert_content);
                    }
                }
                ?> 
            </div>
            <div class="clearboth"></div>

        </div>

        <?php
        if ($this->session->flashdata('notify')) {
            $notify = $this->session->flashdata('notify');
            $jsx = json_encode(array('notify' => $notify));
            ?>
            <script type="text/javascript">
                notify_middle(<?php echo $jsx; ?>);
            </script>
        <?php }
        ?>


        <script type="text/javascript">



            jQuery(document).ready(function() {



                var lastScrollLeft = 0;
                jQuery(window).scroll(function() {

                    var documentScrollLeft = jQuery(this).scrollLeft();
                    var top = jQuery(this).scrollTop();

                    var windwoheight = jQuery(this).height();
                    var leftheight = jQuery(".column-left").height();
                    var middleleftcontentfix = jQuery("#middleleftcontentfix").height();

                    if ((top + windwoheight) > leftheight) {
                        jQuery("#header-fix").css("position", "fixed");
                        jQuery(".column-left").css("position", "fixed");
                        jQuery(".column-left").css("top", "-" + (leftheight - windwoheight) + "px");

                    } else {
                        jQuery("#header-fix").css("position", "fixed");
                        jQuery(".column-left").css("position", "absolute");
                        jQuery(".column-left").css("top", "");

                    }

                    if ((top + (windwoheight - 267)) > middleleftcontentfix) {
                        // alert(middleleftcontentfix);
                        //  jQuery("#middleleftcontentfix").css("position", "fixed");
                        //  jQuery("#middleleftcontentfix").css("top", "-" + (middleleftcontentfix - windwoheight) + "px");

                    } else {
                        // jQuery("#middleleftcontentfix").css("top", '');
                        //  jQuery("#middleleftcontentfix").css("position", '');
                    }



                    if (lastScrollLeft != documentScrollLeft) {
                        jQuery("#header-fix").css("position", "absolute");
                        if ((top + windwoheight) > leftheight) {
                            jQuery(".column-left").css("position", "absolute");
                            jQuery(".column-left").css("top", (top - leftheight + windwoheight) + "px");


                        }

                        if ((top + windwoheight) > middleleftcontentfix) {
                            // jQuery("#middleleftcontentfix").css("position", "absolute");
                            //  jQuery("#middleleftcontentfix").css("top", (top - middleleftcontentfix + windwoheight - 50) + "px");

                        }


                    }

                    return false;
                });



                // resize_LeftColumn();

                setInterval(function() {
                    if (!navigator.onLine) {
                        jAlert("Not Connected, Check your connections", "BizHuru | Info");

                    }
                }, 2000);

            });






        </script>
        <script src="<?php echo base_url(); ?>media/js/jquery.alerts.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>media/js/script.js" type="text/javascript"></script> 
        <script src="<?php echo base_url(); ?>media/js/jquery.multiselect.js" type="text/javascript"></script> 
      

        <script src="<?php echo base_url(); ?>media/js/select2.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>media/js/bootbox.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>media/js/jquery.form.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>media/js/magicsuggest-min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>media/js/jquery.mockjax.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>media/js/jquery.autocomplete.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>media/js/jquery.autogrow.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>media/js/bizhuruscript.js" type="text/javascript"></script>

    </body>

</html>

