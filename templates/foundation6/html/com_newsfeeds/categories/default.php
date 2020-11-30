<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_newsfeeds
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
//JHtmlF6::_('caption');
JHtml::_('behavior.core');

// Add strings for translations in Javascript.
JText::script('JGLOBAL_EXPAND_CATEGORIES');
JText::script('JGLOBAL_COLLAPSE_CATEGORIES');


?>
<div class="categories-list <?php echo $this->pageclass_sfx; ?> all-categories">
	<?php //echo JLayoutHelper::render('joomla.content.categories_default', $this); ?>
	<?php echo $this->loadTemplate('items'); ?>
</div>                                 
<script>
	jQuery('a.expand-des').on('click', function() {
		jQuery(this).html(jQuery(this).html() == '<i class="fi-plus"></i>' ? '<i class="fi-minus"></i>' : '<i class="fi-plus"></i>');
		var dataTarget = jQuery(this).attr('id');
		jQuery('.show-'+dataTarget).foundation('toggle', jQuery('[data-remote=\"' + dataTarget + '\"]'));
	});
</script>
