<?php
$config_q["basepath"] = "c:/www";
$config["path_code"] = "/_smartysh";
$config_q["code_path"] = $config_q["basepath"].$config["path_code"];
$config["code_path"] = $config_q["code_path"];
$config["basepath"] = $config_q["basepath"];
$config["basepath_local"] = "file:///c:/www";
$config["indent"] = "spaces"; // or tabs
$config["indent_count"] = 2;
$config["baseurl"] = "http://192.168.1.170:8080";
$config["debug"] = false;
$config["build_dir"] = "build";
$config["path_build"] = $config["build_dir"];
$config["path_templates_pages"] = "/templates/pages";
$config["db"]["server"] = "127.0.0.1";
$config["db"]["username"] = "root";
$config["db"]["password"] = "";
$config["db"]["db"] = "protosmarty";
$config["timeoffset"] = 3600;


?>