<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<div class="latestnews <?php echo $params->get('moduleclass_sfx'); ?> mod-list">
<?php foreach ($list as $item) : ?>
	<div class="column">
		<a href="<?php echo $item->link; ?>" itemprop="url">
			<?php echo JLayoutHelper::render('joomla.content.intro_image', $item); ?>
		</a><h5><a href="<?php echo $item->link; ?>" itemprop="url"><span itemprop="name">
			<?php echo $item->title; ?>
		</span></a></h5>
	</div>
<?php endforeach; ?>
</div>
