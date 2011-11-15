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


// load admin translations
// todo: think it over again. Something like site translations?
if (!isset($txt)) {
    $txt = array();
    require_once('locale/' . $htmlwarrior->config['locale']);
}
$smarty->assign('txt', $txt);


// create database tables and database if not exists
require_once('includes/db.php');


// get url info
$htmlwarrior->runtime = array(
    'url' => get_cur_page_url(),
    'parsed_url' => parse_url(get_cur_page_url()),
);


// get site_dir
if ($htmlwarrior->config['frontpage_site']) {
    $htmlwarrior->runtime['site_dir'] = trim($htmlwarrior->config['frontpage_site'], '/');
} else {
    $site_dir = explode('/', trim($htmlwarrior->runtime['parsed_url']['path'], '/'));
    $htmlwarrior->runtime['site_dir'] = current($site_dir);
    unset($site_dir);
}


// include custom config.php (if exists) from SITE_DIR/cfg/config.php
$htmlwarrior->load_custom_config();