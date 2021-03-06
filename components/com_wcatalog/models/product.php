<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_wcatalog
 *
 * @copyright   Copyright (C) 2012 - 2013 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Wcatalog Component Category Model
 *
 * @package     Joomla.Site
 * @subpackage  com_wcatalog
 * @since       1.5
 */
class WcatalogModelProduct extends JModelList
{


	public function __construct($config = array())
	{

		parent::__construct($config);
	}

	/**
	 * Method to get a list of items.
	 *
	 * @return  mixed  An array of objects on success, false on failure.
	 */
	public function getItem()
	{
		$app = JFactory::getApplication('site');
		$id = $app->input->getInt('id');
		$db = $this->getDbo();
		$query_string = '
			SELECT a.*, b.parent_id, c.title as category, b.title as subcategory
			FROM jmla_wcatalog_products as a
			LEFT JOIN jmla_wcatalog_categories as b ON a.category_id = b.id
			LEFT JOIN jmla_wcatalog_categories as c ON b.parent_id = c.id
			WHERE a.id='.$id.'
		';
		$db->setQuery($query_string);
		$items = $db->loadObjectList();		
		return $db->loadObject();
        }
	
	public function getMenu()
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('MAX(level) as max_l')->from('#__wcatalog_categories');
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		$max_l = $rows[0]->max_l;
		
		$query = $db->getQuery(true);
		
		/*
  SELECT
        t1.title as title1,
        t2.title as title2,
        t3.title as title3
    FROM #__wcatalog_categories as t1 LEFT JOIN #__wcatalog_categories as t2 ON t1.id = t2.parent_id LEFT JOIN #__wcatalog_categories as t3 ON t2.id = t3.parent_id
    WHERE t1.parent_id = 0
    ORDER BY t1.ordering, t2.ordering, t3.ordering ASC		
		*/
		
		$select = '';
		for($i = 1; $i <= $max_l; $i++) $select .= 't'.$i.'.id as id'.$i.', ';
		$select = substr($select, 0, -2);
		$query->select($select);
		$query->from('#__wcatalog_categories as t1');
		for($i = 2; $i <= $max_l; $i++) $query->join('LEFT', '#__wcatalog_categories AS t'.$i.' ON t'.($i-1).'.id = t'.$i.'.parent_id');
		$query->where('t1.parent_id = 0');
		$order = '';
		for($i = 1; $i <= $max_l; $i++) $order .= 't'.$i.'.ordering, ';
		$order = substr($order, 0, -2);		
		$query->order($order.' ASC');
		$db->setQuery($query);
		$items = $db->loadObjectList();
		
		foreach($items as $i => $field)
		{
			for($j = 1; $j <= $max_l; $j++)
			{
				eval('
					if($field->id'.$j.')
					{
						$menu[$field->id'.$j.'] = "";
					}
				');
			}
		}
		return $menu;
	}
	
	public function getMenuItem($id) {
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('a.*')->from('#__wcatalog_categories as a')->where('id = '.$id);
		$db->setQuery($query);
		$items = $db->loadObjectList();	
		return $items[0];
	}	
}