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
<div class="medium-8 large-6 row columns reset<?php echo $this->pageclass_sfx; ?>">
	<form id="user-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=reset.request'); ?>" method="post" class="form-validate form-horizontal well" data-abide novalidate>
		<?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
			<fieldset>
				<?php if (isset($fieldset->label)) : ?>
					<p><?php echo JText::_($fieldset->label); ?></p>
				<?php endif; ?>
				<?php echo $this->form->renderFieldset($fieldset->name); ?>
			</fieldset>
		<?php endforeach; ?>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="button primary validate margin-right-1">
					<?php echo JText::_('JSUBMIT'); ?>
				</button>
				<a class="success button" href="<?php echo JRoute::_('index.php?option=com_users&view=login'); ?>">
					<?php echo JText::_('TPL_FOUNDATION6_BACK_TO_LOGIN_BUTTON'); ?>
				</a>
			</div>
		</div>
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
