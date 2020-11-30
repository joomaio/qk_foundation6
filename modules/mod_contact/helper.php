<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_contact
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::discover('ContactModel', JPATH_SITE . '/components/com_contact/models');
use Joomla\Registry\Registry;

/**
 * Helper for mod_users_latest
 *
 * @since  1.6
 */
class ModContactHelper
{
	/**
	 * Get users sorted by activation date
	 *
	 * @param   \Joomla\Registry\Registry  $params  module parameters
	 *
	 * @return  array  The array of contact data
	 *
	 * @since   1.6
	 */
	public static function getContact($params)
	{
		JForm::addFormPath(JPATH_SITE . '/components/com_contact/models/forms');
		//JForm::addFieldPath(JPATH_SITE . '/components/com_contact/models/fields');
		$lang = JFactory::getLanguage();
		$lang->load('com_contact', JPATH_SITE, '', true);
		$model = JModelLegacy::getInstance('Contact', 'ContactModel');
		$contact=[];

		//item
		$item = $model->getItem($params->get('id'));
		$contact['item'] = $item;
		
		//captcha
		$contact['captchaEnabled'] = false;
		$captchaSet = $item->params->get('captcha', JFactory::getApplication()->get('captcha', '0'));
		foreach (JPluginHelper::getPlugin('captcha') as $plugin)
		{
			if ($captchaSet === $plugin->name)
			{
				$contact['captchaEnabled'] = true;
				break;
			}
		}

		//form
		$form = new JForm('com_contact.contact',array('control' => 'jform', 'load_data' => true));
		$form->loadFile(JPATH_SITE . '/components/com_contact/models/forms/contact.xml');
		$contact['form'] = $form;
		
		return $contact;
	}
}
