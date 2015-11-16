<div>
    <?php
    if ($this->session->flashdata('message') != '') {
        echo $this->session->flashdata('message');
    }

    $current_user = current_user();
    $currancy = get_payment_setting($current_user->id)->currency;
    ?>
    <div>
        <span class="package_step">
            <div class="circle circle-border" style="height: 50px; width: 50px;">
                <div class="circle-inner package_active">
                    <div class="score-text">
                        1
                    </div>
                </div>


            </div>
            Choose your Package
        </span>


        <span class="package_step">
            <div class="circle circle-border" style="height: 50px; width: 50px;">
                <div class="circle-inner">
                    <div class="score-text">
                        2
                    </div>
                </div>
            </div>
            Payment Method
        </span>

        <span class="package_step">
            <div class="circle circle-border" style="height: 50px; width: 50px;">
                <div class="circle-inner">
                    <div class="score-text">
                        3
                    </div>
                </div>
            </div>
            Confirmation

        </span>
        <div style="clear: both;"></div>
        <div id="line_package"></div>
    </div>


    <div id="package_title">
        <div id="title_package" class="pull-left">Credits packages</div>
        &nbsp; &nbsp;<small class="text-brown">(Want to change currency? <a href="<?php echo site_url('payment_setting'); ?>"  class="text-brown" style="text-decoration: underline;">click here</a>)</small>
        <div style="clear: both;"></div>
    </div>


    <div style="margin-top: 10px;">
        <?php foreach ($credit_package as $key => $value) { ?>
            <div class="credit_package_items">
                <span class="package_name"><?php echo $value->credit; ?></span>
                Credits
                <span class="package_amount"><?php echo number_format(($value->amount * $this->common_model->currency($currancy)->row()->exchange_rate),2) . ' ' . $currancy ?> </span>
                <span class="package_description"><?php echo $value->description; ?></span>
                
                <span class="btn_buy"> <a class="btn btn-sm btn-success" href="<?php echo site_url('buy_credit/'.$value->id.'/'.(isset($function) ? '?'.$function:'')) ?>"><b>Buy</b></a></span>
            </div>  
<?php }
?>

        <div style="clear: both;"></div>
    </div>






</div>