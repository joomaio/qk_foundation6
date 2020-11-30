<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$params             = $this->item->params;
$presentation_style = $params->get('presentation_style');

$displayGroups      = $params->get('show_user_custom_fields');
$userFieldGroups    = array();
?>

<?php if (!$displayGroups || !$this->contactUser) : ?>
	<?php return; ?>
<?php endif; ?>

<?php foreach ($this->contactUser->jcfields as $field) : ?>
	<?php if (!in_array('-1', $displayGroups) && (!$field->group_id || !in_array($field->group_id, $displayGroups))) : ?>
		<?php continue; ?>
	<?php endif; ?>
	<?php if (!key_exists($field->group_title, $userFieldGroups)) : ?>
		<?php $userFieldGroups[$field->group_title] = array(); ?>
	<?php endif; ?>
	<?php $userFieldGroups[$field->group_title][] = $field; ?>
<?php endforeach; ?>

<?php if ($presentation_style == 'tabs') : ?>
	<!-- tabs -->
	<ul class="tabs" data-tabs id="contact-tabs">
		<?php foreach ($userFieldGroups as $groupTitle => $fields) : ?>
			<?php $id = JApplicationHelper::stringURLSafe($groupTitle); ?>
			<li class="tabs-title"><a href="#<?php echo 'display-' . $id; ?>" aria-selected="true"><?php echo $groupTitle ?: JText::_('COM_CONTACT_USER_FIELDS'); ?></a></li>
		<?php endforeach;?>
	</ul>
	<div class="tabs-content" data-tabs-content="contact-tabs">
<?php endif;?>

<?php foreach ($userFieldGroups as $groupTitle => $fields) : ?>
	<?php $id = JApplicationHelper::stringURLSafe($groupTitle); ?>
	<?php if ($presentation_style == 'sliders') : ?>
		<div class="accordion-item slide-contact" id="<?php echo 'display-' . $id; ?>" data-accordion-item>
			<a href="#" class="accordion-title"><?php echo $groupTitle ?: JText::_('COM_CONTACT_USER_FIELDS'); ?></a>
				<div class="accordion-content" data-tab-content>
	<?php elseif ($presentation_style == 'tabs') : ?>
		<div class="tabs-panel" id="<?php echo 'display-' . $id; ?>">
	<?php elseif ($presentation_style == 'plain') : ?>
		<?php echo '<h3>' . ($groupTitle ?: JText::_('COM_CONTACT_USER_FIELDS')) . '</h3>'; ?>
	<?php endif; ?>

	<div class="contact-profile" id="user-custom-fields-<?php echo $id; ?>">
		<dl class="dl-horizontal">
		<?php foreach ($fields as $field) : ?>
			<?php if (!$field->value) : ?>
				<?php continue; ?>
			<?php endif; ?>

			<?php if ($field->params->get('showlabel')) : ?>
				<?php echo '<dt>' . JText::_($field->label) . '</dt>'; ?>
			<?php endif; ?>

			<?php echo '<dd>' . $field->value . '</dd>'; ?>
		<?php endforeach; ?>
		</dl>
	</div>

	<?php if ($presentation_style == 'sliders') : ?>
			</div>
		</div>
	<?php elseif ($presentation_style == 'tabs') : ?>
		</div>
	<?php endif; ?>
<?php endforeach; ?>

<?php if ($presentation_style == 'tabs') : ?>
	</div>
<?php endif; ?>