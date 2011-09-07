<?php

/*
 * Show page template listing on top left corner of browser
 */
function pagelist($template_list_opened=false) {
    global $htmlwarrior, $smarty;

    $site_dir = $htmlwarrior->runtime['site_dir'];
    $pages_dir = $site_dir . $htmlwarrior->config['path_templates_pages'];
    $layouts_dir = $site_dir . $htmlwarrior->config['path_templates_layouts'];

    $files = array();
    $files_out = array();
    $index_in_list = false;
    if ($handle = opendir('../' . $site_dir . '/templates/pages')) {
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..') {
                if (isset($htmlwarrior->config['hidden_file_prefix'])) {
                    if (strpos($file, $htmlwarrior->config['hidden_file_prefix']) === 0) {
                        continue;
                    }
                }
                $tpl_files[] = $file;
            }
        }
        closedir($handle);

        sort($tpl_files);
        if (in_array('index.tpl', $tpl_files)) {
            $index_in_list = true;
            foreach ($tpl_files as $key => $val) {
                if ($val == 'index.tpl')
                    unset($tpl_files[$key]);
            }
        }

        $page = str_replace('__logged', '', $htmlwarrior->page);

        $basepath_local = '';
        if ( !$htmlwarrior->config['template_edit_links_downloadable'] ) {
            $basepath_local = $htmlwarrior->config['basepath_local'];
        }

        if ($index_in_list) {
            $url = 'index' . $htmlwarrior->logged_sufix . '.html?template_list_opened=1';
            $edit_url = $basepath_local . '/' . $pages_dir . '/' . $page . '.tpl';

            if ($page != '' && $page . '.tpl' != 'index.tpl') {
                $files_out[] = array(
                    'url' => $url,
                    'edit_url' => $edit_url,
                    'page' => 'index',
                    'active' => false
                );
            } else {
                $files_out[] = array(
                    'url' => $url,
                    'edit_url' => $edit_url,
                    'page' => 'index',
                    'active' => true
                );
            }
        }
        foreach ($tpl_files as $tpl_file) {
            if ($page . '.tpl' != $tpl_file) {
                $edit_url = $basepath_local . '/' . $pages_dir . '/' . $tpl_file;

                $files_out[] = array(
                    'url' => str_replace('.tpl', $htmlwarrior->logged_sufix . '.html', $tpl_file) . '?template_list_opened=1',
                    'edit_url' => $edit_url ,
                    'page' => str_replace('.tpl', '', $tpl_file),
                    'active' => false
                );
            } else {
                $edit_url = $basepath_local . '/' . $pages_dir . '/' . $tpl_file;

                $files_out[] = array(
                    'url' => str_replace('.tpl', $htmlwarrior->logged_sufix . '.html', $tpl_file) . '?template_list_opened=1',
                    'edit_url' => $edit_url,
                    'page' => str_replace('.tpl', '', $tpl_file),
                    'active' => true
                );
            }
        }
    }

    $site_filelist_page_edit_link =   $basepath_local . '/' . $pages_dir . '/' . $page . '.tpl';
    $site_filelist_layout_edit_link = $basepath_local . '/' . $layouts_dir . '/' . $htmlwarrior->layout . '.tpl';

    $smarty->assign('site_filelist_template_list', $files_out);
    $smarty->assign('site_filelist_page_edit_link', $site_filelist_page_edit_link);
    $smarty->assign('site_filelist_layout_edit_link', $site_filelist_layout_edit_link);
    $smarty->assign('template_list_opened', $template_list_opened);

    return $smarty->fetch('admin/templates/site_pagelist.tpl');
}