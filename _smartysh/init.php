<?php

require $config["code_path"] . '/externals/smarty/libs/Smarty.class.php';
$smarty = new Smarty;
$smarty->allow_php_tag = true;
$smarty->error_reporting = ~E_NOTICE;

require_once("includes/db.php");

$smartysh->runtime = array(
    "url" => get_cur_page_url(),
    "parsed_url" => parse_url(get_cur_page_url()),
);
?>