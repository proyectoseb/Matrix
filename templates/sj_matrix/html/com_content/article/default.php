<?php

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// includes placehold
$yt_temp = JFactory::getApplication()->getTemplate();
include (JPATH_BASE . '/templates/'.$yt_temp.'/includes/placehold.php');

// Create shortcuts to some parameters.
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();
$info    = $params->get('info_block_position', 0);


$useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
	|| $params->get('show_hits') );

?>
<article class="item-page<?php echo $this->pageclass_sfx?>">
	
	<?php
if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
{
	echo $this->item->pagination;
}
?>
	<?php  if (isset($images->image_fulltext) and !empty($images->image_fulltext)) :
		
		//Create placeholder items images
		$src = $images->image_fulltext;
		if (file_exists(JPATH_BASE . '/' . $src)) {								
			$thumb_img = '<img src="'.$src.'" alt="'.$images->image_fulltext_alt.'" />';
		} else if ($is_placehold) {					
			$thumb_img = yt_placehold($placehold_size['article']);
		}	

	?>
	<?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
	<figure class="img-fulltext pull-<?php echo htmlspecialchars($imgfloat); ?>">
		<a  href="<?php echo $this->item->readmore_link; ?>" title="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>">	
			<?php echo $thumb_img; ?>
		</a>	
	</figure>
	<?php endif; ?>
	<?php if (!$useDefList && $this->print) : ?>
		<div id="pop-print" class="btn">
			<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
		</div>
		<div class="clearfix"> </div>
	<?php endif; ?>
	<?php if ($params->get('show_title') || $params->get('show_author')) : ?>
	<header class="article-header">
		<h2>
			<?php if ($this->item->state == 0) : ?>
				<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
			<?php endif; ?>
			<?php if ($params->get('show_title')) : ?>
				<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
					<a href="<?php echo $this->item->readmore_link; ?>"> <?php echo $this->escape($this->item->title); ?></a>
				<?php else : ?>
					<?php echo $this->escape($this->item->title); ?>
				<?php endif; ?>
			<?php endif; ?>
		</h2>
	</header>
	<?php endif; ?>
	<?php if (!$this->print) : ?>
		<?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
		<div class="btn-group pull-right">
			<a class="btn dropdown-toggle" data-toggle="dropdown" href="#"> <span class="fa fa-cog"></span> <span class="caret"></span> </a>
			<?php // Note the actions class is deprecated. Use dropdown-menu instead. ?>
			<ul class="dropdown-menu actions">
				<?php if ($params->get('show_print_icon')) : ?>
				<li class="print-icon"> <?php echo JHtml::_('icon.print_popup', $this->item, $params); ?> </li>
				<?php endif; ?>
				<?php if ($params->get('show_email_icon')) : ?>
				<li class="email-icon"> <?php echo JHtml::_('icon.email', $this->item, $params); ?> </li>
				<?php endif; ?>
				<?php if ($canEdit) : ?>
				<li class="edit-icon"> <?php echo JHtml::_('icon.edit', $this->item, $params); ?> </li>
				<?php endif; ?>
			</ul>
		</div>
		<?php endif; ?>
	<?php else : ?>
		<?php if ($useDefList) : ?>
			<div id="pop-print" class="btn">
				<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
		<aside class="article-aside">
			<dl class="article-info">
				<dt></dt>
				<?php if ($params->get('show_create_date')) : ?>
				
					<dd class="create">
						<span class="fa fa-clock-o"></span>
						<time datetime="<?php echo JHtml::_('date', $this->item->created, 'c'); ?>" >
							<?php echo JText::sprintf( JHtml::_('date', $this->item->created, JText::_('M j, Y'))); ?>
						</time>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
				
				<dd class="createdby" itemscope itemtype="http://schema.org/Person">
					<span class="fa fa-user"></span>
					<?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
					<?php $author = '<span itemprop="name">' . $author . '</span>'; ?>
					<?php if (!empty($this->item->contact_link) && $params->get('link_author') == true) : ?>
						<?php echo JText::sprintf( JHtml::_('link', $this->item->contact_link, $author, array('itemprop' => 'url'))); ?>
					<?php else: ?>
						<?php echo JText::sprintf($author); ?>
					<?php endif; ?>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_parent_category') && !empty($this->item->parent_slug)) : ?>
			
				<dd class="parent-category-name">
					<?php $title = $this->escape($this->item->parent_title); ?>
					<?php if ($params->get('link_parent_category') && !empty($this->item->parent_slug)) : ?>
						<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)) . '>' . $title . '</a>'; ?>
						<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
					<?php else : ?>
						<?php echo JText::sprintf('COM_CONTENT_PARENT', '<span itemprop="genre">' . $title . '</span>'); ?>
					<?php endif; ?>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_category')) : ?>
			
				<dd class="category-name">
					<?php $title = $this->escape($this->item->category_title); ?>
					<?php if ($params->get('link_category') && $this->item->catslug) : ?>
						<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)) . '">' . $title . '</a>'; ?>
						<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
					<?php else : ?>
						<?php echo JText::sprintf('COM_CONTENT_CATEGORY', '<span itemprop="genre">' . $title . '</span>'); ?>
					<?php endif; ?>
				</dd>
			<?php endif; ?>

			<?php if ($params->get('show_publish_date')) : ?>
			
				<dd class="published">
					
					<time datetime="<?php echo JHtml::_('date', $this->item->publish_up, 'c'); ?>" itemprop="datePublished">
						<?php echo JText::sprintf(JHtml::_('date', $this->item->publish_up, JText::_('M j, Y'))); ?>
					</time>
				</dd>
			<?php endif; ?>

			<?php if ($info == 0) : ?>
				<?php if ($params->get('show_modify_date')) : ?>
				
					<dd class="modified">
						<span class="icon-calendar"></span>
						<time datetime="<?php echo JHtml::_('date', $this->item->modified, 'c'); ?>" itemprop="dateModified">
							<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
						</time>
					</dd>
				<?php endif; ?>
				

				<?php if ($params->get('show_hits')) : ?>
				
					<dd class="hits">
						<i class="fa fa-bar-chart"></i>
						
						<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
					</dd>
				<?php endif; ?>	
					
				<?php endif; ?>
			</dl>
		</aside>
	<?php endif; ?>

	
	<?php if (!$params->get('show_intro')) : echo $this->item->event->afterDisplayTitle; endif; ?>
	
	<?php if ($params->get('show_vote', null)) :?>
		<div class="vote-info">
			<?php echo $this->item->event->beforeDisplayContent; ?>
		</div>
	<?php endif; ?>

	<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '0')) || ($params->get('urls_position') == '0' && empty($urls->urls_position)))
		|| (empty($urls->urls_position) && (!$params->get('urls_position')))) : ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php if ($params->get('access-view')):?>
	<?php
	if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && !$this->item->paginationrelative):
		echo $this->item->pagination;
	endif;
	?>
	
	<?php if (isset ($this->item->toc)) :
		echo $this->item->toc;
	endif; ?>
	
	<?php if ($params->get('show_tags', 1) && !empty($this->item->tags)) : ?>
		<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
	<?php endif; ?>
	<?php echo $this->item->text; ?>
	
	
	
	<?php if ($useDefList && ($info == 1 || $info == 2)) : ?>
		<div class="article-info muted">
			<dl class="article-info">
			<dt class="article-info-term"><?php echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>

			<?php if ($info == 1) : ?>
				<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
					<dd class="createdby">
						<?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
						<?php if (!empty($this->item->contactid) && $params->get('link_author') == true) : ?>
						<?php
						$needle = 'index.php?option=com_contact&view=contact&id=' . $this->item->contactid;
						$menu = JFactory::getApplication()->getMenu();
						$item = $menu->getItems('link', $needle, true);
						$cntlink = !empty($item) ? $needle . '&Itemid=' . $item->id : $needle;
						?>
						<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', JRoute::_($cntlink), $author)); ?>
						<?php else: ?>
						<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
						<?php endif; ?>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_parent_category') && !empty($this->item->parent_slug)) : ?>
					<dd class="parent-category-name">
						<?php	$title = $this->escape($this->item->parent_title);
						$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)) . '">' . $title . '</a>';?>
						<?php if ($params->get('link_parent_category') && $this->item->parent_slug) : ?>
							<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
						<?php else : ?>
							<?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
						<?php endif; ?>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_category')) : ?>
					<dd class="category-name">
						<?php 	$title = $this->escape($this->item->category_title);
						$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)) . '">' . $title . '</a>';?>
						<?php if ($params->get('link_category') && $this->item->catslug) : ?>
							<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
						<?php else : ?>
							<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
						<?php endif; ?>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_publish_date')) : ?>
					<dd class="published">
						<span class="ico-calendar"></span>
						<?php echo JText::sprintf(JHtml::_('date', $this->item->publish_up, JText::_('M j, Y'))); ?>
					</dd>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ($params->get('show_create_date')) : ?>
				<dd class="create">
					<span class="ico-calendar"></span>
					<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3'))); ?>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_modify_date')) : ?>
				<dd class="modified">
					<span class="icon-calendar"></span>
					<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_hits')) : ?>
				<dd class="hits">
					<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
				</dd>
			<?php endif; ?>
			</dl>
		</div>
	<?php endif; ?>

	<?php
