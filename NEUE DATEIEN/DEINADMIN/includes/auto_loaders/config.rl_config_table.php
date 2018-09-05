<?php
/**
* @package rl_config_table
* Author:  rainer@langheiter.com  https://langheiter.com
* @copyright Copyright 2003-2018 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
*/

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
} 


$autoLoadConfig[999][] = array(
    'autoType'=>'class',
    'loadFile'=>'class.rl_tools.php',
    'classPath'=>DIR_WS_CLASSES
);

$autoLoadConfig[999][] = array(
    'autoType' => 'init_script',
    'loadFile' => 'init_rl_config_table.php'
);
