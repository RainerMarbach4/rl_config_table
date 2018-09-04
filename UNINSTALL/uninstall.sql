# $Id$
##########################################################################
# config_table 1.0.2 Uninstall - 2018-09-03 :: hugo13
# NUR AUSFÜHREN WENN SIE DAS MODUL AUS DER DATENBANK ENTFERNEN WOLLEN!!!!!
# $Id$ 
##########################################################################


DELETE FROM configuration WHERE configuration_key IN ('RL_CONFIG_TABLE_MARGIN', 'RL_CONFIG_TABLE_BORDER', 'RL_CONFIG_TABLE_PADDING', 'RL_CONFIG_TABLE_VERSION');
DELETE FROM configuration_group WHERE configuration_group_title IN ('Konfigurationstabelle', 'Config Table');
DELETE FROM admin_pages WHERE page_key IN ('config_table_menu', 'config_table_config');

# bei einer mehrsprachigen installation
# for multilingual installation
DELETE FROM configuration_language WHERE configuration_key IN ('RL_CONFIG_TABLE_MARGIN', 'RL_CONFIG_TABLE_BORDER', 'RL_CONFIG_TABLE_PADDING');
