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
 * View to edit a category.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_wcatalog
 * @since       1.6
 */
class WcatalogViewCategory extends JViewLegacy
{
	protected $item;

	protected $form;

	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');
		$this->categories	= $this->get('Categories');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->id == 0);
		//$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		// Since we don't track these assets at the item level, use the category id.
		//$canDo		= WcatalogHelper::getActions($this->item->catid, 0);

		JToolbarHelper::title(JText::_('COM_WCATALOG_MANAGER_CATEGORY'), 'categories.png');

		// If not checked out, can save the item.
		//if (!$checkedOut && ($canDo->get('core.edit') || count($user->getAuthorisedCategories('com_wcatalog', 'core.create')) > 0))
		//{
			JToolbarHelper::apply('category.apply');
			JToolbarHelper::save('category.save');
		//}
		//if (!$checkedOut && count($user->getAuthorisedCategories('com_wcatalog', 'core.create')) > 0){
			JToolbarHelper::save2new('category.save2new');
		//}
		// If an existing item, can save to a copy.
		//if (!$isNew && $canDo->get('core.create'))
		//{
			JToolbarHelper::save2copy('category.save2copy');
		//}

		if (empty($this->item->id))
		{
			JToolbarHelper::cancel('category.cancel');
		}
		else
		{
			JToolbarHelper::cancel('category.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolbarHelper::divider();
		JToolbarHelper::help('JHELP_COMPONENTS_WCATALOG_CATEGORIES_EDIT');
	}
}
