<?php
/**
* sublayout products
*
* @package    VirtueMart
* @author Max Milbers
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2014 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL2, see LICENSE.php
* @version $Id: cart.php 7682 2014-02-26 17:07:20Z Milbo $
*/

defined('_JEXEC') or die('Restricted access');

$product = $viewData['product'];
$position = $viewData['position'];
$customTitle = isset($viewData['customTitle'])? $viewData['customTitle']: false;;
if(isset($viewData['class'])){
    $class = $viewData['class'];
} else {
    $class = 'product-fields';
}?>
<?php
if (!empty($product->customfieldsSorted[$position])) {
    if($customTitle and isset($product->customfieldsSorted[$position][0])){
            $field = $product->customfieldsSorted[$position][0]; ?>
        <div class="<?php echo $class?>">
        <div class="product-fields-title-wrapper"><span class="product-fields-title"><strong><?php echo vmText::_ ($field->custom_title) ?></strong></span>
        </div> <?php
        }
        $custom_title = null;
    ?>
    <div class="owl-carousel <?php echo $class?>sl">
        <?php

        foreach ($product->customfieldsSorted[$position] as $field) {
            if ( $field->is_hidden ) //OSP http://forum.virtuemart.net/index.php?topic=99320.0
            continue;
            ?><div class="product-field product-field-type-<?php echo $field->field_type ?>">
                <?php if (!$customTitle and $field->custom_title != $custom_title and $field->show_title) { ?>
                    <span class="product-fields-title-wrapper"><span class="product-fields-title"><strong><?php echo vmText::_ ($field->custom_title) ?></strong></span>
                        <?php if ($field->custom_tip) {
                            echo JHtml::tooltip ($field->custom_tip, vmText::_ ($field->custom_title), 'tooltip.png');
                        } ?></span>
                <?php }
                if (!empty($field->display)){
                    ?><div class="product-field-display"><?php echo $field->display ?></div><?php
                }
                if (!empty($field->custom_desc)){
                    ?><div class="product-field-desc"><?php echo vmText::_($field->custom_desc) ?></div> <?php
                }
                ?>
            </div>
        <?php
            $custom_title = $field->custom_title;
        } ?>
      <div class="clear"></div>
    </div></div>
<?php
} ?>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.<?php echo $class?>sl').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            lazyLoad: true,
            navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
        });
    });
</script>
