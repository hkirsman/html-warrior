<?php

require_once('classes/htmlwarrior.php');
$htmlwarrior = new htmlwarrior();

require_once('includes/functions.php');
if (!file_exists('config.php')) {
    copy('config-sample.php', 'config.php');
}
require 'config.php';

require $htmlwarrior->config['code_path'] . '/externals/smarty/libs/Smarty.class.php';
$smarty = new Smarty;
#$smarty->allow_php_tag = true;
$smarty->error_reporting = $htmlwarrior->config['php_error_reporting'];
error_reporting($htmlwarrior->config['php_error_reporting']);

if (!isset($txt)) {
    $txt = array();
    require_once('locale/' . $htmlwarrior->config['locale']);
}
$smarty->assign('txt', $txt);

require_once('includes/db.php');

$htmlwarrior->runtime = array(
    'url' => get_cur_page_url(),
    'parsed_url' => parse_url(get_cur_page_url()),
);
$htmlwarrior->runtime['lang_current'] = get_cur_lang();