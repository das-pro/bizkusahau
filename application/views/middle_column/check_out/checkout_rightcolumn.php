<div id="check_outlist">
    <?php
    $cart_categorize = cart_categorize();

    foreach ($cart_categorize as $key => $value) {
        ?>
        <div class="divbg-white checkout-content-body">
            <div class="checkout-title-list"><?php echo get_cart_categorize_title($key); ?></div>
            <?php
            if(count($value) > 0){
            foreach ($value as $key1 => $item) {
                $datafield = get_cart_info_display($item['name'],$item['type']);
               
                ?>
                <div class="checkout-row">
                    <?php if($item['type'] !='JOBPOST'){ ?>
                    <div class="checkout-rowimg"><img src="<?php echo $datafield['img'] ?>"/></div>
                    <?php } ?>
                    <div class="checkout-rowinfo"><?php echo $datafield['info'];  ?>
                    <div style="clear: both;"></div>
                    <a href="<?php echo site_url('cart_item_remove/'.$item['rowid']); ?>" class="btn btn-sm pull-right btn-success" style="padding: 2px 5px;">Remove</a>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            <?php }}else{ ?>
            <div style="text-align: center;">No data found in your cart under this category</div>
            <?php } ?>
        </div>
        <?php } ?>
</div>

