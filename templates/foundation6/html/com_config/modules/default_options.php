<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_config
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$fieldSets = $this->form->getFieldsets('params');

echo '<div class="accordion" data-accordion data-multi-expand="true" data-allow-all-closed="true">';
$i = 0;

foreach ($fieldSets as $name => $fieldSet) :

$label = !empty($fieldSet->label) ? $fieldSet->label : 'COM_MODULES_' . $name . '_FIELDSET_LABEL';
$class = isset($fieldSet->class) && !empty($fieldSet->class) ? $fieldSet->class : '';


if (isset($fieldSet->description) && trim($fieldSet->description)) :
echo '<p class="tip">' . $this->escape(JText::_($fieldSet->description)) . '</p>';
endif;
?>
<?php echo '<div class="accordion-item" data-accordion-item>
				<a href="#" class="accordion-title">'.JText::_($label).'</a>
				<div class="accordion-content" data-tab-content>'; ?>

<?php foreach ($this->form->getFieldset($name) as $field) : ?>
	<div class="grid-x grid-padding-x">
		<div class="small-4 cell">
			<label for="middle-label" class="text-right middle"><?php echo $field->label; ?></label>
		</div>
		<div class="small-8 cell">
			<?php
				// If multi-language site, make menu-type selection read-only
				if (JLanguageMultilang::isEnabled() && $this->item['module'] === 'mod_menu' && $field->getAttribute('name') === 'menutype')
				{
					$field->__set('readonly', true);
				}
				echo $field->input;
			?>
		</div>
	</div>
<?php endforeach; ?>

<?php echo '</div></div>'; ?>
<?php endforeach; ?>
<?php echo '</div>' ?>
