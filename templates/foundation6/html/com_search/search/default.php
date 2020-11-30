<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('formbehavior.chosen', 'select');

?>
<div class="search <?php echo $this->pageclass_sfx; ?>">
	<div class="row">
		<div class="columns large-3">
			<?php echo $this->loadTemplate('form'); ?>
		</div>
		<div class="columns large-9">
			<?php if (!empty($this->searchword)) : ?>
				<div class="searchintro">
						<h5>
							<?php echo JText::plural('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', '<span class="badge primary">' . $this->total . '</span>'); ?>
						</h5>
				</div>
			<?php endif; ?>
			<?php if ($this->total > 0) : ?>
				<p class="counter">
					<?php echo $this->pagination->getPagesCounter(); ?>
				</p>
			<?php endif; ?>
			<?php if ($this->error == null && count($this->results) > 0) : ?>
				<?php echo $this->loadTemplate('results'); ?>
			<?php else : ?>
				<?php echo $this->loadTemplate('error'); ?>
			<?php endif; ?>
		</div>
	</div>	
</div>
