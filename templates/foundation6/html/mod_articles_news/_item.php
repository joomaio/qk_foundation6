<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="column">
<?php if ($params->get('img_intro_full') !== 'none' && !empty($item->imageSrc)) : ?>	
	<div class="newsflash-image">
		<a href="<?php echo $item->link; ?>">	
			<img class="thumbnail" src="<?php echo $item->imageSrc; ?>" alt="<?php echo $item->imageAlt; ?>">
			<?php if (!empty($item->imageCaption)) : ?>
				<figcaption>
					<?php echo $item->imageCaption; ?>
				</figcaption>
			<?php endif; ?>
		</a>
	</div>
<?php endif; ?>
<?php if ($params->get('item_title')) : ?>
	<?php $item_heading = $params->get('item_heading', 'h5'); ?>
	<<?php echo $item_heading; ?> class="newsflash-title">
	<?php if ($item->link !== '' && $params->get('link_titles')) : ?>
		<a href="<?php echo $item->link; ?>">
			<?php echo $item->title; ?>
		</a>
	<?php else : ?>
		<?php echo $item->title; ?>
	<?php endif; ?>
	</<?php echo $item_heading; ?>>
<?php endif; ?>

<?php if (!$params->get('intro_only')) : ?>
	<?php echo $item->afterDisplayTitle; ?>
<?php endif; ?>

<?php echo $item->beforeDisplayContent; ?>

<?php if ($params->get('show_introtext', 1)) : ?>
	<?php echo $item->introtext; ?>
<?php endif; ?>

<?php //echo $item->afterDisplayContent; ?>

<?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) : ?>
	<?php echo '<a class="button small expanded hollow" href="' . $item->link . '">' . $item->alternative_readmore . '</a>'; ?>
<?php endif; ?>
</div>