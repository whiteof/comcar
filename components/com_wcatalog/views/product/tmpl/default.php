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
	<div class="w_menu">
		<?php /*foreach($this->menu as $id => $val):?>
			<?php $menu = $this->getMenuItem($id); ?>
			<?php if($menu->published == 1): ?>
				<div id="<?php echo $id ?>" class="w_level" style="padding-left: <?php echo $menu->level ?>0px;">
					<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$id); ?>"><?php echo $menu->title ?></a>
				</div>
			<?php endif ?>
		<?php endforeach*/ ?>		
	</div>
	<div class="w_content">
			<div class="w_product_page">
				<div class="w_product_img">
					<img src="<?php echo JURI::root().$this->item->image ?>" width="300px" height="300px" />
				</div>
				<div class="w_product_title">
					<?php echo $this->item->title ?>
				</div>
				<div class="w_product_description">
					<?php echo $this->item->description ?>
				</div>
			</div>
	</div>
	<div style="clear: both;"></div>
</div>