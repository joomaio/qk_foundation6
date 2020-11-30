<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_newsfeeds
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<?php $class = ' class="first"'; ?>
<?php if ($this->maxLevel != 0 && count($this->children[$this->category->id]) > 0) : ?>
	<div>
		<?php foreach ($this->children[$this->category->id] as $id => $child) : ?>
			<?php if ($this->params->get('show_empty_categories') || $child->numitems || count($child->getChildren())) : ?>
				<?php if (!isset($this->children[$this->category->id][$id + 1])) : ?>
					<?php $class = ' class="last"'; ?>
				<?php endif; ?>
				<div<?php echo $class; ?>>
					<?php $class = ''; ?>
					<h5 class="item-title">
						<a href="<?php echo JRoute::_(NewsfeedsHelperRoute::getCategoryRoute($child->id)); ?>">
							<?php echo $this->escape($child->title); ?>
						</a>
						<?php if ($this->params->get('show_cat_items_cat') == 1) :?>
							<span class="label primary articles-counter hasTooltip1" data-tooltip title="<?php echo JHtml::_('tooltipText', 'COM_CONTENT_NUM_ITEMS_TIP'); ?>">
								<?php echo JText::_('COM_NEWSFEEDS_NUM_ITEMS'); ?>&nbsp;
								<?php echo $child->numitems; ?>
							</span>
						<?php endif; ?>
					</h5>
					<?php if ($this->params->get('show_subcat_desc') == 1) : ?>
						<?php if ($child->description) : ?>
							<div class="category-desc">
								<?php echo JHtml::_('content.prepare', $child->description, '', 'com_newsfeeds.category'); ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
					<?php if (count($child->getChildren()) > 0) : ?>
						<?php $this->children[$child->id] = $child->getChildren(); ?>
						<?php $this->category = $child; ?>
						<?php $this->maxLevel--; ?>
						<?php echo $this->loadTemplate('children'); ?>
						<?php $this->category = $child->getParent(); ?>
						<?php $this->maxLevel++; ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif;
