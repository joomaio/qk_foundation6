<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.html.html.bootstrap');

$cparams = JComponentHelper::getParams('com_media');
$tparams = $this->item->params;

?>

<div class="contact <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Person">
	

	<?php $show_contact_category = $tparams->get('show_contact_category'); ?>

	<?php if ($show_contact_category === 'show_no_link') : ?>
		<h3>
			<span class="contact-category"><?php echo $this->contact->category_title; ?></span>
		</h3>
	<?php elseif ($show_contact_category === 'show_with_link') : ?>
		<?php $contactLink = ContactHelperRoute::getCategoryRoute($this->contact->catid); ?>
		<h3>
			<span class="contact-category"><a href="<?php echo $contactLink; ?>">
				<?php echo $this->escape($this->contact->category_title); ?></a>
			</span>
		</h3>
	<?php endif; ?>

	<?php echo $this->item->event->afterDisplayTitle; ?>

	<?php if ($tparams->get('show_contact_list') && count($this->contacts) > 1) : ?>
		<form action="#" method="get" name="selectForm" id="selectForm">
			<label for="select_contact"><?php echo JText::_('COM_CONTACT_SELECT_CONTACT'); ?></label>
			<?php echo JHtml::_('select.genericlist', $this->contacts, 'select_contact', 'class="inputbox" onchange="document.location.href = this.value"', 'link', 'name', $this->contact->link); ?>
		</form>
	<?php endif; ?>

	<?php if ($tparams->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
		<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
		<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
	<?php endif; ?>

	<?php echo $this->item->event->beforeDisplayContent; ?>

	<?php $presentation_style = $tparams->get('presentation_style'); ?>
	<?php $accordionStarted = false; ?>
	<?php $tabSetStarted = false; ?>
	<?php if ($presentation_style === 'sliders') : ?>
		<div class="accordion" data-accordion data-multi-expand="true" data-allow-all-closed="true">
	<?php elseif ($presentation_style === 'tabs') : ?>
		<!-- tabs -->
		<ul class="tabs" data-tabs id="contact-tabs">
			<?php if ($this->params->get('show_info', 1)) : ?>
				<li class="tabs-title is-active"><a href="#show_info" aria-selected="true"><?php echo JText::_('COM_CONTACT_DETAILS'); ?></a></li>
			<?php endif; ?>
			<?php if ($tparams->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
				<li class="tabs-title"><a data-tabs-target="show_email_form" href="#show_email_form"><?php echo JText::_('COM_CONTACT_EMAIL_FORM'); ?></a></li>
			<?php endif; ?>
			<?php if ($tparams->get('show_links')) : ?>
				<li class="tabs-title"><a data-tabs-target="show_links" href="#show_links"><?php echo JText::_('COM_CONTACT_LINKS'); ?></a></li>
			<?php endif; ?>
			<?php if ($tparams->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
				<li class="tabs-title"><a data-tabs-target="show_articles" href="#show_articles"><?php echo JText::_('JGLOBAL_ARTICLES'); ?></a></li>
			<?php endif; ?>
			<?php if ($tparams->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
				<li class="tabs-title"><a data-tabs-target="show_profile" href="#show_profile"><?php echo JText::_('COM_CONTACT_PROFILE'); ?></a></li>
			<?php endif; ?>
			<?php if ($this->contact->misc && $tparams->get('show_misc')) : ?>
				<li class="tabs-title"><a data-tabs-target="show_misc" href="#show_misc"><?php echo JText::_('COM_CONTACT_OTHER_INFORMATION'); ?></a></li>
			<?php endif; ?>
		</ul>
		<div class="tabs-content" data-tabs-content="contact-tabs">
	<?php endif; ?>
	
	<?php if ($this->params->get('show_info', 1)) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<?php $accordionStarted = true; ?>
			<div class="accordion-item is-active" data-accordion-item>
				<a href="#" class="accordion-title"><?php echo JText::_('COM_CONTACT_DETAILS'); ?></a>
				<div class="accordion-content" data-tab-content>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<div class="tabs-panel is-active" id="show_info">
			<?php $tabSetStarted = true; ?>
		<?php elseif ($presentation_style === 'plain') : ?>
			<div class="column medium-6">
			<?php echo '<h3 class="margin-bottom-1">' . JText::_('COM_CONTACT_DETAILS') . '</h3>'; ?>
		<?php endif; ?>

		<div class="row">
			<?php if ($this->contact->image && $tparams->get('show_image')) : ?>
				<div class="columns large-6">
					<div class="thumbnail">
						<?php echo JHtml::_('image', $this->contact->image, htmlspecialchars($this->contact->name,  ENT_QUOTES, 'UTF-8'), array('itemprop' => 'image')); ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="columns large-6 margin-bottom-2">
				<?php if ($this->contact->name && $tparams->get('show_name')) : ?>
					<div class="page-header contact-name-heading">
						<h3>
							<?php if ($this->item->published == 0) : ?>
								<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
							<?php endif; ?>
							<span class="contact-name" itemprop="name"><?php echo $this->contact->name; ?></span>
						</h3>
					</div>
				<?php endif; ?>	
				<?php if ($this->contact->con_position && $tparams->get('show_position')) : ?>
					<div class="contact-position contact-infor-item">
						<div class="contact-infor marker-left"><b><?php echo JText::_('COM_CONTACT_POSITION'); ?>:</b></div>
						<div class="contact-infor" itemprop="jobTitle">
							<?php echo $this->contact->con_position; ?>
						</div>
					</div>
				<?php endif; ?>

				<?php echo $this->loadTemplate('address'); ?>
			</div>

			<?php if ($tparams->get('allow_vcard')) : ?>
				<div class="columns medium-6">
					<?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS'); ?>
					<a href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id=' . $this->contact->id . '&amp;format=vcf'); ?>">
					<?php echo JText::_('COM_CONTACT_VCARD'); ?></a>
				</div>
			<?php endif; ?>
		</div>	
		

		<?php if ($presentation_style === 'sliders') : ?>
				</div>
			</div>
		<?php elseif ($presentation_style === 'tabs') : ?>
			</div>
		<?php else: ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($tparams->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<?php if (!$accordionStarted)
			{
				?><div class="accordion-item" data-accordion-item><?php
				$accordionStarted = true;
			}
			?>
			<div class="accordion-item" data-accordion-item>
			<a href="#" class="accordion-title"><?php echo JText::_('COM_CONTACT_EMAIL_FORM'); ?></a>
				<div class="accordion-content" data-tab-content>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<?php if (!$tabSetStarted)
			{
				?><div class="tabs-panel" id="show_email_form"><?php
				$tabSetStarted = true;
			}
			?>
			<div class="tabs-panel" id="show_email_form">
		<?php elseif ($presentation_style === 'plain') : ?>
			<div class="column medium-6">
			<?php echo '<h3>' . JText::_('COM_CONTACT_EMAIL_FORM') . '</h3>'; ?>
		<?php endif; ?>

		<?php echo $this->loadTemplate('form'); ?>

		<?php if ($presentation_style === 'sliders') : ?>
				</div>
			</div>
		<?php elseif ($presentation_style === 'tabs') : ?>
			</div>
		<?php else: ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($tparams->get('show_links')) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<?php if (!$accordionStarted) : ?>
				<div class="accordion-item" data-accordion-item>
				<?php $accordionStarted = true; ?>
			<?php endif; ?>
			<div class="accordion-item" data-accordion-item>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<?php if (!$tabSetStarted) : ?>
				<?php $tabSetStarted = true; ?>
			<?php endif; ?>
		<?php endif; ?>
		<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>

	<?php if ($tparams->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<?php if (!$accordionStarted)
			{
				?><div class="accordion-item" data-accordion-item><?php
				$accordionStarted = true;
			}
			?>
			<div class="accordion-item" data-accordion-item>
			<a href="#" class="accordion-title"><?php echo JText::_('JGLOBAL_ARTICLES'); ?></a>
				<div class="accordion-content" data-tab-content>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<?php if (!$tabSetStarted)
			{
				?><div class="tabs-panel" id="show_articles"><?php
				$tabSetStarted = true;
			}
			?>
			<div class="tabs-panel" id="show_articles">
		<?php elseif ($presentation_style === 'plain') : ?>
			<div class="column medium-6">
			<?php echo '<h3>' . JText::_('JGLOBAL_ARTICLES') . '</h3>'; ?>
		<?php endif; ?>

		<?php echo $this->loadTemplate('articles'); ?>

		<?php if ($presentation_style === 'sliders') : ?>
				</div>
			</div>
		<?php elseif ($presentation_style === 'tabs') : ?>
			</div>
		<?php else : ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($tparams->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<?php if (!$accordionStarted)
			{
				?><div class="accordion-item" data-accordion-item><?php
				$accordionStarted = true;
			}
			?>
			<div class="accordion-item" data-accordion-item>
			<a href="#" class="accordion-title"><?php echo JText::_('COM_CONTACT_PROFILE'); ?></a>
				<div class="accordion-content" data-tab-content>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<?php if (!$tabSetStarted)
			{
				?><div class="tabs-panel" id="show_profile"><?php
				$tabSetStarted = true;
			}
			?>
			<div class="tabs-panel" id="show_profile">
		<?php elseif ($presentation_style === 'plain') : ?>
			<div class="column medium-6">
			<?php echo '<h3>' . JText::_('COM_CONTACT_PROFILE') . '</h3>'; ?>
		<?php endif; ?>

		<?php echo $this->loadTemplate('profile'); ?>

		<?php if ($presentation_style === 'sliders') : ?>
				</div>
			</div>
		<?php elseif ($presentation_style === 'tabs') : ?>
			</div>
		<?php else : ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($tparams->get('show_user_custom_fields') && $this->contactUser) : ?>
		<?php echo $this->loadTemplate('user_custom_fields'); ?>
	<?php endif; ?>

	<?php if ($this->contact->misc && $tparams->get('show_misc')) : ?>
		<?php if ($presentation_style === 'sliders') : ?>
			<?php if (!$accordionStarted)
			{
				?><div class="accordion-item" data-accordion-item><?php
				$accordionStarted = true;
			}
			?>
			<div class="accordion-item" data-accordion-item>
			<a href="#" class="accordion-title"><?php echo JText::_('COM_CONTACT_OTHER_INFORMATION'); ?></a>
				<div class="accordion-content" data-tab-content>
		<?php elseif ($presentation_style === 'tabs') : ?>
			<?php if (!$tabSetStarted)
			{
				?><div class="tabs-panel" id="show_misc"><?php
				$tabSetStarted = true;
			}
			?>
			<div class="tabs-panel" id="show_misc">
		<?php elseif ($presentation_style === 'plain') : ?>
			<div class="column medium-6">
			<?php echo '<h3>' . JText::_('COM_CONTACT_OTHER_INFORMATION') . '</h3>'; ?>
		<?php endif; ?>

		<div class="contact-miscinfo">
			<dl class="dl-horizontal">
				<dt>
					<span class="<?php echo $tparams->get('marker_class'); ?>">
					<?php echo $tparams->get('marker_misc'); ?>
					</span>
				</dt>
				<dd>
					<span class="contact-misc">
						<?php echo $this->contact->misc; ?>
					</span>
				</dd>
			</dl>
		</div>

		<?php if ($presentation_style === 'sliders') : ?>
				</div>
			</div>
		<?php elseif ($presentation_style === 'tabs') : ?>
			</div>
		<?php else : ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($accordionStarted) : ?>
		</div>
	<?php elseif ($tabSetStarted) : ?>
		</div>
	<?php endif; ?>

	<?php echo $this->item->event->afterDisplayContent; ?>
</div>
