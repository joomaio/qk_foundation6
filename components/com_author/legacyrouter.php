<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_author
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Legacy routing rules class from com_author
 *
 * @since       3.6
 * @deprecated  4.0
 */
class AuthorRouterRulesLegacy implements JComponentRouterRulesInterface
{
	/**
	 * Constructor for this legacy router
	 *
	 * @param   JComponentRouterAdvanced  $router  The router this rule belongs to
	 *
	 * @since       3.6
	 * @deprecated  4.0
	 */
	public function __construct($router)
	{
		$this->router = $router;
	}

	/**
	 * Preprocess the route for the com_author component
	 *
	 * @param   array  &$query  An array of URL arguments
	 *
	 * @return  void
	 *
	 * @since       3.6
	 * @deprecated  4.0
	 */
	public function preprocess(&$query)
	{
	}
	
	static $items;
	static $found;
	
	/**
	 * Build the route for the com_author component
	 *
	 * @param   array  &$query     An array of URL arguments
	 * @param   array  &$segments  The URL arguments to use to assemble the subsequent URL.
	 *
	 * @return  void
	 *
	 * @since       3.6
	 * @deprecated  4.0
	 */
	public function build(&$query, &$segments)
	{
		// No author ID then stop
		if( !isset( $query['author_id'] ) ) return ;
		
		$author = (int)$query['author_id'] ;
		//$category = isset( $query['cat_id'] ) ? (int)$query['cat_id'] : false ;
		// Get the relevant menu items if not loaded.
		if (empty(self::$items))
		{
			// Get all relevant menu items.
			
			self::$items = $this->router->menu->getItems('component', 'com_author');
			
			// Build an array of serialized query strings to menu item id mappings.
			foreach (self::$items as $item)
			{
				// sth wrong, then skip
				if (     empty($item->query['author_id'])) continue; 
				$aid = $item->query['author_id'] ;
				self::$found[$aid]= $item->id;
			}
		}
		
		if( isset( self::$found[$author] ) ){
			unset( $query['view'] ) ;
			unset( $query['layout'] ) ;
			unset( $query['author_id'] ) ;
			$query['Itemid'] = self::$found[$author];		
		}else{
			if( isset( $query['Itemid'] ) ) $query['Itemid'] = self::$items[0]->id ; // get first menu item
		}
		
		$total = count($segments);

		for ($i = 0; $i < $total; $i++)
		{
			$segments[$i] = str_replace(':', '-', $segments[$i]);
		}
	}

	/**
	 * Parse the segments of a URL.
	 *
	 * @param   array  &$segments  The segments of the URL to parse.
	 * @param   array  &$vars      The URL attributes to be used by the application.
	 *
	 * @return  void
	 *
	 * @since       3.6
	 * @deprecated  4.0
	 */
	public function parse(&$segments, &$vars)
	{
		$total = count($segments);

		for ($i = 0; $i < $total; $i++)
		{
			$segments[$i] = preg_replace('/-/', ':', $segments[$i], 1);
		}

		// Only run routine if there are segments to parse.
		if (count($segments) < 1)
		{
			return;
		}

		// Get the package from the route segments.
		$author_id = array_shift($segments);

		if (is_numeric($author_id))
		{
			$vars['author_id'] = (int) $author_id ;
			$vars['view'] = 'articles' ;
			$vars['layout'] = 'blog' ;
			
			if( count( $segments )  ){
				$category = array_shift($segments);
				$category = (int) $category ;
				if( $category ){
					$vars['cat_id'] = (int) $category ;
					$vars['view'] = 'category' ;
				}				
			}
		}
		else
		{
			JError::raiseError(404, JText::_('JGLOBAL_RESOURCE_NOT_FOUND'));
		}
	}
}
