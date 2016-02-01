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
 * View class for a list of categories.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_wcatalog
 * @since       1.6
 */
class WcatalogViewCategories extends JViewLegacy
{
	protected $items;

	protected $pagination;

	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->items		= $this->get('CategoriesList');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		WcatalogHelper::addSubmenu('categories');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
		$state	= $this->get('State');
		$user	= JFactory::getUser();
		// Get the toolbar object instance
		$bar = JToolBar::getInstance('toolbar');
		JToolbarHelper::title(JText::_('COM_WCATALOG_MANAGER_CATEGORIES'), 'categories.png');
			JToolbarHelper::addNew('category.add');
			JToolbarHelper::editList('category.edit');
			JToolbarHelper::publish('categories.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('categories.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			//JToolbarHelper::archiveList('categories.archive');
			//JToolbarHelper::checkin('categories.checkin');
			JToolbarHelper::deleteList('', 'categories.delete', 'JTOOLBAR_DELETE');
			//JToolbarHelper::preferences('com_wcatalog');
		//JToolbarHelper::help('JHELP_COMPONENTS_WCATALOG_CATEGORIES');

		JHtmlSidebar::setAction('index.php?option=com_wcatalog&view=categories');
/*
		JHtmlSidebar::addFilter(
			JText::_('JOPTION_SELECT_PUBLISHED'),
			'filter_published',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.published'), true)
		);

		JHtmlSidebar::addFilter(
			JText::_('COM_WCATALOG_PARENT_CATEGORY'),
			'filter_category_id',
			JHtml::_('select.options', JHtml::_('category.options', 'com_wcatalog'), 'value', 'text', $this->state->get('filter.category_id'))
		);
		*/
	}

	/**
	 * Returns an array of fields the table can be sorted by
	 *
	 * @return  array  Array containing the field name to sort by as the key and display text as value
	 *
	 * @since   3.0
	 */
	protected function getSortFields()
	{
		return array(
			'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
			'a.published' => JText::_('JSTATUS'),
			'a.title' => JText::_('JGLOBAL_TITLE'),
			'a.description' => JText::_('COM_WCATALOG_DESCRIPTION'),
			'a.parent_title' => JText::_('COM_WCATALOG_PARENT'),
			'a.created' => JText::_('COM_WCATALOG_CREATED')
			//'category_title' => JText::_('JCATEGORY'),
			//'a.access' => JText::_('JGRID_HEADING_ACCESS'),
			//'numarticles' => JText::_('COM_NEWSFEEDS_NUM_ARTICLES_HEADING'),
			//'a.cache_time' => JText::_('COM_NEWSFEEDS_CACHE_TIME_HEADING'),
			//'a.language' => JText::_('JGRID_HEADING_LANGUAGE'),
			//'a.id' => JText::_('JGRID_HEADING_ID')
		);
	}
}
