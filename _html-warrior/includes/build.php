<?php

/*
  build.php - build the whole site
 */

$files = array();
if ($handle = opendir($smartysh->config["basepath"] . "/" . $smartysh->runtime["site_dir"] . "/templates/pages")) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            $tpl_files[] = $file;
        }
    }
    closedir($handle);

    foreach ($tpl_files as $tpl_file) {
        file_get_contents($smartysh->config["baseurl"] . "/" . $smartysh->runtime["site_dir"] . "/" . str_replace(".tpl", ".html", $tpl_file) . "?debug=0");
    }
}

// copy dirs
full_copy($smartysh->config["basepath"] . "/" . $smartysh->runtime["site_dir"] . "/images",
        $smartysh->config["basepath"] . "/" . $smartysh->runtime["site_dir"] . "/" . $smartysh->config["build_dir"] . "/images"
);
full_copy($smartysh->config["basepath"] . "/" . $smartysh->runtime["site_dir"] . "/scripts",
        $smartysh->config["basepath"] . "/" . $smartysh->runtime["site_dir"] . "/" . $smartysh->config["build_dir"] . "/scripts"
);
full_copy($smartysh->config["basepath"] . "/" . $smartysh->runtime["site_dir"] . "/style",
        $smartysh->config["basepath"] . "/" . $smartysh->runtime["site_dir"] . "/" . $smartysh->config["build_dir"] . "/style"
);
?>