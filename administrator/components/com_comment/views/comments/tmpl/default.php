<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_comment
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user      = JFactory::getUser();
$userId    = $user->id;
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>
<form action="index.php?option=com_comment&view=comments" method="post" id="adminForm" name="adminForm">
	<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
	<div class="clearfix"></div>	
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th width="1%"><?php echo JText::_('COM_COMMENT_NUM'); ?></th>
			<th width="2%">
				<?php echo JHtml::_('grid.checkall'); ?>
			</th>
			<th width="10%">
				<?php echo JHTML::_( 'searchtools.sort', 'COM_COMMENT_PUBLISHED', 'a.published', $listDirn, $listOrder); ?>
			</th>
			<th width="15%">
				<?php echo JHTML::_( 'searchtools.sort', 'COM_COMMENT_CONTENT', 'a.comment', $listDirn, $listOrder); ?>
			</th>
			<th width="15%">
				<?php echo JHTML::_( 'searchtools.sort', 'COM_COMMENT_ARTICLE', 'content_title', $listDirn, $listOrder); ?>
			</th>
			<th width="10%">
				<?php echo JHTML::_( 'searchtools.sort', 'COM_COMMENT_CREATED_BY', 'a.created_by', $listDirn, $listOrder); ?>
			</th>
			<th width="6%">
				<?php echo JHTML::_( 'searchtools.sort', 'COM_COMMENT_GUEST_NAME', 'a.guest_name', $listDirn, $listOrder); ?>
			</th>
			<th width="6%">
				<?php echo JHTML::_( 'searchtools.sort', 'COM_COMMENT_GUEST_EMAIL', 'a.guest_email', $listDirn, $listOrder); ?>
			</th>
			<th width="10%">
				<?php echo JHTML::_( 'searchtools.sort', 'COM_COMMENT_CREATED_AT', 'a.created_at', $listDirn, $listOrder); ?>
			</th>
			<th width="10%">
				<?php echo JHTML::_( 'searchtools.sort', 'COM_COMMENT_MODIFIED_BY', 'a.modified_by', $listDirn, $listOrder); ?>
			</th>
			<th width="10%">
				<?php echo JHTML::_( 'searchtools.sort', 'COM_COMMENT_MODIFIED_AT', 'a.modified_by', $listDirn, $listOrder); ?>
			</th>
			<th width="5%">
				<?php echo JHTML::_( 'searchtools.sort', 'COM_COMMENT_ID', 'a.id', $listDirn, $listOrder); ?>
			</th>
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="12">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) : ?>
					<tr>
						<td>
							<?php echo $this->pagination->getRowOffset($i); ?>
						</td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $row->id); ?>
						</td>
						<td align="center">
							<?php echo JHtml::_('jgrid.published', $row->published, $i, 'comments.', true, 'cb'); ?>
						</td>
						<td>
							<a href="<?php echo JRoute::_('index.php?option=com_comment&task=comment.edit&id=' . (int) $row->id); ?>"><?php echo $row->comment; ?></a>
						</td>
						<td>
							<?php echo $row->content_title; ?>
						</td>
						<td>
							<?php echo $row->created_by_name; ?>
						</td>
						<td>
							<?php echo $row->guest_name; ?>
						</td>
						<td>
							<?php echo $row->guest_email; ?>
						</td>
						<td>
							<?php echo $row->created_at; ?>
						</td>
						<td>
							<?php echo $row->modified_by_name; ?>
						</td>
						<td>
							<?php echo $row->modified; ?>
						</td>
						<td align="center">
							<?php echo $row->id; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
		</tbody>
	</table>
</form>