<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;



JHtml::_('tabstate');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
JHtml::_('formbehavior.chosen', '#jform_catid', null, array('disable_search_threshold' => 0));
JHtml::_('formbehavior.chosen', '#jform_tags', null, array('placeholder_text_multiple' => JText::_('JGLOBAL_TYPE_OR_SELECT_SOME_TAGS')));
JHtml::_('formbehavior.chosen', 'select');
$this->tab_name = 'com-content-form';
$this->ignore_fieldsets = array('image-intro', 'image-full', 'jmetadata', 'item_associations');

// Create shortcut to parameters.
$params = $this->state->get('params');

// This checks if the editor config options have ever been saved. If they haven't they will fall back to the original settings.
$editoroptions = isset($params->show_publishing_options);

$app       = JFactory::getApplication();
$form      = $this->getForm();
$fieldSets = $form->getFieldsets();

if (empty($fieldSets))
{
	return;
}

$ignoreFieldsets = $this->get('ignore_fieldsets') ?: array();
$ignoreFields    = $this->get('ignore_fields') ?: array();
$extraFields     = $this->get('extra_fields') ?: array();
$tabName         = $this->get('tab_name') ?: 'myTab';

// These are required to preserve data on save when fields are not displayed.
$hiddenFieldsets = $this->get('hiddenFieldsets') ?: array();

// These are required to configure showing and hiding fields in the editor.
$configFieldsets = $this->get('configFieldsets') ?: array();

if (!$editoroptions)
{
	$params->show_urls_images_frontend = '0';
}

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'article.cancel' || document.formvalidator.isValid(document.getElementById('adminForm')))
		{
			" . $this->form->getField('articletext')->save() . "
			Joomla.submitform(task);
		}
	}
