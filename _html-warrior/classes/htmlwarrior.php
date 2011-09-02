<?php

class htmlwarrior {

    public function load_page($url_path = false) {
        global $htmlwarrior, $smarty;

        if ($url_path === false) {
            $url_path = $htmlwarrior->runtime['parsed_url']['path'];
        }

        $page_tpl_path = get_page_template_path($url_path);
        $page_object = $smarty->createTemplate($page_tpl_path);
        $page_content_before_assigns = $smarty->fetch($page_object);
        $page_variables = parse_variables($page_content_before_assigns);
        if (isset($page_variables['php'])) {
            $page_template_php_path = $htmlwarrior->config['basepath'] . '/' .
                    $htmlwarrior->runtime['site_dir'] .
                    $htmlwarrior->config['path_templates_pages'] . '/' .
                    $page_variables['php'];
        } else {
            $page_template_php_path = str_replace('.tpl', '.php', $page_tpl_path);
        }
        // load page php
        if (file_exists($page_template_php_path)) {
            $__init_page_php = function ($page_template_php_path) {
                global $htmlwarrior;
                require_once($page_template_php_path);
                return $params;
            };
            $params = $__init_page_php($page_template_php_path);
        }
        $page_object = $smarty->createTemplate($page_tpl_path);
        foreach ($params as $key => $val) {
            $page_object->assign($key, $val);
        }
        $page_content = $smarty->fetch($page_object);
        if ($htmlwarrior->config['build']) {
            $template_filetime = filemtime($page_tpl_path);
        }

        return array($page_content, $page_variables);
    }
}