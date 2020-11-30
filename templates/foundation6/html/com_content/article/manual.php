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

// Create shortcuts to some parameters.
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();
$info    = $params->get('info_block_position', 0);

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (JLanguageAssociations::isEnabled() && $params->get('show_associations'));
//JHtmlF6::_('caption');

// add module
$document = JFactory::getDocument();
$modulerenderer = $document->loadRenderer('modules');
$messagerenderer = $document->loadRenderer('message');

// define logo
$app  = JFactory::getApplication();
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');

$tplparams = $app->getTemplate(true)->params;
// Logo file or site title param
if ($tplparams->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $tplparams->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($tplparams->get('sitename'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $tplparams->get('sitename') . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<div class="off-canvas-wrapper">
	<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper="">
		<div id="my-info" class="off-canvas position-left reveal-for-large" data-off-canvas>
			<div class="callout secondary">
				<h5><?php echo $this->item->title; ?></h5>
				<?php
					preg_match_all('/<h[1-6].*>.*<\/h[1-6]>/', $this->item->introtext.$this->item->fulltext,$matches);

					foreach($matches[0] as $title)
					{
						preg_match('/id\=\"(.*)\"\>/',$title,$url);
						preg_match('/<h3.*>(.*)<\/h3>/',$title,$heading3);
						preg_match('/<h4.*>(.*)<\/h4>/',$title,$heading4);
						preg_match('/<h5.*>(.*)<\/h5>/',$title,$heading5);

						$linktag = (isset($url[1])) ? '<a href="#'.$url[1].'">':'';
						$closelinktag = (isset($url[1])) ? '</a>':'';

						if(isset($heading3[1])) echo '<h6><b>'.$heading3[1].'</b></h6>';
						if(isset($heading4[1])) echo '<p style="margin-bottom: 0;"><i>'.$linktag.$heading4[1].$closelinktag.'</i></p>';
						if(isset($heading5[1])) echo '<p style="margin: 0 0 0 20px;">'.$linktag.$heading5[1].$closelinktag.'</p>';
						// var_dump($test2[1]);
					}
				?>
				<?php echo $modulerenderer->render('left'); ?>
			</div>
		</div>
		<div class="off-canvas-content" data-off-canvas-content>
			<div class="title-bar" data-responsive-toggle="top-bar-menu" data-hide-for="large">
				<div class="flex-container">
					<div class="small-title">
						<button class="menu-icon" type="button" data-toggle></button>
						<div class="title-bar-title"><?php echo JText::_('TPL_FOUNDATION6_MENU'); ?></div>
					</div>
					<div class="small-search">
						<?php echo $modulerenderer->render('search'); ?>
					</div>
				</div>
			</div>

			<div class="top-bar" id="top-bar-menu" data-animate="hinge-in-from-top hinge-out-from-top">
				<div class="top-bar-left">
					<div class="menu-text float-left"><a href="<?php echo JUri::base(); ?>"><?php echo $logo; ?></a></div>
					<?php echo $modulerenderer->render('menu1'); ?>
				</div>
				<div class="top-bar-right">
					<?php echo $modulerenderer->render('search'); ?>
				</div>
			</div>

			<div class="title-bar hide-for-large">
				<div class="title-bar-left">
					<button class="menu-icon" type="button" data-open="my-info"></button>
					<span class="title-bar-title"><?php echo JText::_('TPL_FOUNDATION6_LEFT_SIDEBAR_MENU'); ?></span>
				</div>
			</div>
			
			<?php if(!empty($modulerenderer->render('banner'))): ?>
				<?php echo $modulerenderer->render('banner'); ?>
			<?php endif; ?>

			<?php if(!empty($modulerenderer->render('position-1'))): ?>
				<?php echo $modulerenderer->render('position-1'); ?>
			<?php endif; ?>

			<?php if(!empty($modulerenderer->render('position-2'))): ?>
				<div class="row">
					<?php echo $modulerenderer->render('position-2'); ?>
				</div>
			<?php endif; ?>
			
			<!-- Main content -->
			<div class="main-content" id="content">
				<?php if(!empty($modulerenderer->render('top'))): ?>
					<?php echo $modulerenderer->render('top'); ?>
				<?php endif; ?>

				<?php echo $messagerenderer->render('message'); ?>
				<div class="margin-top-1 manual-page <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Article">
					<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />
					<?php if ($this->params->get('show_page_heading')) : ?>
					<div class="page-header">
						<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
					</div>
					<?php endif;
					if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
					{
						echo $this->item->pagination;
					}
					?>

					<?php // Todo Not that elegant would be nice to group the params ?>
					<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
					|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam); ?>

					<?php if (!$useDefList && $this->print) : ?>
						<div id="pop-print" class="btn hidden-print">
							<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
						</div>
						<div class="clearfix"> </div>
					<?php endif; ?>
					<?php if ($params->get('show_title') || $params->get('show_author')) : ?>
					<div class="page-header">
						<?php if ($params->get('show_title')) : ?>
							<h2 itemprop="headline">
								<?php echo $this->escape($this->item->title); ?>
							</h2>
						<?php endif; ?>
						<?php if ($this->item->state == 0) : ?>
							<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
						<?php endif; ?>
						<?php if (strtotime($this->item->publish_up) > strtotime(JFactory::getDate())) : ?>
							<span class="label label-warning"><?php echo JText::_('JNOTPUBLISHEDYET'); ?></span>
						<?php endif; ?>
						<?php if ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate()) : ?>
							<span class="label label-warning"><?php echo JText::_('JEXPIRED'); ?></span>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php if (!$this->print) : ?>
						<?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
							<?php echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false)); ?>
						<?php endif; ?>
					<?php else : ?>
						<?php if ($useDefList) : ?>
							<div id="pop-print" class="btn hidden-print">
								<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>

					<?php // Content is generated by content plugin event "onContentAfterTitle" ?>
					<?php echo $this->item->event->afterDisplayTitle; ?>

					<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
						<?php // Todo: for Joomla4 joomla.content.info_block.block can be changed to joomla.content.info_block ?>
						<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
					<?php endif; ?>

					<?php if ($info == 0 && $params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
						<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>

						<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
					<?php endif; ?>

					<?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
					<?php echo $this->item->event->beforeDisplayContent; ?>

					<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '0')) || ($params->get('urls_position') == '0' && empty($urls->urls_position)))
						|| (empty($urls->urls_position) && (!$params->get('urls_position')))) : ?>
					<?php echo $this->loadTemplate('links'); ?>
					<?php endif; ?>
					<?php if ($params->get('access-view')) : ?>
					<?php echo JLayoutHelper::render('joomla.content.full_image', $this->item); ?>
					<?php
					if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && !$this->item->paginationrelative) :
						echo $this->item->pagination;
					endif;
					?>
					<?php if (isset ($this->item->toc)) :
						echo $this->item->toc;
					endif; ?>
					<div itemprop="articleBody">
						<?php echo $this->item->text; ?>
					</div>

					<?php if ($info == 1 || $info == 2) : ?>
						<?php if ($useDefList) : ?>
								<?php // Todo: for Joomla4 joomla.content.info_block.block can be changed to joomla.content.info_block ?>
							<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
						<?php endif; ?>
						<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
							<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
							<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
						<?php endif; ?>
					<?php endif; ?>

					<?php
					if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && !$this->item->paginationrelative) :
						echo $this->item->pagination;
					?>
					<?php endif; ?>
					<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '1')) || ($params->get('urls_position') == '1'))) : ?>
					<?php echo $this->loadTemplate('links'); ?>
					<?php endif; ?>
					<?php // Optional teaser intro text for guests ?>
					<?php elseif ($params->get('show_noauth') == true && $user->get('guest')) : ?>
					<?php echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>
					<?php echo JHtml::_('content.prepare', $this->item->introtext); ?>
					<?php // Optional link to let them register to see the whole article. ?>
					<?php if ($params->get('show_readmore') && $this->item->fulltext != null) : ?>
					<?php $menu = JFactory::getApplication()->getMenu(); ?>
					<?php $active = $menu->getActive(); ?>
					<?php $itemId = $active->id; ?>
					<?php $link = new JUri(JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false)); ?>
					<?php $link->setVar('return', base64_encode(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language))); ?>
					<p class="readmore">
						<a href="<?php echo $link; ?>" class="register">
						<?php $attribs = json_decode($this->item->attribs); ?>
						<?php
						if ($attribs->alternative_readmore == null) :
							echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
						elseif ($readmore = $attribs->alternative_readmore) :
							echo $readmore;
							if ($params->get('show_readmore_title', 0) != 0) :
								echo JHtml::_('string.truncate', $this->item->title, $params->get('readmore_limit'));
							endif;
						elseif ($params->get('show_readmore_title', 0) == 0) :
							echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
						else :
							echo JText::_('COM_CONTENT_READ_MORE');
							echo JHtml::_('string.truncate', $this->item->title, $params->get('readmore_limit'));
						endif; ?>
						</a>
					</p>
					<?php endif; ?>
					<?php endif; ?>
					<?php
					if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && $this->item->paginationrelative) :
						echo $this->item->pagination;
					?>
					<?php endif; ?>
					<?php // Content is generated by content plugin event "onContentAfterDisplay" ?>
					<?php echo $this->item->event->afterDisplayContent; ?>
				</div>
				
				<?php if(!empty($modulerenderer->render('bottom'))): ?>
					<?php echo $modulerenderer->render('bottom'); ?>
				<?php endif; ?>
			</div>
			<!-- /Main content -->
			
			<?php if(!empty($modulerenderer->render('position-0'))): ?>
				<?php echo $modulerenderer->render('position-0'); ?>
			<?php endif; ?>

			<?php if(!empty($modulerenderer->render('position-7'))): ?>
				<div class="row">
					<?php echo $modulerenderer->render('position-7'); ?>
				</div>
			<?php endif; ?>

			<?php if(!empty($modulerenderer->render('position-8')) || !empty($modulerenderer->render('position-9')) || !empty($modulerenderer->render('position-10'))): ?>		
				<div class="callout large secondary">
					<div class="row">
						<div class="large-4 columns">
							<?php echo $modulerenderer->render('position-8'); ?>
						</div>
						<div class="large-3 large-offset-2 columns">
							<?php echo $modulerenderer->render('position-9'); ?>
						</div>
						<div class="large-3 columns">
							<?php echo $modulerenderer->render('position-10'); ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
			
			<footer>
				<div class="row expanded">
					<div class="medium-6 columns">
						<ul class="menu">
							<?php echo $modulerenderer->render('menu2'); ?>
						</ul>
					</div>
					<div class="medium-6 columns">
						<ul class="menu align-right">
							<li class="menu-text">&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?></li>
						</ul>
					</div>
				</div>
			</footer>  
		</div>
	</div>
</div>
