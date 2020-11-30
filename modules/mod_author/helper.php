<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_author
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Helper for mod_author
 *
 * @since  1.6
 */
class ModAuthorHelper
{
	/**
	 * Get users sorted by activation date
	 *
	 * @param   \Joomla\Registry\Registry  $params  module parameters
	 *
	 * @return  array  The array of users
	 *
	 * @since   1.6
	 */
	public static function getUsers($params)
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true)
			->select($db->quoteName(array('a.id', 'a.name', 'a.username', 'a.registerDate')))
			->order($db->quoteName('a.registerDate') . ' DESC')
			->from('#__users AS a');
		$user = JFactory::getUser();

		if (!$user->authorise('core.admin') && !empty($params->get('guest_usergroup')))
		{
			$usergroups = $params->get('guest_usergroup');


			// /var_dump($usergroups);die;
			if (empty($usergroups))
			{
				return array();
			}

			$query->join('LEFT', '#__user_usergroup_map AS m ON m.user_id = a.id')
				->join('LEFT', '#__usergroups AS ug ON ug.id = m.group_id')
				->where('ug.id in (' . implode(',', $usergroups) . ')')
				->where('ug.id <> 1');
		}

		$db->setQuery($query, 0, $params->get('shownumber', 5));

		try
		{
			if ($params->get('shownumber', 5)==0) return array();
			else return (array) $db->loadObjectList();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->enqueueMessage(JText::_('JERROR_AN_ERROR_HAS_OCCURRED'), 'error');

			return array();
		}
	}
}
