<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$product = $viewData['product'];

if(isset($viewData['rowHeights'])){
	$rowHeights = $viewData['rowHeights'];
} else {
	$rowHeights['customfields'] = TRUE;
}

if(isset($viewData['init'])){
	$init = $viewData['init'];
} else {
	$init = '1';
}

$addtoCartButton = '';
if(!VmConfig::get('use_as_catalog', 0)){
	if(!$product->addToCartButton and $product->addToCartButton!==''){
		$addtoCartButton = shopFunctionsF::getAddToCartButton ($product->orderable);
	} else {
		$addtoCartButton = $product->addToCartButton;
	}

}
$position = 'addtocart';
//if (!empty($product->customfieldsSorted[$position]) or !empty($addtoCartButton)) {
if (isset($product->step_order_level))
	$step=$product->step_order_level;
else
	$step=1;
if($step==0)
	$step=1;

if (!VmConfig::get('use_as_catalog', 0)  ) { ?>

	<div class="addtocart-bar">
	<div class="wrap-qty">
	<?php
	// Display the quantity box
	$stockhandle = VmConfig::get ('stockhandle', 'none');
	if (($stockhandle == 'disableit' or $stockhandle == 'disableadd') and ($product->product_in_stock - $product->product_ordered) < 1) { ?>
		<a href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&layout=notify&virtuemart_product_id=' . $product->virtuemart_product_id); ?>" class="notify"><?php echo vmText::_ ('COM_VIRTUEMART_CART_NOTIFY') ?></a><?php
	} else {
		$tmpPrice = (float) $product->prices['costPrice'];
		if (!( VmConfig::get('askprice', true) and empty($tmpPrice) ) ) { ?>
			<?php if ($product->orderable) { ?>
				<div class="qty-title">
					<span for="quantity<?php echo $product->virtuemart_product_id; ?>" class="quantity_box"><?php echo vmText::_ ('COM_VIRTUEMART_CART_QUANTITY'); ?>: </span>
				</div>
				<div class="qty-set">
					<span class="quantity-box">
						<input type="text" class="quantity-input js-recalculate" name="quantity[]"
							   onblur="Virtuemart.checkQuantity(this,<?php echo $step?>,'<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED')?>');"
							   onclick="Virtuemart.checkQuantity(this,<?php echo $step?>,'<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED')?>');"
							   onchange="Virtuemart.checkQuantity(this,<?php echo $step?>,'<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED')?>');"
							   onsubmit="Virtuemart.checkQuantity(this,<?php echo $step?>,'<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED')?>');"
							   value="<?php if (isset($product->step_order_level) && (int)$product->step_order_level > 0) {
								   echo $product->step_order_level;
							   } else if(!empty($product->min_order_level)){
								   echo $product->min_order_level;
							   }else {
								   echo $init;
							   } ?>"/>
						<input type="button" value="plus" class="quantity-controls quantity-plus"/>
						<input type="button" value="minus" class="quantity-controls quantity-minus"/>
				  </span>
			  </div>
	</div>
	<?php }

			if(!empty($addtoCartButton)){
				?><div class="addtocart-button">
				<?php echo $addtoCartButton ?>
				</div> <?php
			} ?>
			<input type="hidden" name="virtuemart_product_id[]" value="<?php echo $product->virtuemart_product_id ?>"/>
			<noscript><input type="hidden" name="task" value="add"/></noscript> <?php
		}
	} ?>

	</div><?php
} ?>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-551e489074948b9e" async="async"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
