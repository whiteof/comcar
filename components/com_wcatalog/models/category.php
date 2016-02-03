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
class WcatalogModelCategory extends JModelList
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
	public function getItems()
	{		
		$app = JFactory::getApplication('site');
		$id = $app->input->getInt('id');
		$return = array();
		if($id) {
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$query->select('*')
				  ->from('#__wcatalog_categories')
				  ->where('id='.$id);
			$db->setQuery($query);
			$category = $db->loadObject();
			if(intval($category->parent_id) == 0) {
				$query = $db->getQuery(true);
				$query->select('*')
					  ->from('#__wcatalog_categories')
					  ->where('parent_id='.$category->id);
				$db->setQuery($query);
				$items = $db->loadObjectList();
				$return = array(
					'view' => 'categories',
					'items' => $items
				);
			}else {
				
				$query_string = '
					SELECT a.*, b.parent_id
					FROM jmla_wcatalog_products as a
					LEFT JOIN jmla_wcatalog_categories as b ON a.category_id = b.id
					WHERE a.category_id='.$category->id.'
				';
				$db->setQuery($query_string);
				$items = $db->loadObjectList();
				$return = array(
					'view' => 'products',
					'items' => $items
				);
			}
		}
		return $return;
		
		/*
SELECT p.* FROM jmla_wcatalog_products as p,
    (SELECT c.* FROM
        (SELECT
            t1.id as id1,
            t2.id as id2,
            t3.id as id3
        FROM
            jmla_wcatalog_categories as t1 LEFT JOIN
            jmla_wcatalog_categories as t2 ON t1.id = t2.parent_id LEFT JOIN
            jmla_wcatalog_categories as t3 ON t2.id = t3.parent_id
        WHERE t1.parent_id = 0
        ORDER BY t1.ordering, t2.ordering, t3.ordering ASC) as c
    WHERE
        c.id1 = 3 OR
        c.id2 = 3 OR
        c.id3 = 3) as cs
WHERE
    p.category_id = cs.id1 OR
    p.category_id = cs.id2 OR
    p.category_id = cs.id3
		
	$query_string =
'SELECT p.* FROM jmla_wcatalog_products as p,
    (SELECT c.* FROM
        (SELECT ';
	for($i = 1; $i <= $max_l; $i++) $query_string .= 't'.$i.'.id as id'.$i.', ';
	$query_string = substr($query_string, 0, -2).' ';
	$query_string .='FROM jmla_wcatalog_categories as t1 ';
	for($i = 2; $i <= $max_l; $i++) $query_string .= 'LEFT JOIN jmla_wcatalog_categories as t'.$i.' ON t'.($i-1).'.id = t'.$i.'.parent_id ';
	$query_string .= 'WHERE t1.parent_id = 0 ORDER BY ';
        for($i = 1; $i <= $max_l; $i++) $query_string .= 't'.$i.'.ordering, ';
	$query_string = substr($query_string, 0, -2).' ASC) as c WHERE ';
	for($i = 1; $i <= $max_l; $i++) $query_string .= 'c.id'.$i.' = '.$id.' OR ';
	$query_string = substr($query_string, 0, -4);
	$query_string .= ') as cs WHERE (';
	for($i = 1; $i <= $max_l; $i++) $query_string .= 'p.category_id = cs.id'.$i.' OR ';
	$query_string = substr($query_string, 0, -4);
	$query_string .= ') AND p.published = 1';
		
		$db = $this->getDbo();

		$db->setQuery($query_string);
		$items = $db->loadObjectList();

		return $items;
*/
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
