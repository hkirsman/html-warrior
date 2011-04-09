<?php

$config["basepath"] = "d:/www";
$config["baseurl"] = "http://localhost:8080";
$config["path_code"] = "/_smartysh";
$config["code_path"] = $config["basepath"] . $config["path_code"];
$config["basepath"] = $config["basepath"];
$config["basepath_local"] = "file:///c:/www";
$config["indent"] = "spaces"; // or tabs
$config["indent_count"] = 2;
$config["debug"] = false;
$config["build_dir"] = "build";
$config["path_build"] = $config["build_dir"];
$config["path_templates_pages"] = "/templates/pages";
// SQLite database files
$config["path_db"] = $config["code_path"] . "/database/db";
//$config["db"]["server"] = "127.0.0.1";
//$config["db"]["username"] = "root";
//$config["db"]["password"] = "";
//$config["db"]["db"] = "smartysh";
$config["timeoffset"] = 3600;
?>