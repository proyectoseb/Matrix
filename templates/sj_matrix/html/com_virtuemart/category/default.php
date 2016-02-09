<?php

defined ('_JEXEC') or die('Restricted access');
JHtml::_ ('behavior.modal');

$js = "
jQuery(document).ready(function () {
    jQuery('.orderlistcontainer').hover(
        function() { jQuery(this).find('.orderlist').stop().show()},
        function() { jQuery(this).find('.orderlist').stop().hide()}
    )
	
	// Click Button
	function display(view) {
		jQuery('.browse-view .row').removeClass('vm-list vm-grid').addClass(view);
		jQuery('.icon-list-grid .vm-view').removeClass('active');
		if(view == 'vm-list') {
			jQuery('.browse-view .product').addClass('col-lg-12');
			jQuery('.products-list .product .vm-product-media-container').addClass('col-md-4');
			jQuery('.products-list .product .product-info').addClass('col-md-8');
			jQuery('.icon-list-grid .' + view).addClass('active');
		}else{
			jQuery('.browse-view .product').removeClass('col-lg-12');
			jQuery('.products-list .product .vm-product-media-container').removeClass('col-md-4');
			jQuery('.products-list .product .product-info').removeClass('col-md-8');
			jQuery('.icon-list-grid .' + view).addClass('active');
		}
	}
		
    jQuery('.vm-view-list .vm-view').each(function() {
        var ua = navigator.userAgent,
        event = (ua.match(/iPad/i)) ? 'touchstart' : 'click';
        jQuery(this).bind(event, function() {
            jQuery(this).addClass(function() {
                if(jQuery(this).hasClass('active')) return '';
                return 'active';
            });
            jQuery(this).siblings('.vm-view').removeClass('active');
			catalog_mode = jQuery(this).data('view');
			display(catalog_mode);
			
        });

    });
});
";

vmJsApi::addJScript('vm.hover',$js);

if (empty($this->keyword) and !empty($this->category)) {
    ?>
<div class="category_description">
	
	<?php
	//echo $this->category->images; ?>
	<?php echo $this->category->category_description; ?>
</div>
<?php
}

// Show child categories
if (VmConfig::get ('showCategory', 1) and empty($this->keyword)) {
    if (!empty($this->category->haschildren)) {

        echo ShopFunctionsF::renderVmSubLayout('categories',array('categories'=>$this->category->children));

    }
}

if($this->showproducts){
?>
<div class="browse-view">
<?php

if (!empty($this->keyword)) {
    //id taken in the view.html.php could be modified
    $category_id  = vRequest::getInt ('virtuemart_category_id', 0); ?>
    <form action="<?php echo JRoute::_('index.php?option=com_virtuemart&view=category&search=false&limitstart=0' ); ?>" method="get">

        <!--BEGIN Search Box -->
        <div class="virtuemart_search">
            <?php echo $this->searchcustom ?>
            <br/>
            <?php echo $this->searchCustomValues ?>
            <input name="keyword" class="inputbox" type="text" size="40" value="<?php echo $this->keyword ?>"/>
            <input type="submit" value="<?php echo vmText::_ ('COM_VIRTUEMART_SEARCH') ?>" class="button" onclick="this.form.keyword.focus();"/>
        </div>
        <input type="hidden" name="search" value="true"/>
        <input type="hidden" name="view" value="category"/>
        <input type="hidden" name="option" value="com_virtuemart"/>
        <input type="hidden" name="virtuemart_category_id" value="<?php echo $category_id; ?>"/>

    </form>
    <!-- End Search Box -->
<?php  } ?>

<?php // Show child categories

    ?>
<div class="orderby-displaynumber top">
    <div class="vm-view-list col-md-2 col-sm-3 col-xs-12">
	<div class="icon-list-grid">
		<div class="vm-view vm-grid active" data-view="vm-grid"><i class="listing-icon"></i></div>
		<div class="vm-view vm-list" data-view="vm-list"><i class="listing-icon"></i></div>
	</div>
    </div>
    <div class="toolbar-center col-md-6 col-sm-5 col-xs-12">
        <div class="vm-order-list">
            <?php echo $this->orderByList['orderby']; ?>
            <?php echo $this->orderByList['manufacturer']; ?>
        </div>
        <div class="display-number">
        <div class="title"><?php echo 'Show';?></div>
        <div class="display-number-list"><?php echo $this->vmPagination->getLimitBox ($this->category->limit_list_step); ?></div></div>


    </div>

    <div class="vm-pagination vm-pagination-top col-md-4 col-sm-4 col-xs-12">
        <?php echo $this->vmPagination->getPagesLinks (); ?>
    </div>

    <div class="clear"></div>
</div> 
<!-- end of orderby-displaynumber -->

   <!--<h1><?php //echo $this->category->category_name; ?></h1>-->

    <?php
    if (!empty($this->products)) {
    $products = array();
    $products[0] = $this->products;
    echo shopFunctionsF::renderVmSubLayout($this->productsLayout,array('products'=>$products,'currency'=>$this->currency,'products_per_row'=>$this->perRow,'showRating'=>$this->showRating));

    ?>

<div class="orderby-displaynumber bottom">
	<div class="vm-view-list col-md-2 col-sm-3 col-xs-12">
	<div class="icon-list-grid">
		<div class="vm-view  vm-grid active" data-view="vm-grid"><i class="listing-icon"></i></div>
		<div class="vm-view vm-list" data-view="vm-list"><i class="listing-icon"></i></div>
	</div>
    </div>
    
    <div class="toolbar-center col-md-6 col-sm-5 col-xs-12">
        <div class="vm-order-list">
            <?php echo $this->orderByList['orderby']; ?>
            <?php echo $this->orderByList['manufacturer']; ?>
        </div>
        <div class="display-number">
        <div class="title"><?php echo 'Show';?></div>
        <div class="display-number-list"><?php echo $this->vmPagination->getLimitBox ($this->category->limit_list_step); ?></div></div>


    </div>

    <div class="vm-pagination vm-pagination-top col-md-4 col-sm-4 col-xs-12">
        <?php echo $this->vmPagination->getPagesLinks (); ?>
    </div>

    <div class="clear"></div>
</div> <!-- end of orderby-displaynumber -->

    <?php
} elseif (!empty($this->keyword)) {
    echo vmText::_ ('COM_VIRTUEMART_NO_RESULT') . ($this->keyword ? ' : (' . $this->keyword . ')' : '');
}
?>
</div>

<?php } ?>

<!-- end browse-view -->
