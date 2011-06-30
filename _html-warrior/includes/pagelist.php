<?php

function pagelist($template_list_opened=false) {
    global $htmlwarrior, $smarty, $debug;

    $files = array();
    $files_out = array();
    $index_in_list = false;
    if ($handle = opendir("../" . $htmlwarrior->runtime["site_dir"] . "/templates/pages")) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {
                if (isset($htmlwarrior->config["hidden_file_prefix"])) {
                    if (strpos($file, $htmlwarrior->config["hidden_file_prefix"]) === 0) {
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

        $page = str_replace("__logged", "", $htmlwarrior->page);

        if ($index_in_list) {
            if ($page != "" && $page . ".tpl" != "index.tpl") {
                $files_out[] = array(
                    "url" => "index" . $htmlwarrior->logged_sufix . ".html?template_list_opened=1",
                    "edit_url" => (!$htmlwarrior->config["template_edit_links_downloadable"] ? $htmlwarrior->config["basepath_local"] : "") . "/" . $htmlwarrior->runtime["site_dir"] . $htmlwarrior->config["path_templates_pages"] . "/" . $page . ".tpl",
                    "page" => "index",
                    "active" => false
                );
            } else {
                $files_out[] = array(
                    "url" => "index" . $htmlwarrior->logged_sufix . ".html?template_list_opened=1",
                    "edit_url" => (!$htmlwarrior->config["template_edit_links_downloadable"] ? $htmlwarrior->config["basepath_local"] : "") . "/" . $htmlwarrior->runtime["site_dir"] . $htmlwarrior->config["path_templates_pages"] . "/" . $page . ".tpl",
                    "page" => "index",
                    "active" => true
                );
            }
        }
        foreach ($tpl_files as $tpl_file) {
            if ($page . ".tpl" != $tpl_file) {
                $files_out[] = array(
                    "url" => str_replace(".tpl", $htmlwarrior->logged_sufix . ".html", $tpl_file) . "?template_list_opened=1",
                    "edit_url" => (!$htmlwarrior->config["template_edit_links_downloadable"] ? $htmlwarrior->config["basepath_local"] : "") . "/" . $htmlwarrior->runtime["site_dir"] . $htmlwarrior->config["path_templates_pages"] . "/" . $page . ".tpl",
                    "page" => str_replace(".tpl", "", $tpl_file),
                    "active" => false
                );
            } else {
                $files_out[] = array(
                    "url" => str_replace(".tpl", $htmlwarrior->logged_sufix . ".html", $tpl_file) . "?template_list_opened=1",
                    "edit_url" => (!$htmlwarrior->config["template_edit_links_downloadable"] ? $htmlwarrior->config["basepath_local"] : "") . "/" . $htmlwarrior->runtime["site_dir"] . $htmlwarrior->config["path_templates_pages"] . "/" . $page . ".tpl",
                    "page" => str_replace(".tpl", "", $tpl_file),
                    "active" => true
                );
            }
        }
    }

    $site_filelist_page_edit_link = (!$htmlwarrior->config["template_edit_links_downloadable"] ? $htmlwarrior->config["basepath_local"] : "") . "/" . $htmlwarrior->runtime["site_dir"] . $htmlwarrior->config["path_templates_pages"] . "/" . $page . ".tpl";
    $site_filelist_layout_edit_link = (!$htmlwarrior->config["template_edit_links_downloadable"] ? $htmlwarrior->config["basepath_local"] : "") . "/" . $htmlwarrior->runtime["site_dir"] . $htmlwarrior->config["path_templates_layouts"] . "/" . $htmlwarrior->layout . ".tpl";

    $smarty->assign("site_filelist_template_list", $files_out);
    $smarty->assign("site_filelist_page_edit_link", $site_filelist_page_edit_link);
    $smarty->assign("site_filelist_layout_edit_link", $site_filelist_layout_edit_link);
    $smarty->assign("template_list_opened", $template_list_opened);

    return $smarty->fetch("admin/templates/site_pagelist.tpl");
}