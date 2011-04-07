<?php
$config["baseurl"] = "http://127.0.0.1:8888/";
$config_q["basepath"] = "c:/www";
$config["basepath"] = $config_q["basepath"];
$config["basepath_local"] = "file:///c:/www";
$config_q["code_path"] = $config_q["basepath"]."/_proto-smarty";
$config["code_path"] = $config_q["code_path"];
$config["indent"] = "spaces"; // or tabs
$config["indent_count"] = 2;
$config["build_dir"] = "build";
$config["path_build"] = $config["build_dir"];
$config["path_templates_pages"] = "/templates/pages";

?>