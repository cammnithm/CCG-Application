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

require_once JPATH_COMPONENT . '/controller.php';

/**
* Slider controller class.
*/
class CcgsliderControllerSlider extends CcgsliderController {


    public function getSliderImage(){
        $app  = JFactory::getApplication()->input;
        $id = intval($app->get('id'));
        $model = $this->getModel('Slider');
        $data = $model->getData($id);
        $picture_data = $data->picture;
        $picture_data_json= array();
        foreach($picture_data as $pic){

            $pic_item ['url'] = JUri::root() . '/images/' . $pic->file;
            $pic_item['folder'] = $data->title;
            $pic_item ['title'] = "";
            $pic_item['format'] = "";
            if(isset($pic->params)){
                $params = json_decode($pic->params);
                $pic_item ['title'] = $params->name;
                $pic_item['format'] = $params->format;
            }

            $picture_data_json[] = $pic_item;
        }
       echo json_encode( $picture_data_json);
    }
}