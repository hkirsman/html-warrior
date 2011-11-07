<?php

class htmlwarrior {

    public function load_page($url_path = false) {
        global $htmlwarrior, $smarty, $text, $urls;

        $error_page = $htmlwarrior->config['error_page'];
        $lang_current = $htmlwarrior->runtime['lang_current'];
        $email_to_submit_on_404 = $htmlwarrior->config['email_to_submit_on_404'];

        if ($url_path === false) {
            $url_path = $htmlwarrior->runtime['parsed_url']['path'];
        }
        $page_tpl_path = get_page_template_path($url_path);
        if ($error_page) {
            if (!file_exists($page_tpl_path)) {
                if ($htmlwarrior->config['multilingual']) {
                    $redirect = $urls[$error_page][$lang_current]['link'];
                } else {
                    $redirect = '/' . $error_page;
                }
                if ($email_to_submit_on_404) {
                    $subject = 'error';
                    $body = 'Page not found: ' . $url_path."\n";
                    $body .= 'HTTP Referer: ' . $_SERVER['HTTP_REFERER'];
                    mail($email_to_submit_on_404, $subject, $body);
                }
                header('HTTP/1.1 404 Not Found');
                header('Location: ' . $redirect);
            }
        }
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
        // load translations
        if ($htmlwarrior->config['multilingual']) {
            $page_object->assign('text', $text);
            $page_object->assign('lang_current', $htmlwarrior->runtime['lang_current']);
        }
        $page_content = $smarty->fetch($page_object);
        if ($htmlwarrior->config['build']) {
            $template_filetime = filemtime($page_tpl_path);
        }

        return array($page_content, $page_variables);
    }

}