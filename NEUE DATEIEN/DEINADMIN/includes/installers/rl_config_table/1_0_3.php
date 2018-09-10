<?php
/**
* @package rl_config_table
* Author:  rainer@langheiter.com  https://langheiter.com
* @copyright Copyright 2003-2018 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
* @version $Id: 1_0_3.php 2018-09-10 16:13:51Z hugo13 $
*/

$ins = "INSERT INTO  " . TABLE_CONFIGURATION . "  (configuration_title, configuration_key, 
configuration_value, configuration_description, configuration_group_id, sort_order, 
set_function) VALUES ";
$confArrAdd = array(
    'RL_CONFIG_TABLE_MARGIN' => "('margin', 'RL_CONFIG_TABLE_MARGIN', '30', 'css width in px<br />Default: 30px', $group, 10, NULL)", 
    'RL_CONFIG_TABLE_BORDER' => "('border', 'RL_CONFIG_TABLE_BORDER', '2px solid green', 'border border_style color<br />Default: 2px solid green', $group, 10, NULL)", 
    'RL_CONFIG_TABLE_PADDING' => "('padding', 'RL_CONFIG_TABLE_PADDING', '8px', 'border border_style color<br />Default: 8px', $group, 10, NULL)", 
);
foreach ($confArrAdd as $value) {
    $sql = $ins . $value;
    $db->Execute($sql);
}

if ($multiLingual) {
    $ins = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_key, configuration_language_id, 
    configuration_title, configuration_description) VALUES ";
    $confArrMultiAdd = array(
        'RL_CONFIG_TABLE_MARGIN'    => "('RL_CONFIG_TABLE_MARGIN', 43, 'Abstand', 'Abstand <br />Standard: 30')", 
        'RL_CONFIG_TABLE_BORDER'    => "('RL_CONFIG_TABLE_BORDER', 43, 'Rahmen', 'Rahmenbreite Rahmenstil Rahmenfarbe<br />Standard: 2px solid green')", 
        'RL_CONFIG_TABLE_PADDING'   => "('RL_CONFIG_TABLE_PADDING', 43, 'Polsterung', 'Abstand zum Rahmen %<br />Standard: 8')", 

    );
    foreach ($confArrMultiAdd as $value) {
        $sql = $ins . $value;
        $db->Execute($sql);
    }
}

if (!zen_page_key_exists('config_table_menu')) {
    
    zen_register_admin_page('config_table_menu', 'BOX_TOOLS_CONFIG_TABLE',
        'RL_CONFIG_TABLE_ADMIN_FILENAME', '', 'tools', 'Y', 40);
}

if (!zen_page_key_exists('config_table_config')) {
    zen_register_admin_page('config_table_config', 'BOX_CONFIGURATION_TABLE',
        'FILENAME_CONFIGURATION', 'gID=' . $group, 'configuration', 'Y', $group);
}

$messageStack->add('Konfigurationstabelle Konfiguration und Tools erfolgreich hinzugefügt.', 'success');  