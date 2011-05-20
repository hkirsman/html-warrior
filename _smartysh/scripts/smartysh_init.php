<?php

header("Content-type: text/javascript");
require_once("../includes/functions.php");
require_once("../config.php");
echo "var smartysh_config = new Array();\n";
foreach ($config as $key => $var) {
    echo 'smartysh_config["' . $key . '"] = "' . $var . '";' . "\n";
}
if ( $config["show_partial_edit_links"] ) {
    echo "var smartysh_partial_edit_links = new Array();\n";
}
?>