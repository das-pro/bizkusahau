
<div id="slider">
    <div class="h-content">

        <div style="width: 50%; float: left;">

            <!-- TODO -->



            <div class="txt-slide">
                <ul class="carousel">
                    <?php foreach ($slider as $key => $value) { ?>
                        <li class="<?php echo ($key == 0 ? 'opc' : ''); ?>">
                            <?php echo $value->description; ?>
                        <dd> <?php echo $value->name_position; ?></dd>
                        </li>  
                    <?php }
                    ?>


                </ul>
            </div>
            <div class="img-slide">
                <ul class="carousel">

                    <?php
                    foreach ($slider as $key => $value) {
                        if ($key == 0) {
                            ?>
                            <li class="opc"><img src="<?php echo FRONT_SLIDE_IMG_PATH . $value->img; ?>" alt="<?php echo $value->name_position; ?>" /></li>
                            <?php if (array_key_exists(1, $slider)) { ?> <li><img alt="<?php echo $value->name_position; ?>" src="<?php echo FRONT_SLIDE_IMG_PATH . $slider[1]->img; ?>" /></li> <?php } ?>

                        <?php } else if ($key > 1) { ?>
                            <li class="to-load">
                                <img src="<?php echo FRONT_SLIDE_IMG_PATH; ?>0_dot.gif" alt="<?php echo $value->name_position; ?>" data-src="<?php echo FRONT_SLIDE_IMG_PATH . $value->img; ?>" />
                            </li>  
                            <?php
                        }
                    }
                    ?>




                </ul>
            </div>


        </div>

        <div style="width: 50%; float: right; display: table-cell">
            <div style="float: right;">
                <div id="signupform">
                    <div id="inside_signup">
                        <div class="clerf_form">
                            <div id="signup_form">
                                
                                <h5>Join<br/>
                                    millions of professionals</h5>
                                <div class="signup_linedivider"></div>
                                <div id="signup_contentform">
                                    <!--<div id="signup_help">Please fill in the details  sign up : </div>-->
                                    <form role="form"  method="post" id="formsignup_validate" action="<?php echo current_url(); ?>">
                                        <div class="form-group">
                                            <label for="firstname">First Name  &nbsp;<?php echo form_error('firstname'); ?></label>
                                            <input id="firstname" type="text" value="<?php echo set_value('firstname'); ?>" title="Please enter your first name" name="firstname" class="form-control" placeholder="Your First Name"/>

                                        </div>
                                        <div class="form-group">
                                            <label for="lastname">Last Name  &nbsp; <?php echo form_error('lastname'); ?></label>
                                            <input id="lastname" type="text" value="<?php echo set_value('lastname'); ?>" title="Please enter your last name" name="lastname" class="form-control" placeholder="Your Last Name"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email  &nbsp; <?php echo form_error('email'); ?></label>
                                            <input id="email" type="text" value="<?php echo set_value('email'); ?>" title="Please enter your email address" name="email" class="form-control" placeholder="Your Email"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password   &nbsp;<?php echo form_error('password'); ?></label>
                                            <input id="password" type="password" title="Please enter your password at least 5 characters" name="password" class="form-control" placeholder="Your Password at least 5 characters"/>
                                        </div>
                                        
                                        <div class="form-group" style="text-align: center; margin-top: 0px; margin-bottom: 5px;">
                                            <input type="radio" value='Male' checked='checked' name="gender" class="radio-inline" /> Male
                                            <input type="radio" value='Female' name="gender" class="radio-inline" /> Female
                                        </div>
                                        
                                     
   
                                        <div class="form-group" style="text-align: center;">
                                            <div>By signing up, you agree to bizhuru.com's <br/><a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a></div>
                                            <input type="submit" value="Sign Up for free" class="btn btn-block btn-bizhuru"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>
</div>

<div style="clear: both;"></div>
<div style="display: block; min-height: 200px; background: #fff; margin-top: -10px; padding-top: 10px;">
    <div class="container" style="min-width: 980px; padding-bottom:  100px;">
        <div class="col-lg-12" style="text-align: center;">
            <div id="home-large-title">
                <span> BizHuru,</span> where professionals meet.
            </div>
        </div>
        <div class="col-lg-12">
            <div class="col-lg-4 frontbox">
                <div class="frontbox-icon_img"><img class="image-circular" src="<?php echo FRONT_SLIDE_IMG_PATH . 'slider.jpg'; ?>"/></div>
                <div class="frontbox-content">
                    <h4>Title for this Section</h4>
                    Using Bootstrap's img-circle, I'd like to get circular crops, not elliptical/non-circular crops of these rectangular images.
                </div>
                <div style="clear: both;"></div>
            </div>
            <div class="col-lg-4 frontbox">
                <div class="frontbox-icon_img"><img class="image-circular" src="<?php echo FRONT_SLIDE_IMG_PATH . 'slider.jpg'; ?>"/></div>
                <div class="frontbox-content">
                    <h4>Title for this Section</h4>
                    Using Bootstrap's img-circle, I'd like to get circular crops, not elliptical/non-circular crops of these rectangular images.
                </div>
                <div style="clear: both;"></div> 
            </div>
            <div class="col-lg-4 frontbox">
                <div class="frontbox-icon_img"><img class="image-circular" src="<?php echo FRONT_SLIDE_IMG_PATH . 'slider.jpg'; ?>"/></div>
                <div class="frontbox-content">
                    <h4>Title for this Section</h4>
                    Using Bootstrap's img-circle, I'd like to get circular crops, not elliptical/non-circular crops of these rectangular images.
                    
                </div>
                <div style="clear: both;"></div> 
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>
</div>

<script type="text/javascript">

    jQuery.noConflict();
    jQuery(document).ready(function($) {
        var validator = $("#formsignup_validate").validate({
            rules: {
                firstname: "required",
                lastname: "required",
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true

                }

            },
            messages: {
                firstname: "Please enter your first name xxx",
                lastname: "Please enter your last name",
                email: {
                    required: "Please enter your email address",
                    email: "Invalid Email address"
                },
                password: {
                    required: "Please enter password"

                }
            },
            errorPlacement: function(error, element) {
                //$(element).attr({"title": error.append()});
                //$("#"+element.attr("id")).tooltip("show");
                //alert(element.name);
                //element.addClass()
                //window.console.log(element.attr("id"));
            },
            submitHandler: function(form) {
               form.submit();
            }
        });
    });

</script>


