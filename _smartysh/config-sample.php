<?php

// Paths
$config["path_code"] = "/_smartysh";
$config["basepath"] = substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($_SERVER['SCRIPT_FILENAME'], $config["path_code"]));
##$config["basepath"] = "e:/www";
$config["basepath_local"] = "file:///" . $config["basepath"];
##$config["basepath_local"] = "file:///e:/www";
$config["baseurl"] = get_baseurl();
##$config["baseurl"] = "http://localhost:8888";
$config["code_path"] = $config["basepath"] . $config["path_code"];
$config["basepath"] = $config["basepath"];

$config["indent"] = "spaces"; // or tabs
$config["indent_count"] = 2;
$config["debug"] = false;
$config["build_dir"] = "build";
$config["path_build"] = $config["build_dir"];
$config["path_templates_pages"] = "/templates/pages";
$config["path_templates_partials"] = "/templates/partials";

// SQLite database files
$config["path_db"] = $config["code_path"] . "/database/db";

$config["timeoffset"] = 3600;
$config["smartysh_prefix"] = "smartysh";
$config["show_partial_edit_links"] = false;
// Hide templates from listings with these prefixes
$config["hidden_file_prefix"] = "__";
// use this to popup firefoxes browser download dialog to save default setting
$config["template_edit_links_downloadable"] = false;
?>