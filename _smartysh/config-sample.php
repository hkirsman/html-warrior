<?php

// Paths
$smartysh->config["path_code"] = "/_smartysh";
$smartysh->config["basepath"] = substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($_SERVER['SCRIPT_FILENAME'], $smartysh->config["path_code"]));
##$smartysh->config["basepath"] = "e:/www";
$smartysh->config["basepath_local"] = "file:///" . $smartysh->config["basepath"];
##$smartysh->config["basepath_local"] = "file:///e:/www";
$smartysh->config["baseurl"] = get_baseurl();
##$smartysh->config["baseurl"] = "http://localhost:8888";
$smartysh->config["code_path"] = $smartysh->config["basepath"] . $smartysh->config["path_code"];
$smartysh->config["basepath"] = $smartysh->config["basepath"];

$smartysh->config["frontpage_site"] = false; # example: "/example_site"
$smartysh->config["build"] = true;
$smartysh->config["log"] = true;
$smartysh->config["live"] = false;

$smartysh->config["indent"] = "spaces"; // or tabs
$smartysh->config["indent_count"] = 2;
$smartysh->config["debug"] = false;
$smartysh->config["build_dir"] = "build";
$smartysh->config["path_build"] = $smartysh->config["build_dir"];
$smartysh->config["path_templates_layouts"] = "/templates/layouts";
$smartysh->config["path_templates_pages"] = "/templates/pages";
$smartysh->config["path_templates_partials"] = "/templates/partials";
$smartysh->config["path_images"] = "/images";
$smartysh->config["path_style"] = "/style";
$smartysh->config["path_scripts"] = "/scripts";

// SQLite database files
$smartysh->config["path_db_dir"] = $smartysh->config["code_path"] . "/database/";

$smartysh->config["timeoffset"] = 3600;
$smartysh->config["smartysh_prefix"] = "smartysh";
$smartysh->config["show_partial_edit_links"] = false;
// Hide templates from listings with these prefixes
$smartysh->config["hidden_file_prefix"] = "__";
// use this to popup firefoxes browser download dialog to save default setting
$smartysh->config["template_edit_links_downloadable"] = false;
?>