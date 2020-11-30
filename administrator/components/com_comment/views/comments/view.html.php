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

/**
 * Comments View
 *
 * @since  0.0.1
 */
class CommentViewComments extends JViewLegacy
{
	protected $item;
	protected $pagination;
	protected $state;
	public $filterForm;
	public $activeFilters;
	//public $sortDirection;
	//public $sortColumn;

	/**
	 * Display the Comment view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		// Get application
		$app = JFactory::getApplication();


		// Get data from the model
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state         = $this->get('State');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');

		//
		//$this->sortDirection = $this->state->get('list.direction');
		//$this->sortColumn = $this->state->get('list.ordering');
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set the toolbar and number of found items
		$this->addToolBar();

		// Display the template
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolBar()
	{
		$user = JFactory::getUser();

		if ($user->authorise('core.admin', 'com_comment') || $user->authorise('core.options', 'com_comment'))
		{
			JToolbarHelper::preferences('com_comment');JToolbarHelper::title(JText::_('COM_COMMENT_MANAGER_COMMENTS'));
			JToolbarHelper::editList('comment.edit');
			JToolbarHelper::publish('comments.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('comments.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			if ($this->state->get('filter.published') == -2)
			{
				JToolbarHelper::deleteList('JGLOBAL_CONFIRM_DELETE', 'comments.delete', 'JTOOLBAR_EMPTY_TRASH');
			}
			else
			{
				JToolbarHelper::trash('comments.trash');
			}
			JToolbarHelper::help('COM_COMMENT_COMMENT_HELP_VIEW',true);
		}
		
	}

	/**
	 * Returns an array of fields the table can be sorted by
	 *
	 * @return  array  Array containing the field name to sort by as the key and display text as value
	 *
	 * @since   3.0
	 */
	protected function getSortFields()
	{
		// return array(
		// 	'a.published'     	=> JText::_('COM_COMMENT_PUBLISHED'),
		// 	'a.comment'    		=> JText::_('COM_COMMENT_CONTENT'),
		// 	'content_title'     => JText::_('COM_COMMENT_ARTICLE'),
		// 	'a.created_by' 		=> JText::_('COM_COMMENT_CREATED_BY'),
		// 	'a.created_at'      => JText::_('COM_COMMENT_CREATED_AT'),
		// 	'a.modified_by'     => JText::_('COM_COMMENT_MODIFIED_BY'),
		// 	'a.modified_at'     => JText::_('COM_COMMENT_MODIFIED_AT'),
		// 	'a.id'           	=> JText::_('COM_COMMENT_ID'),
		// );
	}
}