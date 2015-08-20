<?php
/**
 * @version     1.0.0
 * @package     com_ccgslider
 * @copyright   Copyright (C) 2015. Alle Rechte vorbehalten.
 * @license     GNU General Public License Version 2 oder später; siehe LICENSE.txt
 * @author      Timma <dieudonnetimma@yahoo.fr> - http://www.camgiess.de
 */


// no direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_ccgslider')) 
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

$controller	= JControllerLegacy::getInstance('Ccgslider');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
