<?php
/**
* @package rl_config_table
* @copyright Copyright 2003-2016 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
* @version $Id: config_table.php 2016-07-19 18:13:51Z webchills $
*/

require('includes/application_top.php');

function makeCSS(){
    $css = "
    <style>
    #rlconfigtable {         
    margin: " . RL_CONFIG_TABLE_MARGIN . ";
    border: " . RL_CONFIG_TABLE_BORDER . ";
    padding: " . RL_CONFIG_TABLE_PADDING . ";
    }
    .dataTables_filter, .dataTables_length {
    font-size: 150%;
    }
    #desc {
    width: 222px;
    color: green;
    }
    </style>";
    return $css;
}
function getJSLanguage(){
    $jsL = '"language": {
    "search": "' . RL_CONFIG_TABLE_JS_SEARCH . '",
    "lengthMenu": "'. RL_CONFIG_TABLE_JS_LENGTHMENU . '",
    },';
    return $jsL;
}

function getAjaxPath($p=0){
    if($p==0){
        return "'" . DIR_WS_ADMIN . "rl_config_table_a11.php" . "'";
    } else {
        // '/zc155/slEpt-FhD-Sorry/configuration.php?gID='
        return "'" . DIR_WS_ADMIN . "configuration.php?gID=" . "'";
    }  
}

if (!is_null($_GET['token']) && $_GET['token'] == 'new') { 
    generate_new_token();
    zen_redirect(zen_href_link(FILENAME_CONFIG_TABLE));
}
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
        <title><?php echo TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.10.19/features/searchHighlight/dataTables.searchHighlight.css">

        <?php echo makeCSS(); ?>

        <script language="javascript" src="includes/menu.js"></script>
        <script language="javascript" src="includes/general.js"></script>
        <script type="text/javascript">
            <!--
            function init()
            {
                cssjsmenu('navbar');
                if (document.getElementById)
                {
                    var kill = document.getElementById('hoverJS');
                    kill.disabled = true;
                }
            }
            // -->
        </script>
    </head>
    <body onload="init()">
        <!-- header //-->
        <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
        <!-- header_eof //-->
        <!-- body //-->
        <div id="rlconfigtable">
            <table id="rl_config_table" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Gruppe</th>
                        <th>GID</th>
                        <th>Option</th>
                        <th>CID</th>
                        <th>Key</th>
                        <th>Wert</th>
                        <th id='desc'>Beschreibung</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Gruppe</th>
                        <th>GID</th>
                        <th>Option</th>
                        <th>CID</th>
                        <th>Key</th>
                        <th>Wert</th>
                        <th>Beschreibung</th>
                    </tr>
                </tfoot>
            </table>
            <?php echo(RL_CONFIG_TABLE_DESCRIPTION); ?>
        </div>
        <!-- body_eof //-->
        <!-- footer //-->
        <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
        <!-- footer_eof //-->
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://bartaz.github.io/sandbox.js/jquery.highlight.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/features/searchHighlight/dataTables.searchHighlight.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('#rl_config_table').DataTable({
                    <?php echo getJSLanguage(); ?>
                    responsive: true,
                    "autoWidth": false,
                    lengthMenu: [ [50, 10, 25, -1], [50, 10, 25, "All"] ],
                    searchHighlight: true,
                    ajax: {
                        url: <?php echo getAjaxPath(); ?>,
                        dataSrc: ""
                    },
                    columns: [
                        {data: "configuration_group_title"},
                        {data: "configuration_group_id"},
                        {data: "configuration_title"},
                        {data: "configuration_id"},
                        {data: "configuration_key"},   
                        {data: "configuration_value"},
                        {data: "configuration_description"},
                    ]
                })

                table.search('2px green')

                $('#rl_config_table tbody').on('click', 'tr', function() {
                    var data = table.row(this).data()
                    var gID = data.configuration_group_id
                    var cID = data.configuration_id    
                    window.open(<?php echo getAjaxPath(1); ?> + gID +  '&cID=' + cID + '&action=edit', 'rl_configuration_table')
                })
            })   
        </script>
        <br />


        <!-- Button trigger modal -->
        <button type="button" class="btn" data-toggle="modal" data-target="#myModal">
            <?php //Launch demo modal ?>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-TEST" id="myModalLabel">Modal TEST</h4>
                    </div>
                    <div class="modal-body" id="rl_config_table_edit">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!--
        <button type="button" class="btn" data-toggle="modal" data-target="#myModal" data-remote="/zc155/slEpt-FhD-Sorry/configuration.php?gID=37&cID=696&action=edit">Launch modal</button>

        <div id="myModal" class="modal hide fade">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> × </button>
        <h3 id="myModalLabel">Edit</h3>
        </div>
        <div id="modal-body">
        <!-- remote content will be inserted here via jQuery load() 
        hallo !!!
        </div>
        <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
        </div>         -->
        <script type="text/javascript">
            $("#rl_config_table_edit").load("http://localhost/zc155/slEpt-FhD-Sorry/configurationEdit.php?gID=37&cID=696&action=edit");
        </script>         

    </body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>