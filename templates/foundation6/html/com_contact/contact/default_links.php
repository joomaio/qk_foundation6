<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php if ($this->params->get('presentation_style') === 'sliders') : ?>
	<a href="#" class="accordion-title"><?php echo JText::_('COM_CONTACT_LINKS'); ?></a>
		<div class="accordion-content" data-tab-content>
<?php endif; ?>
<?php if ($this->params->get('presentation_style') === 'tabs') : ?>
	<div class="tabs-panel" id="show_links">
<?php endif; ?>
<?php if ($this->params->get('presentation_style') === 'plain') : ?>
	<div class="column medium-6">
	<?php echo '<h3>' . JText::_('COM_CONTACT_LINKS') . '</h3>'; ?>
<?php endif; ?>

<div class="contact-links">
	<ul class="nav nav-tabs nav-stacked">
		<?php
		// Letters 'a' to 'e'
		foreach (range('a', 'e') as $char) :
			$link = $this->contact->params->get('link' . $char);
			$label = $this->contact->params->get('link' . $char . '_name');

			if (!$link) :
				continue;
			endif;

			// Add 'http://' if not present
			$link = (0 === strpos($link, 'http')) ? $link : 'http://' . $link;

			// If no label is present, take the link
			$label = $label ?: $link;
			?>
			<li>
				<a href="<?php echo $link; ?>" itemprop="url">
					<?php echo $label; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>

<?php if ($this->params->get('presentation_style') === 'sliders') : ?>
		</div>
	</div>
<?php elseif ($this->params->get('presentation_style') === 'tabs') : ?>
	</div>
<?php else: ?>
	</div>
<?php endif; ?>
