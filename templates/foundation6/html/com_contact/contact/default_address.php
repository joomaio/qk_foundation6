<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Marker_class: Class based on the selection of text, none, or icons
 * jicon-text, jicon-none, jicon-icon
 */
?>
<div class="contact-address dl-horizontal" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
	<?php if (($this->params->get('address_check') > 0) &&
		($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)) : ?>
		<div class="contact-infor-item">
			<div class="contact-infor marker-left">
				<b><span class="<?php echo $this->params->get('marker_class'); ?>">
					<?php echo JText::_('TPL_FOUNDATION6_COM_CONTACT_ADDRESS_LABEL'); ?>
				</span></b>
			</div>

			<div class="contact-infor">
				<?php if ($this->contact->address && $this->params->get('show_street_address')) : ?>
					<div>
						<span class="contact-street" itemprop="streetAddress">
							<?php echo nl2br($this->contact->address); ?>
							<br />
						</span>
					</div>
				<?php endif; ?>

				<?php if ($this->contact->suburb && $this->params->get('show_suburb')) : ?>
					<div>
						<span class="contact-suburb" itemprop="addressLocality">
							<?php echo $this->contact->suburb; ?>
							<br />
						</span>
					</div>
				<?php endif; ?>
				<?php if ($this->contact->state && $this->params->get('show_state')) : ?>
					<div>
						<span class="contact-state" itemprop="addressRegion">
							<?php echo $this->contact->state; ?>
							<br />
						</span>
					</div>
				<?php endif; ?>
				<?php if ($this->contact->postcode && $this->params->get('show_postcode')) : ?>
					<div>
						<span class="contact-postcode" itemprop="postalCode">
							<?php echo $this->contact->postcode; ?>
							<br />
						</span>
					</div>
				<?php endif; ?>
				<?php if ($this->contact->country && $this->params->get('show_country')) : ?>
					<div>
						<span class="contact-country" itemprop="addressCountry">
							<?php echo $this->contact->country; ?>
							<br />
						</span>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

<?php if ($this->contact->email_to && $this->params->get('show_email')) : ?>
	<div class="contact-infor-item">
		<div class="contact-infor marker-left">
			<b><span class="<?php echo $this->params->get('marker_class'); ?>" itemprop="email">
				<?php echo JText::_('TPL_FOUNDATION6_COM_CONTACT_EMAIL_LABEL'); ?>
			</span></b>
		</div>
		<div class="contact-infor">
			<span class="contact-emailto">
				<?php echo $this->contact->email_to; ?>
			</span>
		</div>
	</div>
<?php endif; ?>

<?php if ($this->contact->telephone && $this->params->get('show_telephone')) : ?>
	<div class="contact-infor-item">
		<div class="contact-infor marker-left">
			<b><span class="<?php echo $this->params->get('marker_class'); ?>">
				<?php echo JText::_('TPL_FOUNDATION6_COM_CONTACT_TELEPHONE_LABEL'); ?>
			</span></b>
		</div>
		<div class="contact-infor">
			<span class="contact-telephone" itemprop="telephone">
				<?php echo $this->contact->telephone; ?>
			</span>
		</div>
	</div>
<?php endif; ?>
<?php if ($this->contact->fax && $this->params->get('show_fax')) : ?>
	<div class="contact-infor-item">
		<div class="contact-infor marker-left">
			<b><span class="<?php echo $this->params->get('marker_class'); ?>">
				<?php echo JText::_('TPL_FOUNDATION6_COM_CONTACT_FAX_LABEL'); ?>
			</span></b>
		</div>
		<div class="contact-infor">
			<span class="contact-fax" itemprop="faxNumber">
			<?php echo $this->contact->fax; ?>
			</span>
		</div>
	</div>
<?php endif; ?>

<?php if ($this->contact->mobile && $this->params->get('show_mobile')) : ?>
	<div class="contact-infor-item">
		<div class="contact-infor marker-left">
			<b><span class="<?php echo $this->params->get('marker_class'); ?>">
				<?php echo JText::_('TPL_FOUNDATION6_COM_CONTACT_MOBILE_LABEL'); ?>
			</span></b>
		</div>
		<div class="contact-infor">
			<span class="contact-mobile" itemprop="telephone">
				<?php echo $this->contact->mobile; ?>
			</span>
		</div>
	</div>
<?php endif; ?>

<?php if ($this->contact->webpage && $this->params->get('show_webpage')) : ?>
	<div class="contact-infor-item">
		<div class="contact-infor marker-left">
			<span class="<?php echo $this->params->get('marker_class'); ?>">
			</span>
		</div>
		<div class="contact-infor">
			<span class="contact-webpage">
				<a href="<?php echo $this->contact->webpage; ?>" target="_blank" rel="noopener noreferrer" itemprop="url">
				<?php echo JStringPunycode::urlToUTF8($this->contact->webpage); ?></a>
			</span>
		</div>
	</div>
<?php endif; ?>
</div>
