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
 * HTML View class for the Wcatalog component
 *
 * @package     Joomla.Site
 * @subpackage  com_wcatalog
 * @since       1.0
 */
class WcatalogViewProduct extends JViewLegacy
{

	protected $item;

	public function display($tpl = null)
	{
		
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$this->item		= $this->get('Item');
		$this->menu		= $this->get('Menu');


		parent::display($tpl);
	}
	
	public function getMenuItem($id) {
		$Model = $this->getModel('product');
		return $Model->getMenuItem($id);
	}	

}
