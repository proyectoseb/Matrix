<?php
/**
 * @package SJ Categories for VirtueMart
 * @version 2.2.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2014 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */

defined('_JEXEC') or die;

if (!class_exists('VmConfig')) {
    require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'config.php');
}
VmConfig::loadConfig();
if (!class_exists('VmModel')) require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'vmmodel.php');
// Load the language file of com_virtuemart.
JFactory::getLanguage()->load('com_virtuemart');
if (!class_exists('calculationHelper')) {
    require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'calculationh.php');
}
if (!class_exists('CurrencyDisplay')) {
    require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'currencydisplay.php');
}
if (!class_exists('VirtueMartModelVendor')) {
    require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'models' . DS . 'vendor.php');
}
if (!class_exists('VmImage')) {
    require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'image.php');
}
if (!class_exists('shopFunctionsF')) {
    require(JPATH_SITE . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'shopfunctionsf.php');
}
if (!class_exists('calculationHelper')) {
    require(JPATH_COMPONENT_SITE . DS . 'helpers' . DS . 'cart.php');
}
if (!class_exists('VirtueMartModelProduct')) {
    JLoader::import('product', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'models');
}

if (!class_exists('VirtueMartModelCategory')) {
    JLoader::import('category', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'models');
}

if (!class_exists('VmMediaHandler')) {
    require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'mediahandler.php');
}

if (!class_exists('VmTable')) require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'vmtable.php');
if (!class_exists('TableCategories'))
    require(JPATH_VM_ADMINISTRATOR . DS . 'tables' . DS . 'categories.php');

if (!class_exists('VirtueMartModelCategory')) require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'category.php');