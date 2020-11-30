<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_comment
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JFormHelper::loadFieldClass('list');

/**
 * Article Field class.
 *
 * @since  3.8.0
 */
class JFormFieldArticle extends JFormFieldList 
{

	//The field class must know its own type through the variable $type.
	protected $type = 'Article';

	public function getOptions()
	{
			$app = JFactory::getApplication();
			//$article_id = $app->input->get('id',0,'int'); //country is the dynamic value which is being used in the view
			//$article_id = 74;
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('c.title, c.id')->from('`#__content` AS c');//->where('c.id = "'.$article_id.'" ');
			$rows = $db->setQuery($query)->loadObjectList();
			$articles = [];
			foreach($rows as $row){
				$articles[] = (object)['value'=>$row->id, 'text'=>$row->title];
			}
			// Merge any additional options in the XML definition.
			// $options = array_merge(parent::getOptions(), $articles);
			$options = array_merge(parent::getOptions(), $articles);
			
			return $options;
	}
}