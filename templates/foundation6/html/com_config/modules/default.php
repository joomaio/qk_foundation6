<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_config
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


//JHtml::_('tooltip');
JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.combobox');
JHtml::_('formbehavior.chosen', 'select');

jimport('joomla.filesystem.file');

$editorText  = false;
$moduleXml   = JPATH_SITE . '/modules/' . $this->item['module'] . '/' . $this->item['module'] . '.xml';

if (JFile::exists($moduleXml))
{
	$xml = simplexml_load_file($moduleXml);

	if (isset($xml->customContent))
	{
		$editorText = true;
	}
}

// If multi-language site, make language read-only
if (JLanguageMultilang::isEnabled())
{
	$this->form->setFieldAttribute('language', 'readonly', 'true');
}

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'config.cancel.modules' || document.formvalidator.isValid(document.getElementById('modules-form')))
		{
			Joomla.submitform(task, document.getElementById('modules-form'));
		}
	}
");
?>
<div class="columns medium-8">
<form
	action="<?php echo JRoute::_('index.php?option=com_config'); ?>"
	method="post" name="adminForm" id="modules-form"
	class="form-validate" data-abide novalidate>

	<div class="row-fluid">

		<!-- Begin Content -->
		<div class="span12">

			<div class="btn-toolbar" role="toolbar" aria-label="<?php echo JText::_('JTOOLBAR'); ?>">
				<div class="button-group">
					<button type="button" class="button primary"
						onclick="Joomla.submitbutton('config.save.modules.apply')">
						<span class="icon-apply" aria-hidden="true"></span>
						<?php echo JText::_('JAPPLY'); ?>
					</button>
				
					<button type="button" class="button primary"
						onclick="Joomla.submitbutton('config.save.modules.save')">
						<span class="icon-save" aria-hidden="true"></span>
						<?php echo JText::_('JSAVE'); ?>
					</button>
				
					<button type="button" class="button secondary"
						onclick="Joomla.submitbutton('config.cancel.modules')">
						<span class="icon-cancel" aria-hidden="true"></span>
						<?php echo JText::_('JCANCEL'); ?>
					</button>
				</div>
			</div>

			<hr class="hr-condensed" />

			<h3><?php echo JText::_('COM_CONFIG_MODULES_SETTINGS_TITLE'); ?></h3>

			<div>
				<?php echo JText::_('COM_CONFIG_MODULES_MODULE_NAME'); ?>
				<span class="label label-default"><?php echo $this->item['title']; ?></span>
				&nbsp;&nbsp;
				<?php echo JText::_('COM_CONFIG_MODULES_MODULE_TYPE'); ?>
				<span class="label label-default"><?php echo $this->item['module']; ?></span>
			</div>
			<hr />

			<div class="fields">
				<fieldset class="form-horizontal">
					<div class="grid-x grid-padding-x">
						<div class="small-4 cell">
							<label for="middle-label" class="text-right middle"><?php echo $this->form->getLabel('title'); ?></label>
						</div>
						<div class="small-8 cell">
							<?php echo $this->form->getInput('title'); ?>
						</div>
					</div>
					<div class="grid-x grid-padding-x">
						<div class="small-4 cell">
							<label for="middle-label" class="text-right middle"><?php echo $this->form->getLabel('showtitle'); ?></label>
						</div>
						<div class="small-8 cell">
							<?php echo $this->form->getInput('showtitle'); ?>
						</div>
					</div>
					<div class="grid-x grid-padding-x">
						<div class="small-4 cell">
							<label for="middle-label" class="text-right middle"><?php echo $this->form->getLabel('position'); ?></label>
						</div>
						<div class="small-8 cell">
							<?php echo $this->loadTemplate('positions'); ?>
						</div>
					</div>

					<hr />

					<?php if (JFactory::getUser()->authorise('core.edit.state', 'com_modules.module.' . $this->item['id'])) : ?>
					<div class="grid-x grid-padding-x">
						<div class="small-4 cell">
							<label for="middle-label" class="text-right middle"><?php echo $this->form->getLabel('published'); ?></label>
						</div>
						<div class="small-8 cell">
							<?php echo $this->form->getInput('published'); ?>
						</div>
					</div>
					<?php endif ?>

					<div class="grid-x grid-padding-x">
						<div class="small-4 cell">
							<label for="middle-label" class="text-right middle"><?php echo $this->form->getLabel('publish_up'); ?></label>
						</div>
						<div class="small-8 cell">
							<?php echo $this->form->getInput('publish_up'); ?>
						</div>
					</div>
					
					<div class="grid-x grid-padding-x">
						<div class="small-4 cell">
							<label for="middle-label" class="text-right middle"><?php echo $this->form->getLabel('publish_down'); ?></label>
						</div>
						<div class="small-8 cell">
							<?php echo $this->form->getInput('publish_down'); ?>
						</div>
					</div>

					<div class="grid-x grid-padding-x">
						<div class="small-4 cell">
							<label for="middle-label" class="text-right middle"><?php echo $this->form->getLabel('access'); ?></label>
						</div>
						<div class="small-8 cell">
							<?php echo $this->form->getInput('access'); ?>
						</div>
					</div>

					<div class="grid-x grid-padding-x">
						<div class="small-4 cell">
							<label for="middle-label" class="text-right middle"><?php echo $this->form->getLabel('ordering'); ?></label>
						</div>
						<div class="small-8 cell">
							<?php echo $this->form->getInput('ordering'); ?>
						</div>
					</div>

					<div class="grid-x grid-padding-x">
						<div class="small-4 cell">
							<label for="middle-label" class="text-right middle"><?php echo $this->form->getLabel('language'); ?></label>
						</div>
						<div class="small-8 cell">
							<?php echo $this->form->getInput('language'); ?>
						</div>
					</div>

					<div class="grid-x grid-padding-x">
						<div class="small-4 cell">
							<label for="middle-label" class="text-right middle"><?php echo $this->form->getLabel('note'); ?></label>
						</div>
						<div class="small-8 cell">
							<?php echo $this->form->getInput('note'); ?>
						</div>
					</div>

					<hr />

					<div id="options">
						<?php echo $this->loadTemplate('options'); ?>
					</div>

					<?php if ($editorText) : ?>
						<div class="tab-pane" id="custom">
							<?php echo $this->form->getInput('content'); ?>
						</div>
					<?php endif; ?>
				</fieldset>

				<input type="hidden" name="id" value="<?php echo $this->item['id']; ?>" />
				<input type="hidden" name="return" value="<?php echo JFactory::getApplication()->input->get('return', null, 'base64'); ?>" />
				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>

			</div>

		</div>
		<!-- End Content -->
	</div>

</form>
</div>