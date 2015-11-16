<?php
$accountbalance = account_balance($current_user_data->id);
?>
<div class="divbg-white middle-leftcolumn">
    <div class="titlediv">Balance Summary</div>
    
 <div class="middle_leftcolumn_cv_row">
     <span class="span1" style="width: 80px;">CVs</span> 
     <span class="span2"> : <?php echo number_format($accountbalance->cvs); ?></span> 
         <div class="clearboth"></div>
    </div>
 <div class="middle_leftcolumn_cv_row">
        <span class="span1" style="width: 80px;">Profile(s) </span> 
        <span class="span2">:  <?php echo number_format($accountbalance->profile); ?></span> 
         <div class="clearboth"></div>
    </div>
 <div class="middle_leftcolumn_cv_row">
        <span class="span1" style="width: 80px;">Ads </span> 
        <span class="span2">: <?php echo number_format($accountbalance->ads); ?></span> 
         <div class="clearboth"></div>
    </div>
 <div class="middle_leftcolumn_cv_row">
        <span class="span1" style="width: 80px;">Job Posts </span> 
        <span class="span2">: <?php echo number_format($accountbalance->jobpost); ?></span> 
         <div class="clearboth"></div>
    </div>
    <a href="<?php echo site_url('credit_package'); ?>" class="btn btn-sm btn-success pull-right">Buy More Credit</a>
    <div class="clearboth"></div>
</div>
<br/>
<?php
$cart_summary= cart_purchase_summary();
?>
<div class="divbg-white middle-leftcolumn">
    <div class="titlediv">Purchase Summary</div>
 <div class="middle_leftcolumn_cv_row">
        <span class="span1" style="width: 80px;">Total Cvs </span> 
        <span class="span2">: <?php echo number_format($cart_summary->cvs); ?></span> 
         <div class="clearboth"></div>
    </div>
 <div class="middle_leftcolumn_cv_row">
        <span class="span1" style="width: 80px;">Total Profile </span> 
        <span class="span2">: <?php echo number_format($cart_summary->profile); ?></span> 
         <div class="clearboth"></div>
    </div>
 <div class="middle_leftcolumn_cv_row">
        <span class="span1" style="width: 80px;">Total Ads </span> 
        <span class="span2">: <?php echo number_format($cart_summary->ads); ?></span> 
         <div class="clearboth"></div>
    </div>
 <div class="middle_leftcolumn_cv_row">
        <span class="span1" style="width: 80px;">Total Job Post </span> 
        <span class="span2">: <?php echo number_format($cart_summary->jobpost); ?></span> 
         <div class="clearboth"></div>
    </div>
    <?php if($this->cart->total_items() > 0){ ?>
    <a href="<?php echo site_url('cart_purchase'); ?>" id="cartpurchaseid" class="btn btn-sm btn-success pull-right">Purchase</a>
    <?php } ?>
    <div class="clearboth"></div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function ($){
      $("body").on("click","#cartpurchaseid",function (){
          var conf = confirm("Are you sure you want to purchase selected items in Cart ?");
          if(conf){
              return true;
          }else{
              return false;
          }
      });  
    });
    
</script>