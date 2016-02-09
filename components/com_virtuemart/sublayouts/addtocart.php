<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$product = $viewData['product'];

if(isset($viewData['rowHeights'])){
	$rowHeights = $viewData['rowHeights'];
} else {
	$rowHeights['customfields'] = TRUE;
}

$addtoCartButton = '';
if(!VmConfig::get('use_as_catalog', 0)){
	if($product->addToCartButton){
		$addtoCartButton = $product->addToCartButton;
	} else {
		$addtoCartButton = shopFunctionsF::getAddToCartButton ($product->orderable);
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

?>

	<div class="addtocart-area">
		<form method="post" class="product js-recalculate" action="<?php echo JRoute::_ ('index.php?option=com_virtuemart',false); ?>">
			<?php

			if(!empty($rowHeights['customfields'])) echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$product,'position'=>'addtocart'));

			if (!VmConfig::get('use_as_catalog', 0)  ) {

				echo shopFunctionsF::renderVmSubLayout('addtocartbar',array('product'=>$product));

			} ?>
			<input type="hidden" name="option" value="com_virtuemart"/>
			<input type="hidden" name="view" value="cart"/>
			<input type="hidden" name="virtuemart_product_id[]" value="<?php echo $product->virtuemart_product_id ?>"/>
			<input type="hidden" class="pname" value="<?php echo $product->product_name ?>"/>
			<?php
			$itemId=vRequest::getInt('Itemid',false);
			if($itemId){
				echo '<input type="hidden" name="Itemid" value="'.$itemId.'"/>';
			} ?>
		</form>

	</div>

<?php // }
?>