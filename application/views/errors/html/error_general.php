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

       
        <!--Basic Styles-->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />

        <link id="bootstrap-rtl-link" href="<?php echo site_url(); ?>" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" />
        
        <link href="<?php echo base_url(); ?>media/css/sprite.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>media/css/style.css" rel="stylesheet" />
    
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>media/js/modernizr.js" type="text/javascript"></script>
       
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <!--<script src="<?php echo base_url(); ?>media/js/script.js" type="text/javascript"></script>-->
        <script src="<?php echo base_url(); ?>media/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

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
    <body>
        <div class="se-pre-con"></div>


        <div id="biz_topbar">
            <div class="biz_topbar" id="header-fix" style="position: fixed;">
                <div id="wrap-container"> 


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
                        <div id="top_icon_menu">Menu</div>

                    </div>
                    <!--<div class="vbiz-col-space"></div>-->
                    <div id="biz-nav-advert">
                        webkitTransition
                    </div>
                </div>
            </div>
        </div>
        <div class="clearboth"></div>

        <div id="wrap-container"> 
            <div style="margin: auto; padding-top: 20px;">

                   <div id="container">
		<h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
	</div>
            </div>
          
            
            <div class="clearboth"></div>

        </div>
  
    </body>

</html>

