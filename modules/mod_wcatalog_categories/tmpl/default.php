<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_wcatalog_categories
 *
 * @copyright   Copyright (C) 2012 - 2016 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<ul>
    <?php foreach($items as $item): ?>
		<li><a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$item->id); ?>"><?php echo $item->title ?></a></li>
    <?php endforeach ?>
</ul>