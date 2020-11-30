<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.pagebreak
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<ul class="pager pagination-pagebreak">
	<li class="display-inline">
		<?php if ($links['previous']) : ?>
		<a href="<?php echo $links['previous']; ?>">
			<?php echo trim('<i class="fi-arrow-left"></i> ' . JText::_('JPREV')); ?>
		</a>
		<?php else: ?>
		<?php echo JText::_('JPREV'); ?>
		<?php endif; ?>
	</li>
	<li class="display-inline">
		<?php if ($links['next']) : ?>
		<a href="<?php echo $links['next']; ?>">
			<?php echo trim(JText::_('JNEXT') . ' <i class="fi-arrow-right"></i>'); ?>
		</a>
		<?php else: ?>
		<?php echo JText::_('JNEXT'); ?>
		<?php endif; ?>
	</li>
</ul>
