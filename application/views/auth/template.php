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
        <link href="<?php echo base_url(); ?>media/css/sprite.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>media/css/login.css" rel="stylesheet" />


        <script type="text/javascript">(function() {
                var VNS = window.VNS = {context: {brand: "BizHuru", currentEncryptedMemberId: "", isPremium: false, csrfToken: "", trackedURI: "text", scriptsVersion: "30747778", navLang: "en", mapApiKey: "miltone", mapVersionKey: "3", isCookiePolicyBannerEnabled: false, isDcrMvpEnabled: false}};
            })();</script>

        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>media/js/modernizr.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>media/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
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
       
        <div id="front-header">
            <div class="container">
                <div class="col-lg-12">
                    <div class="col-lg-3 col-md-4 col-xs-5">
                        <a  href="<?php echo site_url(); ?>" title="BizHuru" id="front-header-title" class="biz-name- biz-name-title"></a>
                    </div>
                    <div class="col-lg-7 pull-right">
                        <div id="front-header-right">

                            <form action="<?php echo site_url('login'); ?>" method="post">
                                <div class="header-input">
                                    <label class="label">&nbsp;Email</label>
                                    <input class="form-control" name="identity" value="<?php echo set_value('identity') ?>" placeholder="Email"/>
                                    <input type="checkbox" name="remember" value="1"/>Keep me signed in
                                </div>
                                <div class="header-input">
                                    <label class="label"> &nbsp; &nbsp;Password</label>
                                    <input type="password" name="password" class="form-control header-input" placeholder="Password"/>
                                    &nbsp; &nbsp;<a href="#">Forget your password?</a>
                                </div>
                                <div style="float: left; margin-left: 20px; margin-top: 15px;">
                                    <label class="label"></label>
                                    <input type="submit" class="btn btn-sm btn-bizhuru" style="width: 60px;" value="Login"/>
                                </div>
                            </form>
                            <div class="clearboth"></div>
                        </div>
                    </div>
                    <div class="clearboth"></div>
                </div> 
            </div>
        </div>


        <div style="margin-bottom: 90px; width: 100%;">
            <?php include 'front_side.php'; ?>
        </div>






        <div class="footer2">
<!--            <div id="footer_top">
                <div class="container">
                    <div class="col-lg-12">
                        <div class="col-lg-4 links">
                            <h4>Quick Links</h4>
                        </div>
                        <div class="col-lg-4 links">
                            <h4>CONTACT US</h4>
                        </div>
                        <div class="col-lg-4 links">
                            <h4>FOLLOW US</h4>

                        </div>
                    </div>
                </div>
            </div>-->

            <div id="footer_bottom">
                &copy; 2015
                <span> 

                    | <a href="#">About BizHuru</a>
                    | <a href="#">Terms and Conditions</a>
                    | <a href="#">Privacy policy</a>

                </span>
            </div>
            <!-- =================================================== -->
        </div>


        <script src="<?php echo base_url(); ?>media/js/tetra.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>media/js/slider.js" type="text/javascript"></script>
    </body>
</html>