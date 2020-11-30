<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.Comment
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::discover('CommentModel', JPATH_SITE . '/components/com_comment/models');

use Joomla\Registry\Registry;

/**
 * Contact Plugin
 *
 * @since  3.2
 */
class PlgContentComment extends JPlugin
{
    /**
    * Load the language file on instantiation.
    *
    * @var    boolean
    * @since  3.1
    */
	protected $autoloadLanguage = true;
	
	/**
	 * Display the comment form after the article
	 *
	 * @param   string  $context  - the context
	 * @param   object  &$row     - the component row
	 * @param   object  &$params  - any params
	 * @param   int     $page     - the page
	 *
	 * @return type
	 */
	public function onContentAfterDisplay($context, &$row, &$params, $page = 0)
	{
		$component = $this->findOutComponent($context);

		$lang = JFactory::getLanguage();
		$lang->load('com_comment', JPATH_SITE, '', true);
		$showinfeatured = JComponentHelper::getParams('com_comment')->get('showinfeatured', 0);
		$showincategory = JComponentHelper::getParams('com_comment')->get('showincategory', 0);
		
		if($component == 'featured' || $component == 'article' || $component == 'category')
		{
			$enablecomment = json_decode($row->attribs)->enablecomment;
		}

		if(($component == 'featured' && $showinfeatured == '1') || ($component == 'category' && $showincategory=='1') && $enablecomment=='1')
		{

			$model = JModelLegacy::getInstance('Comment', 'CommentModel');
			$countComment = $model->countComment($row->id);

			// get url of article
			$url = JRoute::_(ContentHelperRoute::getArticleRoute($row->id, $row->catid, $row->language));

			return '<span>'.JText::_('COM_COMMENT_COMMENT_COUNT').': <a href="'.$url.'/#article-comment">'.$countComment.'</a></span>';
		}
		elseif($component == 'article' && $enablecomment=='1') // if( setting allow comment = ON )
		{
			JLoader::register('CommentViewComments', JPATH_SITE . '/components/com_comment/views/comments/view.html.php');
			$view = new CommentViewComments(
				array('base_path' => JPATH_SITE . '/components/com_comment')
			);

			//die($view->getLayout());

			$model = JModelLegacy::getInstance('Comments', 'CommentModel');

			$view->setModel( $model, true);
			
			ob_start();
			$view->display();
			$content = ob_get_clean();
			
			return  $content;
		}
		else
		{
			return '';
		}
	}

	/**
	 * Prepare form and add my field.
	 *
	 * @param   JForm  $form  The form to be altered.
	 * @param   mixed  $data  The associated data for the form.
	 *
	 * @return  boolean
	 *
	 * @since   <your version>
	 */
	function onContentPrepareForm($form, $data)
	{
		$app = JFactory::getApplication();
        $option = $app->input->get('option');
        switch($option) {
            case 'com_content':
                if ($app->isAdmin()) {
                    JForm::addFormPath(__DIR__ . '/forms');
                    $form->loadFile('content', false);
                }
                return true;
        }
        return true;
	}

	/**
	 * Find out the component that we are integrating with
	 *
	 * @param   string  $context  - the context
	 *
	 * @return null|string
	 */
	private function findOutComponent($context)
	{
		$component = null;

		switch ($context)
		{
			case 'com_content.article':
				$component = 'article';
				break;
			case 'com_content.featured':
				$component = 'featured';
				break;
			case 'com_content.category':
				$component = 'category';
				break;
		}

		return $component;
	}
}
