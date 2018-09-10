<?php
/**
* @package rl_config_table
* Author:  rainer@langheiter.com  https://langheiter.com
* @copyright Copyright 2003-2018 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
* @version $Id: init_rl_config_table.php 2018-09-10 12:13:51Z hugo13 $
*/

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}


$zc150 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5));

$module_constant = 'RL_CONFIG_TABLE_VERSION';
$module_installer_directory = DIR_FS_ADMIN . 'includes/installers/rl_config_table';
$module_name = "rlConfigTable";

$multiLingual = rl_tools::isMultiLingual();
$sql = "SELECT configuration_group_id FROM " . TABLE_CONFIGURATION_GROUP . 
" WHERE configuration_group_title = 'Config Table' OR configuration_group_title = 'Konfigurationstabelle'" ;
$res = $db->Execute($sql);     
if($res->RecordCount()==0){
    $group = getNextConfigGroupID();
    $sql = "INSERT INTO " . TABLE_CONFIGURATION_GROUP . " (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) 
    VALUES ($group, 'Config Table', 'configuration table', 726, 1)";
    $db->Execute($sql);

    if ($multiLingual) {
        $sql = "INSERT INTO " . TABLE_CONFIGURATION_GROUP . " (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible) 
        VALUES ($group, 43, 'Konfigurationstabelle', 'Konfigurationstabelle', 726, 1)";
        $db->Execute($sql);
    }
} else {
    $group = $res->fields['configuration_group_id'];
}     




$configuration_group_id = $group;


if (defined($module_constant)) {
    $current_version = constant($module_constant);
} else {
    $current_version = "0.0.0";
    $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
                    ('Version', '" . $module_constant . "', '0.0.0', 'Installierte Version:', " . $configuration_group_id . ", 0, NOW(), NOW(), NULL, 'zen_cfg_read_only(');");
                    
}

$installers = scandir($module_installer_directory, 1);

$newest_version = $installers[0];
$newest_version = substr($newest_version, 0, -4);

sort($installers);


if (version_compare($newest_version, $current_version) > 0) {
    foreach ($installers as $installer) {
        if (version_compare($newest_version, substr($installer, 0, -4)) >= 0 && version_compare($current_version, substr($installer, 0, -4)) < 0) {
            include($module_installer_directory . '/' . $installer);
            $current_version = str_replace("_", ".", substr($installer, 0, -4));
            $db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '" . $current_version . "' WHERE configuration_key = '" . $module_constant . "' LIMIT 1;");
            $messageStack->add("Erfolgreich installiert: " . $module_name . " v" . $current_version, 'success');
        }
    }
}