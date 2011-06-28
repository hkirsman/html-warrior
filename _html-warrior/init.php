<?php

require $htmlwarrior->config["code_path"] . '/externals/smarty/libs/Smarty.class.php';
$smarty = new Smarty;
#$smarty->allow_php_tag = true;
$smarty->error_reporting = $smartysh->config["php_error_reporting"];
error_reporting($htmlwarrior->config["php_error_reporting"]);

require_once("includes/db.php");

$htmlwarrior->runtime = array(
    "url" => get_cur_page_url(),
    "parsed_url" => parse_url(get_cur_page_url()),
);
?>