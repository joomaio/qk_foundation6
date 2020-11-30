<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
JHtml::_('formbehavior.chosen', 'select');
//JHtmlF6::_('caption');

?>
<div class="archive <?php echo $this->pageclass_sfx; ?>">
<form id="adminForm" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-inline">
	<fieldset class="filters">
	<div class="row">
		<?php if ($this->params->get('filter_field') !== 'hide') : ?>
			<div class="medium-4 column">
				<label class="label" for="filter-search"><?php echo JText::_('COM_CONTENT_TITLE_FILTER_LABEL') . '&#160;'; ?></label>
				<input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->filter); ?>" class="inputbox span2" onchange="document.getElementById('adminForm').submit();" placeholder="<?php echo JText::_('COM_CONTENT_TITLE_FILTER_LABEL'); ?>" />
			</div>
			<div class="column medium-offset-8"></div>
		<?php endif; ?>

		<div class="medium-3 column"><?php echo $this->form->monthField; ?></div>
		<div class="medium-3 column"><?php echo $this->form->yearField; ?></div>
		<div class="medium-3 column"><?php echo $this->form->limitField; ?></div>
		<div class="medium-3 column"><button type="submit" class="button" style="vertical-align: top;"><?php echo JText::_('JGLOBAL_FILTER_BUTTON'); ?></button></div>
		<input type="hidden" name="view" value="archive" />
		<input type="hidden" name="option" value="com_content" />
		<input type="hidden" name="limitstart" value="0" />
	</div>
	<br />
	</fieldset>

	<?php echo $this->loadTemplate('items'); ?>
</form>
</div>
