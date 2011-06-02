<?php

function pagelist($template_list_opened=false) {
    global $smarty, $config, $debug, $smartysh;

    $files = array();
    $files_out = array();
    $index_in_list = false;
    if ($handle = opendir("../" . $smartysh->site_dir . "/templates/pages")) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {
                if (isset($config["hidden_file_prefix"])) {
                    if (strpos($file, $config["hidden_file_prefix"]) === 0) {
                        continue;
                    }
                }
                $tpl_files[] = $file;
                //echo tpl_to_link($file, $site_dir) . "<br />";
            }
        }
        closedir($handle);

        sort($tpl_files);
        if (in_array("index.tpl", $tpl_files)) {
            $index_in_list = true;
            foreach ($tpl_files as $key => $val) {
                if ($val == "index.tpl")
                    unset($tpl_files[$key]);
            }
        }

        $page = str_replace("__logged", "", $smartysh->page);

        if ($index_in_list) {
            if ($page != "" && $page.".tpl" != "index.tpl") {
                $files_out[] = array(
                    "url" => "index".$smartysh->logged_sufix.".html?template_list_opened=1",
                    "edit_url" => (!$config["template_edit_links_downloadable"] ? $config["basepath_local"] : "") . "/" . $smartysh->site_dir . $config["path_templates_pages"] . "/" . $page.".tpl",
                    "page" => "index",
                    "active" => false
                );
            } else {
                $files_out[] = array(
                    "url" => "index".$smartysh->logged_sufix.".html?template_list_opened=1",
                    "edit_url" => (!$config["template_edit_links_downloadable"] ? $config["basepath_local"] : "") . "/" . $smartysh->site_dir . $config["path_templates_pages"] . "/" . $page.".tpl",
                    "page" => "index",
                    "active" => true
                );
            }
        }
        foreach ($tpl_files as $tpl_file) {
            if ($page . ".tpl" != $tpl_file ) {
                $files_out[] = array(
                    "url" => str_replace(".tpl", $smartysh->logged_sufix.".html", $tpl_file)."?template_list_opened=1",
                    "edit_url" => (!$config["template_edit_links_downloadable"] ? $config["basepath_local"] : "") . "/" . $smartysh->site_dir . $config["path_templates_pages"] . "/" . $page . ".tpl",
                    "page" => str_replace(".tpl", "", $tpl_file),
                    "active" => false
                );
            } else {
                $files_out[] = array(
                    "url" => str_replace(".tpl", $smartysh->logged_sufix.".html", $tpl_file)."?template_list_opened=1",
                    "edit_url" => (!$config["template_edit_links_downloadable"] ? $config["basepath_local"] : "") . "/" . $smartysh->site_dir . $config["path_templates_pages"] . "/" . $page . ".tpl",
                    "page" => str_replace(".tpl", "", $tpl_file),
                    "active" => true
                );
            }
        }
    }

    $site_filelist_page_edit_link = (!$config["template_edit_links_downloadable"] ? $config["basepath_local"] : "") . "/" . $smartysh->site_dir . $config["path_templates_pages"] . "/" . $page . ".tpl";
    $site_filelist_layout_edit_link = (!$config["template_edit_links_downloadable"] ? $config["basepath_local"] : "") . "/" . $smartysh->site_dir . $config["path_templates_layouts"] . "/" . $smartysh->layout . ".tpl";

    $smarty->assign("site_filelist_template_list", $files_out);
    $smarty->assign("site_filelist_page_edit_link", $site_filelist_page_edit_link);
    $smarty->assign("site_filelist_layout_edit_link", $site_filelist_layout_edit_link);
    $smarty->assign("template_list_opened", $template_list_opened);

    return $smarty->fetch("admin/templates/site_pagelist.tpl");
}

?>