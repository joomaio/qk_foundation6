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
class CommentModelComment extends JModelLegacy
{	
	/**
	 * Function count comments
	 *
	 * @param   int     $contentId   - the id of the object that we comment on
	 *
	 * @return object
	 */
	public function countComment($contentId)
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		$query->select('COUNT(c.id)')
		->from('#__comments AS c')
		->leftJoin('#__content as con ON c.article_id = con.id')->where('c.published=1')
		->where('c.article_id = '.$contentId);

		$db->setQuery($query);
		return $db->loadResult();
	}

	/**
	 * Method to post a comment
	 * @param   array  $data  The form data.
	 *
	 * @since   1.6
	 */
	public function postComment( $data )
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		
		$data['created_at'] = date("Y-m-d H:i:s");
	
		$query->insert($db->quoteName('#__comments'))
        ->columns($db->quoteName( array_keys($data) ))
        ->values(implode(',', $db->quote( array_values($data) )));
        
		$db->setQuery($query);
		return $db->execute(); 

	}
}