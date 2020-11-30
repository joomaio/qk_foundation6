<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<div class="search-results">
<?php foreach ($this->results as $result) : ?>
	<div class="result-item">
		<div class="result-title">
			<h4>
				<?php echo $this->pagination->limitstart + $result->count . '. '; ?>
				<?php if ($result->href) : ?>
					<a href="<?php echo JRoute::_($result->href); ?>"<?php if ($result->browsernav == 1) : ?> target="_blank"<?php endif; ?>>
						
							<?php // $result->title should not be escaped in this case, as it may ?>
							<?php // contain span HTML tags wrapping the searched terms, if present ?>
							<?php // in the title. ?>
							<?php echo $result->title; ?>
						
					</a>
				<?php else : ?>
					<?php // see above comment: do not escape $result->title ?>
					<?php echo $result->title; ?>
				<?php endif; ?>
			</h4>
		</div>
		<?php if ($result->section) : ?>
			<span class="result-category small">
				<i class="fi-folder"></i> <?php echo $result->section; ?>
			</span>
		<?php endif; ?>
		<?php if ($this->params->get('show_date')) : ?>
			<span class="result-created">					
				<i class="fi-calendar"></i> <?php echo $result->created; ?>
			</span>
		<?php endif; ?>
		<div class="result-text">
			<?php echo $result->text; ?>
		</div>
	</div>
<?php endforeach; ?>
</div>
<div class="pagination">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
