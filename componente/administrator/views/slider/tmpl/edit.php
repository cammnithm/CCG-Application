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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_ccgslider/assets/css/ccgslider.css');
?>
<script type="text/javascript">
    js = jQuery.noConflict();
    js(document).ready(function() {
        
    });

    Joomla.submitbutton = function(task)
    {
        if (task == 'slider.cancel') {
            Joomla.submitform(task, document.getElementById('slider-form'));
        }
        else {
            
				js = jQuery.noConflict();
				if(js('#jform_file').val() != ''){
					js('#jform_file_hidden').val(js('#jform_file').val());
				}
				if (js('#jform_file').val() == '' && js('#jform_file_hidden').val() == '') {
					alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
					return;
				}
            if (task != 'slider.cancel' && document.formvalidator.isValid(document.id('slider-form'))) {
                
                Joomla.submitform(task, document.getElementById('slider-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_ccgslider&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="slider-form" class="form-validate">

    <div class="form-horizontal">
        <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_CCGSLIDER_TITLE_SLIDER', true)); ?>
        <div class="row-fluid">
            <div class="span10 form-horizontal">
                <fieldset class="adminform">

                    				<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
				<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
				<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
				<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
				<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />

				<?php if(empty($this->item->created_by)){ ?>
					<input type="hidden" name="jform[created_by]" value="<?php echo JFactory::getUser()->id; ?>" />

				<?php } 
				else{ ?>
					<input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" />

				<?php } ?>			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('title'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('title'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('file'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('file'); ?></div>
			</div>
            <div class="control-group">
                <div class="row">
                    <?php foreach ($this->item->picture as $file){?>
                    <div class="col-md-4">
                        <a href="<?php echo JUri::root(true) . "/images/" .$file->file; ?>" class="img-responsive">
                            <img src="<?php echo JUri::root(true) . "/images/" .$file->file; ?>" alt="<?php echo $file->file; ?>" class="img-responsive"style="width:150px;height:150px">
                        </a>
                    </div>
                    <?php  } ?>
                    </div>
            </div>

				<?php if (!empty($this->item->file)) : ?>
						<a href="<?php echo JRoute::_(JUri::base() . 'components' . DIRECTORY_SEPARATOR . 'com_ccgslider' . DIRECTORY_SEPARATOR . 'image' .DIRECTORY_SEPARATOR . $this->item->file, false);?>"><?php echo JText::_("COM_CCGSLIDER_VIEW_FILE"); ?></a>
				<?php endif; ?>
				<input type="hidden" name="jform[file]" id="jform_file_hidden" value="<?php echo $this->item->file ?>" />			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('description'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('description'); ?></div>
			</div>


                </fieldset>
            </div>
        </div>
        <?php echo JHtml::_('bootstrap.endTab'); ?>
        
        <?php if (JFactory::getUser()->authorise('core.admin','ccgslider')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'permissions', JText::_('JGLOBAL_ACTION_PERMISSIONS_LABEL', true)); ?>
		<?php echo $this->form->getInput('rules'); ?>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
<?php endif; ?>

        <?php echo JHtml::_('bootstrap.endTabSet'); ?>

        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>

    </div>
</form>