<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_comment
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.viewlegacy');

class CommentViewComments extends JViewLegacy
{
	protected $comments;
	protected $return_page;
	
	public function display($tpl = null) 
	{
		$user = JFactory::getUser();
		
		// Assign data to the view
		$this->comments = $this->get('Comments');
		//$this->return_page = $this->get('ReturnPage');

		// Display the view
		parent::display($tpl);
	}
}