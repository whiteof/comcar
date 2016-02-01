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
 * Methods supporting a list of category records.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_wcatalog
 * @since       1.6
 */
class WcatalogModelCategories extends JModelList
{
	/**
	 * Constructor.
	 *
	 * @param   array  An optional associative array of configuration settings.
	 * @see     JController
	 * @since   1.6
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'title', 'a.title',
				'description', 'a.description',
				'parent_id', 'a.parent_id', 'category_title',
				'ordering', 'a.ordering',
				'published', 'a.published',
				'created', 'a.created',
				'created_by', 'a.created_by',
				'modified', 'a.modified',
				'modified_by', 'a.modified_by'				
			);

			$app = JFactory::getApplication();
			$assoc = isset($app->item_associations) ? $app->item_associations : 0;
			if ($assoc)
			{
				$config['filter_fields'][] = 'association';
			}
		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$accessId = $this->getUserStateFromRequest($this->context . '.filter.access', 'filter_access', null, 'int');
		$this->setState('filter.access', $accessId);

		$state = $this->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '', 'string');
		$this->setState('filter.published', $state);

		$categoryId = $this->getUserStateFromRequest($this->context . '.filter.category_id', 'filter_category_id', null);
		$this->setState('filter.category_id', $categoryId);

		$language = $this->getUserStateFromRequest($this->context . '.filter.language', 'filter_language', '');
		$this->setState('filter.language', $language);

		// force a language
		$forcedLanguage = $app->input->get('forcedLanguage');
		if (!empty($forcedLanguage))
		{
			$this->setState('filter.language', $forcedLanguage);
			$this->setState('filter.forcedLanguage', $forcedLanguage);
		}

		$tag = $this->getUserStateFromRequest($this->context . '.filter.tag', 'filter_tag', '');
		$this->setState('filter.tag', $tag);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_wcatalog');
		$this->setState('params', $params);

		// List state information.
		parent::populateState();
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string    A prefix for the store id.
	 *
	 * @return  string    A store id.
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.access');
		$id .= ':' . $this->getState('filter.published');
		$id .= ':' . $this->getState('filter.category_id');
		$id .= ':' . $this->getState('filter.language');

		return parent::getStoreId($id);
	}

	protected function getListQuery()
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('*')->from('#__wcatalog_categories');
		return $query;
	}
	
	public function getCategoriesList()
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('MAX(level) as max_l')->from('#__wcatalog_categories');
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		$max_l = $rows[0]->max_l;
		
		$query = $db->getQuery(true);

		$select = '';
		for($i = 1; $i <= $max_l; $i++) $select .= 't'.$i.'.id as id'.$i.', ';
		if(!empty($select)) $select = substr($select, 0, -2);
		else $select = '*';
		$query->select($select);
		$query->from('#__wcatalog_categories as t1');
		for($i = 2; $i <= $max_l; $i++) $query->join('LEFT', '#__wcatalog_categories AS t'.$i.' ON t'.($i-1).'.id = t'.$i.'.parent_id');
		$query->where('t1.parent_id = 0');
		$order = '';
		for($i = 1; $i <= $max_l; $i++) $order .= 't'.$i.'.ordering, ';
		$order = substr($order, 0, -2);		
		if(!empty($order)) $query->order($order.' ASC');
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
		$items = array();
		foreach($menu as $id => $val)
		{
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$query->select(
				$this->getState(
					'list.select',
					'a.*, b.title as parent_title'
				)
			)
			->from('#__wcatalog_categories as a')
			->join('LEFT', $db->quoteName('#__wcatalog_categories') . ' AS b ON b.id = a.parent_id')
			->where('a.id = '.$id);
			
			$db->setQuery($query);
			$items[] = $db->loadObject();
		}
		return $items;
	}	
}
