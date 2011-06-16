<?php

/*
  build.php - build the whole site
 */

$files = array();
if ($handle = opendir($htmlwarrior->config["basepath"] . "/" . $htmlwarrior->runtime["site_dir"] . "/templates/pages")) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            $tpl_files[] = $file;
        }
    }
    closedir($handle);

    foreach ($tpl_files as $tpl_file) {
        file_get_contents($htmlwarrior->config["baseurl"] . "/" . $htmlwarrior->runtime["site_dir"] . "/" . str_replace(".tpl", ".html", $tpl_file) . "?debug=0");
    }
}

// copy dirs
full_copy($htmlwarrior->config["basepath"] . "/" . $htmlwarrior->runtime["site_dir"] . "/images",
        $htmlwarrior->config["basepath"] . "/" . $htmlwarrior->runtime["site_dir"] . "/" . $htmlwarrior->config["build_dir"] . "/images"
);
full_copy($htmlwarrior->config["basepath"] . "/" . $htmlwarrior->runtime["site_dir"] . "/scripts",
        $htmlwarrior->config["basepath"] . "/" . $htmlwarrior->runtime["site_dir"] . "/" . $htmlwarrior->config["build_dir"] . "/scripts"
);
full_copy($htmlwarrior->config["basepath"] . "/" . $htmlwarrior->runtime["site_dir"] . "/style",
        $htmlwarrior->config["basepath"] . "/" . $htmlwarrior->runtime["site_dir"] . "/" . $htmlwarrior->config["build_dir"] . "/style"
);
?>