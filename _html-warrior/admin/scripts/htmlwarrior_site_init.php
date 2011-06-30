<?php

header("Content-type: text/javascript");
require_once("../../includes/functions.php");
require_once("../../config.php");
echo "var htmlwarrior_config = new Array();\n";
foreach ($htmlwarrior->config as $key => $var) {
    echo 'htmlwarrior_config["' . $key . '"] = "' . $var . '";' . "\n";
}
if ( $htmlwarrior->config["show_partial_edit_links"] ) {
    echo "var htmlwarrior_partial_edit_links = new Array();\n";
}