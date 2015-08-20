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

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_ccgslider.' . $this->item->id);
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_ccgslider' . $this->item->id)) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>
<?php if ($this->item) : ?>

    <div class="item_fields">
        <table class="table">
            <tr>
			<th><?php echo JText::_('COM_CCGSLIDER_FORM_LBL_SLIDER_ID'); ?></th>
			<td><?php echo $this->item->id; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_CCGSLIDER_FORM_LBL_SLIDER_STATE'); ?></th>
			<td>
			<i class="icon-<?php echo ($this->item->state == 1) ? 'publish' : 'unpublish'; ?>"></i></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_CCGSLIDER_FORM_LBL_SLIDER_CREATED_BY'); ?></th>
			<td><?php echo $this->item->created_by_name; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_CCGSLIDER_FORM_LBL_SLIDER_TITLE'); ?></th>
			<td><?php echo $this->item->title; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_CCGSLIDER_FORM_LBL_SLIDER_FILE'); ?></th>
			<td>
			<?php $uploadPath = 'administrator' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_ccgslider' . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR . $this->item->file; ?>
			<a href="<?php echo JRoute::_(JUri::base() . $uploadPath, false); ?>" target="_blank"><?php echo $this->item->file; ?></a></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_CCGSLIDER_FORM_LBL_SLIDER_DESCRIPTION'); ?></th>
			<td><?php echo $this->item->description; ?></td>
</tr>

        </table>
    </div>
    <?php if($canEdit && $this->item->checked_out == 0): ?>
		<a class="btn" href="<?php echo JRoute::_('index.php?option=com_ccgslider&task=slider.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_CCGSLIDER_EDIT_ITEM"); ?></a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_ccgslider.slider.'.$this->item->id)):?>
									<a class="btn" href="<?php echo JRoute::_('index.php?option=com_ccgslider&task=slider.remove&id=' . $this->item->id, false, 2); ?>"><?php echo JText::_("COM_CCGSLIDER_DELETE_ITEM"); ?></a>
								<?php endif; ?>
    <?php
else:
    echo JText::_('COM_CCGSLIDER_ITEM_NOT_LOADED');
endif;
?>
