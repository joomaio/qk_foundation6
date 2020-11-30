<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_contact
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');



$headerTag       = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
$headerClass    = $params->get('header_class');
$headerClass    = $headerClass ? ' class="' . htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8') . '"' : '';
?>
<div class="contact-form <?php echo $moduleclass_sfx; ?>">
	<?php if ($module->showtitle): ?>
		<<?php echo $headerTag . $headerClass . '>' . $module->title; ?></<?php echo $headerTag; ?>>
	<?php endif;?>
	<form id="contact-form" action="<?php echo JRoute::_('index.php?option=com_contact&view=contact&id=1'); ?>" method="post" class="form-validate form-horizontal well" data-abide novalidate>
		<?php foreach ($contactform['form']->getFieldsets() as $fieldset) : ?>
			<?php if ($fieldset->name === 'captcha' && !$contactform['captchaEnabled']) : ?>
				<?php continue; ?>
			<?php endif; ?>
			<?php $fields = $contactform['form']->getFieldset($fieldset->name); ?>
			<?php if (count($fields)) : ?>
				<fieldset class="contact-form-field">
					<?php foreach ($fields as $field) : ?>
						<?php echo $field->renderField(); ?>
					<?php endforeach; ?>
				</fieldset>
			<?php endif; ?>
		<?php endforeach; ?>
		<div class="control-group">
			<div class="controls">
				<button class="button validate" type="submit"><?php echo JText::_('COM_CONTACT_CONTACT_SEND'); ?></button>
				<input type="hidden" name="option" value="com_contact" />
				<input type="hidden" name="task" value="contact.submit" />
				<input type="hidden" name="return" value="<?php //echo base64_encode($active->link); ?>" />
				<input type="hidden" name="id" value="<?php echo $contactform['item']->slug; ?>" />
				<?php echo JHtml::_('form.token'); ?>
			</div>
		</div>
	</form>
</div>
