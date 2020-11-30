<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<fieldset id="users-profile-core">
	<h3>
		<?php echo JText::_('COM_USERS_PROFILE_CORE_LEGEND'); ?>
	</h3>
	<table class="hover">
		<tbody>
			<tr>
				<td width="400"><?php echo JText::_('COM_USERS_PROFILE_NAME_LABEL'); ?></td>
				<td><?php echo $this->escape($this->data->name); ?></td>
			</tr>
			<tr>
				<td><?php echo JText::_('COM_USERS_PROFILE_USERNAME_LABEL'); ?></td>
				<td><?php echo $this->escape($this->data->username); ?></td>
			</tr>
			<tr>
				<td><?php echo JText::_('COM_USERS_PROFILE_REGISTERED_DATE_LABEL'); ?></td>
				<td><?php echo JHtml::_('date', $this->data->registerDate, JText::_('DATE_FORMAT_LC1')); ?></td>
			</tr>
			<tr>
				<td><?php echo JText::_('COM_USERS_PROFILE_LAST_VISITED_DATE_LABEL'); ?></td>
				<td>
					<?php if ($this->data->lastvisitDate != $this->db->getNullDate()) : ?>
						<?php echo JHtml::_('date', $this->data->lastvisitDate, JText::_('DATE_FORMAT_LC1')); ?>
					<?php else : ?>
						<?php echo JText::_('COM_USERS_PROFILE_NEVER_VISITED'); ?>
					<?php endif; ?>
				</td>
			</tr>
		</tbody>
	</table>
</fieldset>
