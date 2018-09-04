<?php
/**
* @package pdf Rechnung
* @copyright Copyright 2005-2018 langheiter.com 
* @copyright Copyright 2003-2016 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
* @version $Id: rl_config_table_a11.php 2016-06-19 07:19:17Z webchills $
*/

$show_all_errors = false;

require('includes/application_top.php');

$multiLingual = rl_tools::isMultiLingual();   
$languageID = (int)$_SESSION['languages_id'];

if($languageID==1){
    $sql = 'SELECT configuration_group.configuration_group_title, configuration.configuration_title, configuration.configuration_key, configuration.configuration_value, configuration.configuration_description, configuration.configuration_description, configuration_group.configuration_group_id, configuration.configuration_id
    FROM configuration_group INNER JOIN configuration ON configuration_group.configuration_group_id = configuration.configuration_group_id;';

}else{
    $sql = 'SELECT configuration.configuration_id, configuration_group.language_id, configuration_group.configuration_group_title, configuration.configuration_title, configuration.configuration_key, configuration.configuration_value, configuration.configuration_description, configuration_language.configuration_description, configuration_group.configuration_group_id, configuration.configuration_id
    FROM (configuration_group INNER JOIN configuration ON configuration_group.configuration_group_id = configuration.configuration_group_id) INNER JOIN configuration_language ON configuration.configuration_key = configuration_language.configuration_key 
    WHERE (((configuration_group.language_id)=' . (int)$_SESSION['languages_id'] . '));';
}
//rldp($sql, 'SQL');
$result = $db->Execute($sql);     

if($result == false) {
    die("Query Error");
}

if(!$result->EOF) {
    $output = [];

    while (! $result->EOF) {
        $output[] = $result->fields;
        $result->MoveNext();
    }
    echo json_encode($output, JSON_PRETTY_PRINT);
} else {
    echo "No results";
}

