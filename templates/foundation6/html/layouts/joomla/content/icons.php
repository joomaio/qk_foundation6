<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

JHtml::_('script', "tpl_foundation6/plugin/foundation.core.js", array('version' => 'auto', 'relative' => true));

$canEdit = $displayData['params']->get('access-edit');
$articleId = $displayData['item']->id;

$editUrl = ContentHelperRoute::getFormRoute($displayData['item']->id);
$returnUrl = ContentHelperRoute::getArticleRoute($displayData['item']->id,$displayData['item']->catid);
$returnUrl = base64_encode($returnUrl);  
?>

<div class="icons">
	<?php if (empty($displayData['print'])) : ?>

		<?php if ($canEdit || $displayData['params']->get('show_print_icon') || $displayData['params']->get('show_email_icon')) : ?>
			<button class="button" type="button" data-toggle="dropdown-<?php echo $articleId; ?>">
				<i class="fi-widget"></i>
				<span class="caret" aria-hidden="true"></span>
			</button>
			<div class="dropdown-pane" data-position="bottom" data-alignment="left" id="dropdown-<?php echo $articleId; ?>" aria-label="<?php echo JText::_('JUSER_TOOLS'); ?>" data-dropdown data-auto-focus="true">
				<?php if ($displayData['params']->get('show_print_icon')) : ?>
					<?php echo JHtml::_('icon.print_popup', $displayData['item'], $displayData['params']); ?>
				<?php endif; ?>
				<?php if ($displayData['params']->get('show_email_icon')) : ?>
					<?php echo JHtml::_('icon.email', $displayData['item'], $displayData['params']); ?>
				<?php endif; ?>
				<?php if ($canEdit) : ?>
					<?php echo "<a href=".JRoute::_($editUrl.'&return='.$returnUrl).">". JText::_( 'JACTION_EDIT' ) ."</a>"; ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

	<?php else : ?>

		<div class="pull-right">
			<?php echo JHtml::_('icon.print_screen', $displayData['item'], $displayData['params']); ?>
		</div>

	<?php endif; ?>
</div>
