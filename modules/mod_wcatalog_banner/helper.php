<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_wcatalog_banner
 *
 * @copyright   Copyright (C) 2012 - 2016 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Helper for mod_wcatalog_banner
 *
 * @package     Joomla.Site
 * @subpackage  mod_wcatalog_banner
 * @since       1.5
 */
class ModWcatalogBannerHelper
{
	public static function getItems()
	{
		$items = array();
		$db = JFactory::getDBO();
		$query = '
			SELECT *
			FROM #__wcatalog_categories
			WHERE parent_id = 0
			ORDER BY ordering ASC
		';
		$db->setQuery($query);
		$items = $db->loadObjectList();
		return $items;
	}
}
