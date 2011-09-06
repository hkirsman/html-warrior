<?php

// Paths
$htmlwarrior->config['path_code'] = '/_html-warrior';
$htmlwarrior->config['basepath'] = substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($_SERVER['SCRIPT_FILENAME'], $htmlwarrior->config['path_code']));
##$htmlwarrior->config['basepath'] = 'e:/www';
$htmlwarrior->config['basepath_local'] = 'file:///' . $htmlwarrior->config['basepath'];
##$htmlwarrior->config['basepath_local'] = 'file:///e:/www';
$htmlwarrior->config['baseurl'] = get_baseurl();
##$htmlwarrior->config['baseurl'] = 'http://localhost:8888';
$htmlwarrior->config['code_path'] = $htmlwarrior->config['basepath'] . $htmlwarrior->config['path_code'];
$htmlwarrior->config['basepath'] = $htmlwarrior->config['basepath'];

$htmlwarrior->config['frontpage_site'] = false; # example: '/example_site'
$htmlwarrior->config['build'] = true;
$htmlwarrior->config['log'] = true;
$htmlwarrior->config['live'] = false;
$htmlwarrior->config['error_page'] = false; # example 'error' - which means error.tpl in templates/pages

$htmlwarrior->config['htmlwarrior_prefix'] = 'htmlwarrior';

$htmlwarrior->config['multilingual'] = false;
$htmlwarrior->config['lang_default'] = 'en';
$htmlwarrior->config['lang_cookie_name'] = $htmlwarrior->config['htmlwarrior_prefix'] . 'lang_default';
$htmlwarrior->config['langs_used'] = array('et'=>'eesti keeles', 'en'=>'in english');

$htmlwarrior->config['indent'] = 'spaces'; // or tabs
$htmlwarrior->config['indent_count'] = 2;
$htmlwarrior->config['debug'] = false;
$htmlwarrior->config['devmode'] = true; # shov layer overlay, pagelist etc
$htmlwarrior->config['build_dir'] = 'build';
$htmlwarrior->config['path_build'] = $htmlwarrior->config['build_dir'];
$htmlwarrior->config['path_templates'] = '/templates';
$htmlwarrior->config['path_templates_layouts'] = $htmlwarrior->config['path_templates'] . '/layouts';
$htmlwarrior->config['path_templates_pages'] = $htmlwarrior->config['path_templates'] . '/pages';
$htmlwarrior->config['path_templates_partials'] = $htmlwarrior->config['path_templates'] . '/partials';
$htmlwarrior->config['path_images'] = '/images';
$htmlwarrior->config['path_style'] = '/style';
$htmlwarrior->config['path_scripts'] = '/scripts';
$htmlwarrior->config['path_cfg'] = '/cfg';
$htmlwarrior->config['path_overlays'] = '/overlays';

$htmlwarrior->config['locale'] = 'english-utf8.php';

// SQLite database files
$htmlwarrior->config['path_db_dir'] = $htmlwarrior->config['code_path'] . '/database/';

$htmlwarrior->config['timeoffset'] = 3600;
$htmlwarrior->config['htmlwarrior_prefix'] = 'htmlwarrior';
$htmlwarrior->config['show_partial_edit_links'] = false;
// Hide templates from listings with these prefixes
$htmlwarrior->config['hidden_file_prefix'] = '__';
// use this to popup firefoxes browser download dialog to save default setting
$htmlwarrior->config['template_edit_links_downloadable'] = false;

// PHP
$htmlwarrior->config['php_error_reporting'] = 1; # example 'E_ALL ^ E_NOTICE ^ E_WARNING'