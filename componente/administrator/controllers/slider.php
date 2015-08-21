<?php
/**
 * @version     1.0.0
 * @package     com_ccgslider
 * @copyright   Copyright (C) 2015. Alle Rechte vorbehalten.
 * @license     GNU General Public License Version 2 oder später; siehe LICENSE.txt
 * @author      Timma <dieudonnetimma@yahoo.fr> - http://www.camgiess.de
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Slider controller class.
 */
class CcgsliderControllerSlider extends JControllerForm
{

    function __construct() {
        $this->view_list = 'sliders';
        parent::__construct();
    }

}