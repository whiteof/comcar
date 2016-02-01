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
 * wCatalog master display controller.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_wcatalog
 * @since   1.5
 */
class WcatalogController extends JControllerLegacy
{
	/**
	 * Method to display a view.
	 *
	 * @param   boolean			If true, the view output will be cached
	 * @param   array  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JController		This object to support chaining.
	 * @since   1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/wcatalog.php';

		$view   = $this->input->get('view', 'categories');
		$layout = $this->input->get('layout', 'default');
		$id     = $this->input->getInt('id');
		
		// Check for edit form.
		if ($view == 'product' && $layout == 'edit' && !$this->checkEditId('com_wcatalog.edit.product', $id))
		{
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_wcatalog&view=categories', false));

			return false;
		}
		
		parent::display();
	}
}
