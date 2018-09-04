<?php
/**
 * @package IT Recht Kanzlei
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: config.config_table.php 1 2016-05-22 18:13:51Z webchills $
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