if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && !$this->item->paginationrelative):
	echo $this->item->pagination;
?>
	<?php endif; ?>
	<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '1')) || ($params->get('urls_position') == '1'))) : ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php // Optional teaser intro text for guests ?>
	<?php elseif ($params->get('show_noauth') == true && $user->get('guest')) : ?>
	
	<?php echo $this->item->introtext; ?>
	
	<?php //Optional link to let them register to see the whole article. ?>
		<?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
			$link1 = JRoute::_('index.php?option=com_users&view=login');
			$link = new JUri($link1);?>
				<p class="readmore">
					<a href="<?php echo $link; ?>">
					<?php $attribs = json_decode($this->item->attribs); ?>
					<?php
					if ($attribs->alternative_readmore == null) :
						echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
					elseif ($readmore = $this->item->alternative_readmore) :
						echo $readmore;
						if ($params->get('show_readmore_title', 0) != 0) :
							echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
						endif;
					elseif ($params->get('show_readmore_title', 0) == 0) :
						echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
					else :
						echo JText::_('COM_CONTENT_READ_MORE');
						echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					endif; ?>
					</a>
				</p>
		<?php endif; ?>
	<?php endif; ?>
	<?php
if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && $this->item->paginationrelative) :
	echo $this->item->pagination;
?>
	<?php endif; ?>
	<?php echo $this->item->event->afterDisplayContent; ?> 
	
</article>
