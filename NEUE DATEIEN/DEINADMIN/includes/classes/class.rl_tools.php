<?php
class rl_tools{
    function isMultiLingual() {
        global $db;
        $sql = "SHOW  TABLES  LIKE  '" . TABLE_CONFIGURATION_LANGUAGE . "'";
        $res = $db->Execute($sql);
        if ($res->RecordCount() == 0) {
            return false;
        } else {
            return true;
        }
    }
}