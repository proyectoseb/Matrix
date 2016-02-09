<?php


defined('_JEXEC') or die;
$assets_img = JURI::root().'templates/'.$template.'/images/rating';

$ratingModel = VmModel::getModel('ratings');
$currency = CurrencyDisplay::getInstance();
?>
<div class="item-wrap<?php //echo $item_last_css; ?> ajaxtabs-item">
	<?php
	$img = VmAjaxtabsBaseHelper::getVmImage($item, $params);
	if ($img):?>
		<div class="item-image">
			<a href="<?php echo $item->link; ?>"
			   title="<?php echo $item->title; ?>" <?php echo VmAjaxtabsBaseHelper::parseTarget($params->get('item_link_target', '_blank')); ?>>
				<?php echo VmAjaxtabsBaseHelper::imageTag($img);?>
			</a>
		</div>
	<?php endif; // image display ?>
	<div class="product-info">
        <div class="block-ratting-title">
        <?php if ((int)$params->get('item_title_display', 1)): ?>
            <div class="item-title">
                <a href="<?php echo $item->link; ?>"
                   title="<?php echo $item->title; ?>" <?php echo VmAjaxtabsBaseHelper::parseTarget($params->get('item_link_target', '_blank')); ?>>
                    <?php echo VmAjaxtabsBaseHelper::truncate($item->title, $params->get('item_title_max_characs', 100)); ?>
                </a>
            </div>
        <?php endif; // title display ?>
        <?php 
            if(!isset($list[0]->rating->rating) || $list[0]->rating->rating == null){
                $rating = 0;
            }else{
                $rating = $list[0]->rating->rating;
            }
            echo '<div class="item-rating" data-rating="'.$rating.'">';
                echo '<div class="item-star"></div>';
                echo '<div class="item-star"></div>';
                echo '<div class="item-star"></div>';
                echo '<div class="item-star"></div>';
                echo '<div class="item-star"></div>';
            echo '</div>';
        ?>
        </div>
	 
	<?php if ((int)$params->get('item_price_display', 1)) { ?>
		<div class="item-price">
			<?php
			if (!empty($item->prices['salesPrice'])) {
				echo $currency->createPriceDiv('salesPrice', JText::_("Price: "), $item->prices, false, false, 1.0, true);
			}
			if (!empty($item->prices['salesPriceWithDiscount'])) {
				$currency = CurrencyDisplay::getInstance();
				echo $currency->createPriceDiv('salesPriceWithDiscount', JText::_("Price: "), $item->prices, false, false, 1.0, true);
			} ?>
		</div>
	<?php } ?>
	<?php if ($params->get('item_addtocart_display', 1)) { ?>
        <div class="item-addtocart">
            <?php echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$item)); ?>
        </div>
    <?php } ?>
    </div>
</div>
