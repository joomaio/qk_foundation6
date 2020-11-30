<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

//JHtmlF6::_('caption');
?>
<div class="category-list">

<?php
$this->subtemplatename = 'articles';
echo JLayoutHelper::render('joomla.content.category_default', $this);
?>

</div>
