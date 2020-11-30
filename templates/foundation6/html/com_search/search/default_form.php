<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

////JHtml::_('tooltip');

$lang = JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();

?>
<form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_search'); ?>" method="post">
	<div class="btn-to1olbar">
		<div class="input-group">
			<input type="text" name="searchword" title="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" placeholder="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" id="search-searchword" size="30" maxlength="<?php echo $upper_limit; ?>" value="<?php echo $this->escape($this->origkeyword); ?>" class="inputbox input-group-field" />
			<div class="input-group-button">
				<button type="button" name="Search" onclick="this.form.submit()" class="button btn hasTooltip1" data-tooltip title="<?php echo JHtml::_('tooltipText', 'COM_SEARCH_SEARCH');?>">
					<i class="fi-magnifying-glass"></i>
				</button>
			</div>
		</div>

		<input type="hidden" name="task" value="search" />
		<div class="clearfix"></div>
	</div>
	<?php if ($this->params->get('search_phrases', 1)) : ?>
		<div class="phrases">
			<b>
				<?php echo JText::_('COM_SEARCH_FOR'); ?>
			</b>
			<div class="phrases-box">
				<?php echo $this->lists['searchphrase']; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if ($this->params->get('search_areas', 1)) : ?>
		<div class="only">
			<b>
				<?php echo JText::_('COM_SEARCH_SEARCH_ONLY'); ?>
			</b>
			<?php foreach ($this->searchareas['search'] as $val => $txt) : ?>
				<?php $checked = is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']) ? 'checked="checked"' : ''; ?>
				<label for="area-<?php echo $val; ?>" class="checkbox">
					<input type="checkbox" name="areas[]" value="<?php echo $val; ?>" id="area-<?php echo $val; ?>" <?php echo $checked; ?> />
					<?php echo JText::_($txt); ?>
				</label>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<?php if ($this->total > 0) : ?>
		<div class="form-limit">
			<div class="ordering-box">
				<label for="ordering" class="ordering label">
					<?php echo JText::_('COM_SEARCH_ORDERING'); ?>
				</label>
				<?php echo $this->lists['ordering']; ?>
			</div>
			<label class="label" for="limit">
				<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
			</label>
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
	<?php endif; ?>
</form>