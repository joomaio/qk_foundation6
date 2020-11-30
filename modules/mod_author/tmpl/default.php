<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_author
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$headerTag       = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
$headerClass    = $params->get('header_class');
$headerClass    = $headerClass ? ' class="' . htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8') . '"' : '';
?>
<div class="latestusers <?php echo $moduleclass_sfx; ?> mod-list">
	<?php if ($module->showtitle): ?>
		<<?php echo $headerTag . $headerClass . '>' . $module->title; ?></<?php echo $headerTag; ?>>
	<?php endif;?>
	<ul class="list" >
	<?php foreach ($names as $name) : ?>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_author&author_id=' . $name->id , false); ?>"><?php echo $name->name; ?></a>
		</li>
	<?php endforeach; ?>
	</ul>
</div>
