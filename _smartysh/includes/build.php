<?php

/*
  build.php - build the whole site
 */

$files = array();
if ($handle = opendir($config["basepath"] . "/$site_dir/templates/pages")) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            $tpl_files[] = $file;
        }
    }
    closedir($handle);

    foreach ($tpl_files as $tpl_file) {
        file_get_contents($config["baseurl"] . "/" . $site_dir . "/" . str_replace(".tpl", ".html", $tpl_file) . "?debug=0");
    }
}

// copy dirs
full_copy($config["basepath"] . "/$site_dir/images", $config["basepath"] . "/$site_dir/" . $config["build_dir"] . "/images");
full_copy($config["basepath"] . "/$site_dir/scripts", $config["basepath"] . "/$site_dir/" . $config["build_dir"] . "/scripts");
full_copy($config["basepath"] . "/$site_dir/style", $config["basepath"] . "/$site_dir/" . $config["build_dir"] . "/style");
?>