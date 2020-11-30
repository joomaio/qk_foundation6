<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

//JHtml::_('tooltip');

$class = ' class="first"';
if ($this->maxLevelcat != 0 && count($this->items[$this->parent->id]) > 0) :
?>
	<?php foreach ($this->items[$this->parent->id] as $id => $item) : ?>
		<?php
		if ($this->params->get('show_empty_categories_cat') || $item->numitems || count($item->getChildren())) :
			if (!isset($this->items[$this->parent->id][$id + 1]))
			{
				$class = ' class="last"';
			}
			?>
			<div <?php echo $class; ?> >
			<?php $class = ''; ?>
				<h3 class="page-header item-title">
					<a href="<?php echo JRoute::_(ContactHelperRoute::getCategoryRoute($item->id, $item->language)); ?>">
					<?php echo $this->escape($item->title); ?></a>
					<?php if ($this->params->get('show_cat_items_cat') == 1) :?>
						<span class="label primary articles-counter" data-tooltip tabindex="1" title="<?php echo JHtml::_('tooltipText', 'TPL_FOUNDATION6_CONTACT_NUM_ITEMS'); ?>">
							<?php echo JText::_('COM_CONTACT_NUM_ITEMS'); ?>&nbsp;
							<?php echo $item->numitems; ?>
						</span>
					<?php endif; ?>
					<?php if ($this->params->get('show_subcat_desc_cat') == 1) : ?>
						<?php if ($item->description) : ?>
							<a class="expand-des button small" id="category-<?php echo $item->id; ?>" aria-label="<?php echo JText::_('JGLOBAL_EXPAND_CATEGORIES'); ?>"><i class="fi-plus"></i></a>
						<?php endif; ?>
					<?php endif; ?>
				</h3>
				<ul class="accordion show-category-<?php echo $item->id; ?>" data-accordion data-allow-all-closed="true">
					<li class="accordion-item" data-accordion-item>
						<div class="accordion-content" data-tab-content data-remote="category-<?php echo $item->id; ?>">
							<?php if ($this->params->get('show_subcat_desc_cat') == 1) : ?>
								<?php if ($item->description) : ?>
									<div class="category-desc">
										<?php echo JHtml::_('content.prepare', $item->description, '', 'com_contact.categories'); ?>
									</div>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</li>
				</ul>	

				<?php if ($this->maxLevelcat > 1 && count($item->getChildren()) > 0) : ?>
					<div class="subcategory">
						<?php
						$this->items[$item->id] = $item->getChildren();
						$this->parent = $item;
						$this->maxLevelcat--;
						echo $this->loadTemplate('items');
						$this->parent = $item->getParent();
						$this->maxLevelcat++;
						?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	<?php endforeach; ?><?php endif; ?>
