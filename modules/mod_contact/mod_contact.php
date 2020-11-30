<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_contact
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the latest functions only once
JLoader::register('ModContactHelper', __DIR__ . '/helper.php');

$contactform = ModContactHelper::getContact($params);

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

require JModuleHelper::getLayoutPath('mod_contact', $params->get('layout', 'default'));
