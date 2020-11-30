<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_author
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

// Include the latest functions only once
JLoader::register('ModAuthorHelper', __DIR__ . '/helper.php');

$shownumber      = $params->get('shownumber', 5);
$names           = ModAuthorHelper::getUsers($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

require JModuleHelper::getLayoutPath('mod_author', $params->get('layout', 'default'));