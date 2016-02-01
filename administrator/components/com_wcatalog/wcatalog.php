<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_wcatalog
 *
 * @copyright   Copyright (C) 2012 - 2013 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if (!JFactory::getUser()->authorise('core.manage', 'com_wcatalog'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

$controller	= JControllerLegacy::getInstance('Wcatalog');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
