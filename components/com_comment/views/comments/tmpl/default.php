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
$user = JFactory::getUser();

$contentId = JFactory::getApplication()->input->get('id', 0, 'int');
$catId = JFactory::getApplication()->input->get('catid', 0, 'int');
$Itemid = JFactory::getApplication()->input->get('Itemid', 0, 'int');

//$redirectUrl=JRoute::_(ContentHelperRoute::getArticleRoute($contentId, $catId));
$redirectUrl="index.php?option=com_content&view=article&id=".$contentId."&catid=".$catId."&Itemid=".$Itemid;
$redirectUrl = base64_encode($redirectUrl);  

$redirectUrl = '&return='.$redirectUrl;
$joomlaLoginUrl = 'index.php?option=com_users&view=login';
$finalUrl = $joomlaLoginUrl.$redirectUrl;

$guestcomment = JComponentHelper::getParams('com_comment')->get('guestcomment', 0);
?>
<hr>
<div class="row">
    <div class="column large-8 float-left">
    <?php if(!empty($this->comments)): ?>
        <h3 id="article-comment"><?php echo JText::_( 'COM_COMMENT_COMMENT_SECTION' ); ?> (<?php echo count($this->comments); ?>)</h3>
    <div class="comment-section-container">
        <?php 
            foreach($this->comments as $comment)
            {
                ?><div class="comment-section-item">
                    <div class="comment-section-author">
                        <div class="comment-section-name">
                            <h5 class="margin-bottom-0"><?php 
                            if(!isset($comment->created_by_name)) echo $comment->guest_name;
                            else echo $comment->created_by_name; 
                            ?> <small><?php echo $comment->created_at; ?></small></h5>
                        </div>
                    </div>
                    <div class="comment-section-text">
                        <p><?php echo $comment->comment; ?></p>
                    </div>    
                </div><?php
            }
        ?>
    </div>
    <?php endif; ?>
    <h3><?php echo JText::_( 'COM_COMMENT_LEAVE_A_COMMENT' ); ?></h3>
    <?php
        if($user->guest) 
        {
            ?>
                <form id="comment-form" action="<?php echo JRoute::_('index.php?option=com_comment&task=comment.post'); ?>" method="post" class="form-validate form-horizontal well" enctype="multipart/form-data">
                <?php if($guestcomment=='1'): ?>
                <label>
                    <?php echo JText::_( 'COM_COMMENT_GUEST_NAME' ); ?>
                    <input name="guestname" type="text" placeholder="<?php echo JText::_( 'COM_COMMENT_GUEST_NAME_PLACEHOLDER' ); ?>" required>
                </label>
                <label>
                    <?php echo JText::_( 'COM_COMMENT_GUEST_EMAIL' ); ?>
                    <input name="guestemail" type="email" placeholder="<?php echo JText::_( 'COM_COMMENT_GUEST_EMAIL_PLACEHOLDER' ); ?>" required>
                </label>
                <label>
                    <?php echo JText::_( 'COM_COMMENT_CONTENT_COMMENT' ); ?>
                    <textarea name="comment" rows="3" placeholder="<?php echo JText::_( 'COM_COMMENT_CONTENT_COMMENT_PLACEHOLDER' ); ?>" required></textarea>
                </label>
                <input type="hidden" name="article_id" value="<?php echo $contentId; ?>">
                <input type="hidden" name="catid" value="<?php echo $catId; ?>" />
                <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
                <button type="submit" class="button"><?php echo JText::_( 'COM_COMMENT_SUBMIT_BUTTON' ); ?></button>
                <span class="cmt-seperation"><?php echo JText::_( 'COM_COMMENT_AND_CHARACTER' ); ?></span>
                <?php endif; ?>
                <a href="<?php echo JRoute::_($finalUrl); ?>" class="button"><?php echo JText::_( 'COM_COMMENT_LOGIN_TO_POST_COMMENT' ); ?></a>
                <?php echo JHtml::_('form.token'); ?>
            </form>
            <?php
        }
        else 
        {
            ?>
            <form id="member-registration" action="<?php echo JRoute::_('index.php?option=com_comment&task=comment.post'); ?>" method="post" class="form-validate form-horizontal well" enctype="multipart/form-data">
                <label>
                    <?php echo JText::_( 'COM_COMMENT_CONTENT_COMMENT' ); ?>
                    <textarea name="comment" placeholder="<?php echo JText::_( 'COM_COMMENT_CONTENT_COMMENT_PLACEHOLDER' ); ?>" required></textarea>
                </label>
                <input type="hidden" name="article_id" value="<?php echo $contentId; ?>">
                <input type="hidden" name="catid" value="<?php echo $catId; ?>" />
                <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
                <button type="submit" class="button"><?php echo JText::_( 'COM_COMMENT_SUBMIT_BUTTON' ); ?></button>
                <?php echo JHtml::_('form.token'); ?>
            </form>
            <?php
        }
    ?>
    </div>
</div>