<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_newsfeeds
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.caption');

?>
<div class="wcatalog">
	<?php if($this->view['view'] == 'categories'): ?>
		<div class="row">
			<?php foreach($this->view['items'] as $item): ?>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<a class="wcatalog-category" href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$item->id); ?>">
						<div class="make">
							<div class="make-logo">
								<img src="<?php echo JURI::base().'images/wcatalog/logos/'.strtolower(str_replace(' ', '', $item->title)).'.png' ?>" />
							</div>
							<div class="make-title">
								<?php echo $item->title ?>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach ?>
		</div>
	<?php endif  ?>
	
	<?php if($this->view['view'] == 'products'): ?>
		<div class="row">
			<?php foreach($this->view['items'] as $item): ?>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<a class="wcatalog-product" href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=product&id='.$item->id); ?>">
						<div class="product">
							<div class="product-image">
								<div class="bar">
									<img class="img-responsive" src="<?php echo JURI::base().'images/wcatalog/products/'.$item->image ?>" />
								</div>
							</div>
							<div class="product-info">
								<p><?php echo ucfirst(trim($item->title)) ?></p>
								<div class="price"><?php echo $item->price?> руб.</div>
								<p class="price-desc"><?php echo ucfirst(trim($item->description)) ?></p>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach ?>
		</div>
	<?php endif  ?>
	
	
	
	
	
	<?php /*
	<div class="w_menu">
		<?php foreach($this->menu as $id => $val):?>
			<?php $menu = $this->getMenuItem($id); ?>
			<?php if($menu->published == 1): ?>
				<div id="<?php echo $id ?>" class="w_level" style="padding-left: <?php echo $menu->level ?>0px;">
					<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$id); ?>"><?php echo $menu->title ?></a>
				</div>
			<?php endif ?>
		<?php endforeach ?>		
	</div>
	
	<div class="w_content">
		<?php $cat_arr = array();?>
		<?php $category = $this->getMenuItem($this->category_id);?>
		<?php for($l = $category->level; $l >= 1; $l--):?>
			<?php $cat_arr[] = $category;?>
			<?php if ($category->parent_id != 0) $category = $this->getMenuItem($category->parent_id);?>
		<?php endfor ?>
		
		<div class="w_content_info">
			<?php for($l = (count($cat_arr)-1); $l >= 0; $l--):?>
				<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$cat_arr[$l]->id); ?>">
					<?php echo $cat_arr[$l]->title;?>
				</a>
				<?php if($l != 0) echo ' -> '; ?>
			<?php endfor ?>
		</div>
		<?php $j = 1;?>
		<table width="100%">
		<tbody>
			<?php $cat_arr = array(); ?>
		<?php foreach($this->items as $i => $item):?>
			<?php $cat_arr[$item->category_id] = $this->getMenuItem($item->category_id)->title; ?>
			<?php if (($i >= (($this->page-1)*9))and($i < ($this->page*9))): ?>
				<?php if($j == 1): ?>
					<tr>
				<?php endif ?>
				<td valign="top">
					<div class="w_product">
						<div class="w_product_img">
							<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=product&id='.$item->id); ?>">
								<img src="<?php echo JURI::base().'images/wcatalog/category_1/111.00802.1.jpg' ?>" width="200px" height="200px" />
							</a>
						</div>
						<div class="w_product_title">
							<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=product&id='.$item->id); ?>"><?php echo $item->title ?></a>
						</div>
					</div>
				</td>
				<?php if($j == 3): ?>
					</tr>
					<?php $j = 0;?>
				<?php endif ?>
				<?php $j++ ?>
			<?php endif ?>
		<?php endforeach ?>
		</tbody>
		</table>
	</div>
	<div style="clear: both;"></div>
	<?php if(count($this->items) > 9):?>
	<?php
		$last_page = (int)(count($this->items)/9);
		if((count($this->items)%9) > 0) $last_page++;
		$next_page = $this->page + 1;
		if($next_page > $last_page) $next_page = $last_page;
		$prev_page = $this->page - 1;
		if($prev_page == 0) $prev_page = 1;
	?>
		<div class="pager">
			<div class="pager_but"><a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$this->category_id.'&page=1'); ?>"><<</a></div>
			<div class="pager_but"><a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$this->category_id.'&page='.$prev_page); ?>"><</a></div>
			<?php for($s = 1; $s <= $last_page; $s++): ?>
			<?php if ($s == $this->page):?>
				<div class="pager_but"><?php echo $s ?></div>
			<?php else: ?>
				<div class="pager_but"><a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$this->category_id.'&page='.$s); ?>"><?php echo $s ?></a></div>
			<?php endif ?>
			<?php endfor ?>
			<div class="pager_but"><a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$this->category_id.'&page='.$next_page); ?>">></a></div>
			<div class="pager_but"><a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$this->category_id.'&page='.$last_page); ?>">>></a></div>		
		</div>
	<?php endif ?>
	*/?>
</div>