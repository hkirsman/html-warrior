<?php

// Paths
$htmlwarrior->config["path_code"] = "/_html-warrior";
$htmlwarrior->config["basepath"] = substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($_SERVER['SCRIPT_FILENAME'], $htmlwarrior->config["path_code"]));
##$htmlwarrior->config["basepath"] = "e:/www";
$htmlwarrior->config["basepath_local"] = "file:///" . $htmlwarrior->config["basepath"];
##$htmlwarrior->config["basepath_local"] = "file:///e:/www";
$htmlwarrior->config["baseurl"] = get_baseurl();
##$htmlwarrior->config["baseurl"] = "http://localhost:8888";
$htmlwarrior->config["code_path"] = $htmlwarrior->config["basepath"] . $htmlwarrior->config["path_code"];
$htmlwarrior->config["basepath"] = $htmlwarrior->config["basepath"];

$htmlwarrior->config["frontpage_site"] = false; # example: "/example_site"
$htmlwarrior->config["build"] = true;
$htmlwarrior->config["log"] = true;
$htmlwarrior->config["live"] = false;

$htmlwarrior->config["indent"] = "spaces"; // or tabs
$htmlwarrior->config["indent_count"] = 2;
$htmlwarrior->config["debug"] = false;
$htmlwarrior->config["build_dir"] = "build";
$htmlwarrior->config["path_build"] = $htmlwarrior->config["build_dir"];
$htmlwarrior->config["path_templates_layouts"] = "/templates/layouts";
$htmlwarrior->config["path_templates_pages"] = "/templates/pages";
$htmlwarrior->config["path_templates_partials"] = "/templates/partials";
$htmlwarrior->config["path_images"] = "/images";
$htmlwarrior->config["path_style"] = "/style";
$htmlwarrior->config["path_scripts"] = "/scripts";

// SQLite database files
$htmlwarrior->config["path_db_dir"] = $htmlwarrior->config["code_path"] . "/database/";

$htmlwarrior->config["timeoffset"] = 3600;
$htmlwarrior->config["htmlwarrior_prefix"] = "htmlwarrior";
$htmlwarrior->config["show_partial_edit_links"] = false;
// Hide templates from listings with these prefixes
$htmlwarrior->config["hidden_file_prefix"] = "__";
// use this to popup firefoxes browser download dialog to save default setting
$htmlwarrior->config["template_edit_links_downloadable"] = false;
?>