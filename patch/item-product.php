<?php global $product; ?>
<div class="content">
    <div class="box-img"> 
        <?php the_post_thumbnail( '230x205' ) ?>
    </div>
    <div class="text">
        <p class="text-01">
            <a href="<?php the_permalink(  ) ?>"><?php the_title() ?></a>
        </p> 
        <?php echo $product->get_price_html(); ?>
    </div>
    <?php $percent = mona_get_percent(get_the_ID());
    if($percent){
        echo '<span class="saleoff" style="background: url('.site_url().'/template/images/price_tag.png) no-repeat;">-'.$percent .'%</span>';
    }
    ?>

    
    <div class="cart-hover">
        <div class="box-icon">
            <a class="mona-add-cart addcart-loading" data-id="<?php the_ID() ?>" href="javascript:;">
                <div class="item-icon-2">
                <img src="<?php echo site_url(  ) ?>/template/images/hover-cart.png" alt="">
                </div>
            </a>
        </div>
    </div>
</div>