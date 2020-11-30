 
<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_popular
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$headerTag       = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
$headerClass    = $params->get('header_class');
$headerClass    = $headerClass ? ' class="' . htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8') . '"' : '';
?>
<div class="mostread <?php echo $moduleclass_sfx; ?> mod-list">
<?php if ($module->showtitle): ?>
	<<?php echo $headerTag . $headerClass . '>' . $module->title; ?></<?php echo $headerTag; ?>>
<?php endif;?>
<?php foreach ($list as $item) : ?>
	<div class="media-object" itemscope itemtype="https://schema.org/Article">
		<div class="media-object-section">
			<?php echo JLayoutHelper::render('joomla.content.intro_image', $item); ?>
		</div>
		<div class="media-object-section">
			<a href="<?php echo $item->link; ?>" itemprop="url">
				<h5 itemprop="name">
					<?php echo $item->title; ?>
				</h5>
			</a>
		</div>
	</div>
<?php endforeach; ?>
</div>