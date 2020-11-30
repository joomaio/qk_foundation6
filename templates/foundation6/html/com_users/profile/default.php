<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;



JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');

?>
<div class="profile <?php echo $this->pageclass_sfx; ?>">	
	<?php if (JFactory::getUser()->id == $this->data->id) : ?>
		<a class="button primary margin-right-1" href="<?php echo JRoute::_('index.php?option=com_users&task=profile.edit&user_id=' . (int) $this->data->id); ?>">
			<span class="icon-user"></span>
			<?php echo JText::_('COM_USERS_EDIT_PROFILE'); ?>
		</a>
		<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.logout'); ?>" method="post" class="display-inline-block" data-abide novalidate>
			<div class="control-group">
				<div class="controls">
					<button type="submit" class="secondary button">
						<span class="icon-arrow-left icon-white"></span>
						<?php echo JText::_('JLOGOUT'); ?>
					</button>
				</div>
			</div>
			<?php if ($this->params->get('logout_redirect_url')) : ?>
				<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('logout_redirect_url', $this->form->getValue('return'))); ?>" />
			<?php else : ?>
				<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('logout_redirect_menuitem', $this->form->getValue('return'))); ?>" />
			<?php endif; ?>
			<?php echo JHtml::_('form.token'); ?>
		</form>	
	<?php endif; ?>
	<?php echo $this->loadTemplate('core'); ?>
	<?php echo $this->loadTemplate('params'); ?>
	<?php echo $this->loadTemplate('custom'); ?>
</div>