");
?>
<div class="edit item-page <?php echo $this->pageclass_sfx; ?>">
	<?php if ($params->get('show_page_heading')) : ?>
	<div class="page-header">
		<h1>
			<?php echo $this->escape($params->get('page_heading')); ?>
		</h1>
	</div>
	<?php endif; ?>

	<form action="<?php echo JRoute::_('index.php?option=com_content&a_id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-vertical" data-abide novalidate>
		<fieldset>
			<ul class="tabs" data-tabs id="edit-content-tabs">
				<li class="tabs-title is-active"><a href="#editor" aria-selected="true"><?php echo JText::_('COM_CONTENT_ARTICLE_CONTENT'); ?></a></li>
				<?php if ($params->get('show_urls_images_frontend')) : ?>
				<li class="tabs-title"><a data-tabs-target="images" href="#images"><?php echo JText::_('COM_CONTENT_IMAGES_AND_URLS'); ?></a></li>
				<?php endif; ?>
				<li class="tabs-title"><a data-tabs-target="publishing" href="#publishing"><?php echo JText::_('COM_CONTENT_PUBLISHING'); ?></a></li>
				<li class="tabs-title"><a data-tabs-target="language" href="#language"><?php echo JText::_('JFIELD_LANGUAGE_LABEL'); ?></a></li>
				<?php if ($params->get('show_publishing_options', 1) == 1) : ?>
				<li class="tabs-title"><a data-tabs-target="metadata" href="#metadata"><?php echo JText::_('COM_CONTENT_METADATA'); ?></a></li>
				<?php endif; ?>
				<?php foreach($fieldSets as $name => $fieldSet):
					// Ensure any fieldsets we don't want to show are skipped (including repeating formfield fieldsets)
					if ((isset($fieldSet->repeat) && $fieldSet->repeat === true)
						|| in_array($name, $ignoreFieldsets)
						|| (!empty($configFieldsets) && in_array($name, $configFieldsets, true))
						|| (!empty($hiddenFieldsets) && in_array($name, $hiddenFieldsets, true))
					)
					{
						continue;
					}
					// Determine the label
					if (!empty($fieldSet->label))
					{
						$label = JText::_($fieldSet->label);
					}
					else
					{
						$label = strtoupper('JGLOBAL_FIELDSET_' . $name);
						if (JText::_($label) === $label)
						{
							$label = strtoupper($app->input->get('option') . '_' . $name . '_FIELDSET_LABEL');
						}
						$label = JText::_($label);
					} ?>					
					<li class="tabs-title"><a data-tabs-target="attrib-<?php echo $name; ?>" href="#attrib-<?php echo $name; ?>"><?php echo $label; ?></a></li>
				<?php endforeach; ?>
			</ul>
			<div class="tabs-content" data-tabs-content="edit-content-tabs">
				<div class="tabs-panel is-active" id="editor">
					<?php echo $this->form->renderField('title'); ?>

					<?php if (is_null($this->item->id)) : ?>
						<?php echo $this->form->renderField('alias'); ?>
					<?php endif; ?>

					<?php echo $this->form->getInput('articletext'); ?>

					<?php if ($this->captchaEnabled) : ?>
						<?php echo $this->form->renderField('captcha'); ?>
					<?php endif; ?>
				</div>
				<?php if ($params->get('show_urls_images_frontend')) : ?>
				<div class="tabs-panel" id="images">
					<?php echo $this->form->renderField('image_intro', 'images'); ?>
					<?php echo $this->form->renderField('image_intro_alt', 'images'); ?>
					<?php echo $this->form->renderField('image_intro_caption', 'images'); ?>
					<?php echo $this->form->renderField('float_intro', 'images'); ?>
					<?php echo $this->form->renderField('image_fulltext', 'images'); ?>
					<?php echo $this->form->renderField('image_fulltext_alt', 'images'); ?>
					<?php echo $this->form->renderField('image_fulltext_caption', 'images'); ?>
					<?php echo $this->form->renderField('float_fulltext', 'images'); ?>
					<?php echo $this->form->renderField('urla', 'urls'); ?>
					<?php echo $this->form->renderField('urlatext', 'urls'); ?>
					<div class="control-group">
						<div class="controls">
							<?php echo $this->form->getInput('targeta', 'urls'); ?>
						</div>
					</div>
					<?php echo $this->form->renderField('urlb', 'urls'); ?>
					<?php echo $this->form->renderField('urlbtext', 'urls'); ?>
					<div class="control-group">
						<div class="controls">
							<?php echo $this->form->getInput('targetb', 'urls'); ?>
						</div>
					</div>
					<?php echo $this->form->renderField('urlc', 'urls'); ?>
					<?php echo $this->form->renderField('urlctext', 'urls'); ?>
					<div class="control-group">
						<div class="controls">
							<?php echo $this->form->getInput('targetc', 'urls'); ?>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php
					// Handle the hidden fieldsets when show_options is set false
					if (!$this->get('show_options', 1))
					{
						// The HTML buffer
						$html   = array();

						// Hide the whole buffer
						$html[] = '<div style="display:none;">';

						// Loop over the fieldsets
						foreach ($fieldSets as $name => $fieldSet)
						{
							// Check if the fieldset should be ignored
							if (in_array($name, $ignoreFieldsets, true))
							{
								continue;
							}

							// If it is a hidden fieldset, render the inputs
							if (in_array($name, $hiddenFieldsets))
							{
								// Loop over the fields
								foreach ($form->getFieldset($name) as $field)
								{
									// Add only the input on the buffer
									$html[] = $field->input;
								}

								// Make sure the fieldset is not rendered twice
								$ignoreFieldsets[] = $name;
							}

							// Check if it is the correct fieldset to ignore
							if (strpos($name, 'basic') === 0)
							{
								// Ignore only the fieldsets which are defined by the options not the custom fields ones
								$ignoreFieldsets[] = $name;
							}
						}

						// Close the container
						$html[] = '</div>';

						// Echo the hidden fieldsets
						echo implode('', $html);
					}

					// Loop again over the fieldsets
					foreach ($fieldSets as $name => $fieldSet)
					{
						// Ensure any fieldsets we don't want to show are skipped (including repeating formfield fieldsets)
						if ((isset($fieldSet->repeat) && $fieldSet->repeat === true)
							|| in_array($name, $ignoreFieldsets)
							|| (!empty($configFieldsets) && in_array($name, $configFieldsets, true))
							|| (!empty($hiddenFieldsets) && in_array($name, $hiddenFieldsets, true))
						)
						{
							continue;
						}

						// Determine the label
						if (!empty($fieldSet->label))
						{
							$label = JText::_($fieldSet->label);
						}
						else
						{
							$label = strtoupper('JGLOBAL_FIELDSET_' . $name);
							if (JText::_($label) === $label)
							{
								$label = strtoupper($app->input->get('option') . '_' . $name . '_FIELDSET_LABEL');
							}
							$label = JText::_($label);
						}

						// Start the tab
						echo '<div class="tabs-panel" id="attrib-' . $name.'">';

						// Include the description when available
						if (isset($fieldSet->description) && trim($fieldSet->description))
						{
							echo '<p class="alert alert-info">' . $this->escape(JText::_($fieldSet->description)) . '</p>';
						}

						// The name of the fieldset to render
						$this->fieldset = $name;

						// Force to show the options
						$this->showOptions = true;

						// Render the fieldset
						echo JLayoutHelper::render('joomla.edit.fieldset', $this);

						// End the tab
						echo '</div>';
					}
				?>
				<div class="tabs-panel" id="publishing">
					<?php echo $this->form->renderField('catid'); ?>
					<?php echo $this->form->renderField('tags'); ?>
					<?php echo $this->form->renderField('note'); ?>
					<?php if ($params->get('save_history', 0)) : ?>
						<?php echo $this->form->renderField('version_note'); ?>
					<?php endif; ?>
					<?php if ($params->get('show_publishing_options', 1) == 1) : ?>
						<?php echo $this->form->renderField('created_by_alias'); ?>
					<?php endif; ?>
					<?php if ($this->item->params->get('access-change')) : ?>
						<?php echo $this->form->renderField('state'); ?>
						<?php echo $this->form->renderField('featured'); ?>
						<?php if ($params->get('show_publishing_options', 1) == 1) : ?>
							<?php echo $this->form->renderField('publish_up'); ?>
							<?php echo $this->form->renderField('publish_down'); ?>
						<?php endif; ?>
					<?php endif; ?>
					<?php echo $this->form->renderField('access'); ?>
					<?php if (is_null($this->item->id)) : ?>
						<div class="control-group">
							<div class="control-label">
							</div>
							<div class="controls">
								<?php echo JText::_('COM_CONTENT_ORDERING'); ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<div class="tabs-panel" id="language">
					<?php echo $this->form->renderField('language'); ?>
				</div>
				<?php if ($params->get('show_publishing_options', 1) == 1) : ?>
					<div class="tabs-panel" id="metadata">
						<?php echo $this->form->renderField('metadesc'); ?>
						<?php echo $this->form->renderField('metakey'); ?>
					</div>
				<?php endif; ?>	
			</div>
		
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="return" value="<?php echo $this->return_page; ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</fieldset>
		<div class="btn-toolbar">
			<button type="button" class="button primary" onclick="Joomla.submitbutton('article.save')">
				<span class="icon-ok"></span><?php echo JText::_('JSAVE') ?>
			</button>
			<button type="button" class="button secondary" onclick="Joomla.submitbutton('article.cancel')">
				<span class="icon-cancel"></span><?php echo JText::_('JCANCEL') ?>
			</button>
			<?php if ($params->get('save_history', 0) && $this->item->id) : ?>
			<?php echo $this->form->getInput('contenthistory'); ?>
			<?php endif; ?>
		</div>
	</form>
</div>
