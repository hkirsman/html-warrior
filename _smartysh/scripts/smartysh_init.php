<?php

header("Content-type: text/javascript");
require_once("../config.php");
echo "var smartysh_config = new Array();\n";
foreach ($config as $key => $var) {
    echo 'smartysh_config["' . $key . '"] = "' . $var . '";' . "\n";
}
?>