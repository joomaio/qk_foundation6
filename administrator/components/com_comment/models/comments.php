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

use Joomla\Utilities\ArrayHelper;
/**
 * CommentList Model
 *
 * @since  0.0.1
 */
class CommentModelComments extends JModelList
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see     JControllerLegacy
	 * @since   1.6
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'published','a.published',
				'comment','a.comment',
				'content_title','con.title',
				'created_by','a.created_by',
				'guest_name','a.guest_name',
				'guest_email','a.guest_email',
				'created_at','a.created_at',
				'modified_by','a.modified_by',
				'modified','a.modified',
				'id','a.id',
			);
		}
		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');
	
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $this->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);
		
		$formSubmited = $app->input->post->get('form_submited');
		$articleId   = $this->getUserStateFromRequest($this->context . '.filter.article_id', 'filter_article_id');
		//$this->setState('filter.article_id', $articleId);
		if($formSubmited)
		{
			$articleId = $app->input->post->get('article_id');
			$this->setState('filter.article_id', $articleId);
		}

		//Takes care of states: list. limit / start / ordering / direction
		parent::populateState('a.created_at', 'DESC');
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return  string  A store id.
	 *
	 * @since   1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.published');
		$id .= ':' . serialize($this->getState('filter.article_id'));

		return parent::getStoreId($id);
	}

	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return      string  An SQL query
	 */
	protected function getListQuery()
	{
		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Create the base select statement.
		$query->select('a.*, u1.name AS created_by_name, u2.name AS modified_by_name, u1.username AS created_by_username, u2.username AS modified_by_username, con.title AS content_title')
		->from('#__comments AS a')
		->leftJoin('#__users as u1 ON a.created_by = u1.id')
		->leftJoin('#__users as u2 ON a.modified_by = u2.id')
		->leftJoin('#__content as con ON a.article_id = con.id');
		
		// Join over the users for the article.
		$query->select('c.title AS article_title')
		->join('LEFT', '#__content AS c ON c.id = a.article_id');


		// Filter by article
		$articleId = $this->getState('filter.article_id');

		if (is_numeric($articleId))
		{
			$type = $this->getState('filter.article_id.include', true) ? '= ' : '<>';
			$query->where('a.article_id ' . $type . (int) $articleId);
		}
		elseif ($articleId === '')
		{
			$query->where('1=1');
		}

		// Filter by search in name.
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = ' . (int) substr($search, 3));
			}
			else
			{
				$search = $db->quote('%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%'));
				$query->where(
					'(' . $db->quoteName('con.title') . ' LIKE ' . $search . ' OR ' . $db->quoteName('a.comment') . ' LIKE ' . $search .  ' OR ' . $db->quoteName('u1.username') . ' LIKE ' . $search .  ' OR ' . $db->quoteName('u2.username') . ' LIKE ' . $search .  ' OR ' . $db->quoteName('a.guest_name') . ' LIKE ' . $search .  ' OR ' . $db->quoteName('a.guest_email') . ' LIKE ' . $search . ')'
				);
			}
		}

		// Filter by state (published, trashed, etc.)
		$state = $db->escape($this->getState('filter.published'));
		if (is_numeric($state)) {
			$query->where('a.published = ' . (int) $state);
		}
		elseif ($state === '') {
			$query->where('(a.published = 0 OR a.published = 1)');
		}

		// Add the list ordering clause.
		$orderCol = $this->state->get('list.ordering', 'a.created_at');
		$orderDirn = $this->state->get('list.direction', 'desc');

		$query->order($db->escape($orderCol . ' ' . $orderDirn));
		
		return $query;
	}

}