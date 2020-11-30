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
class CommentModelPost extends JModelLegacy
{
	/**
	 * Function post Comment
	 * @param   array  $temp  The form data.
	 *
     * 
	 */
	public function postComment($temp)
	{
		$contentId = JFactory::getApplication()->input->get('id', 0, 'int');	
		$db = JFactory::getDBO();
        $query = $db->getQuery(true);
        
        $column =  array('create_by', 'create_at', 'article', 'content');

        $value = "";

		$query
        ->insert($db->quoteName('#__comments'))
        ->columns($db->quoteName($columns))
        ->values(implode(',', $values));
        
		$db->setQuery($query);
	}
}