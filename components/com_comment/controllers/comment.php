<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_comment
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('CommentController', JPATH_COMPONENT . '/controller.php');

/**
 * Registration controller class for Users.
 *
 * @since  1.6
 */
class CommentControllerComment extends CommentController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);
	}

	/**
	 * Method to post a comment
	 * @param   array  $temp  The form data.
	 *
	 *
	 */
	public function post()
	{
		$user = JFactory::getUser();
		$autopublish = JFactory::getApplication()->getParams('com_comment')->get('autopublish', 0);
		$guestcomment = JFactory::getApplication()->getParams('com_comment')->get('guestcomment', 0);
		$input = JFactory::getApplication()->input;
		// if( $user->guest ){
		// 	$this->setRedirect('index.php', JText::_('you must login'));
		// 	return;
		// }

		$model  = $this->getModel('comment');
		
		if($guestcomment=='1'){
			$res = $model->postComment([
				'created_by' => $user->id,
				'guest_name' => $input->get('guestname', '', 'string'),
				'guest_email' => $input->get('guestemail', '', 'string'),
				'article_id' => $input->get('article_id', 0, 'int'),
				'comment' => $input->get('comment', '', 'string'),
				'published' => (int)$autopublish
			]);
		}else{
			$res = $model->postComment([
				'created_by' => $user->id,
				'article_id' => $input->get('article_id', 0, 'int'),
				'comment' => $input->get('comment', '', 'string'),
				'published' => (int)$autopublish
			]);
		}
		if($autopublish=='0'){			
			JFactory::getApplication()->enqueueMessage(JText::_( 'COM_COMMENT_WAIT_TO_ACCEPT' ), 'warning');
		}else{
			JFactory::getApplication()->enqueueMessage(JText::_( 'COM_COMMENT_POST_COMMENT_SUCCESS' ), 'message');
		}

		$url = JRoute::_('index.php?option=com_content&view=article&id='.$input->get('article_id', 0, 'int').'&catid='.$this->input->get('catid', 0, 'int').'&Itemid='.$this->input->get('Itemid', 0, 'int'),false);
		
		$this->setRedirect($url);
	}
}
