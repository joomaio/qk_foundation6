 
<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$list = $displayData['list'];
$start = ($list['previous']['active']) ? '':'disabled';
$end = ($list['next']['active']) ? '':'disabled';
?>
<div class="row column">
    <ul class="pagination" role="navigation" aria-label="Pagination">
        <li class="<?php echo $start; ?>"><?php echo $list['previous']['data']; ?></li>
        <?php foreach ($list['pages'] as $page) : ?>
            <?php if($page['active']==false): ?>
                <?php echo '<li class="current">' . $page['data'] . '</li>'; ?>
            <?php else:?>
                <?php echo '<li>' . $page['data'] . '</li>'; ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <li class="<?php echo $end; ?>"><?php echo $list['next']['data']; ?></li>
    </ul>
</div>