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
class WcatalogViewCategory extends JViewLegacy
{

	protected $view;
	protected $page;
	protected $menu;
	protected $category_id;
	

	public function display($tpl = null)
	{
		
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$this->view		= $this->get('Items');
		//$this->menu		= $this->get('Menu');
		$this->page = $app->input->getInt('page');
		if(!$this->page) $this->page = 1;
		$this->category_id = $app->input->getInt('id');
		if(!$this->category_id) $this->category_id = 1;
			
		parent::display($tpl);
	}
	
	public function getMenuItem($id) {
		$Model = $this->getModel('category');
		return $Model->getMenuItem($id);
	}	

}
