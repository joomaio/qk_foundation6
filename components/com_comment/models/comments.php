<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_comment
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modellegacy');
/**
 * Comment Model
 *
 * @since  0.0.1
 */
class CommentModelComments extends JModelLegacy
{
	/**
	 * Function get comments
	 *
	 *
	 * @return array
	 */
	public function getComments()
	{
		$contentId = JFactory::getApplication()->input->get('id', 0, 'int');	
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$guestcomment = JFactory::getApplication()->getParams('com_comment')->get('autopublish', 0);

		$query->select('a.*, u.name AS created_by_name, u.username AS created_by_username, con.title AS content_title')
		->from('#__comments AS a')
		->leftJoin('#__users as u ON a.created_by = u.id')
		->leftJoin('#__content as con ON a.article_id = con.id')->where('a.published=1')
		->where('a.article_id ='.$contentId)->order('created_at ASC');

		$db->setQuery($query);
		$result = $db->loadObjectList();
		
		return empty($result) ? [] : $result;
	}
}