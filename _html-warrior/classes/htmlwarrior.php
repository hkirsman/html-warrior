<?php

class htmlwarrior {

    /**
     * Load page template (SITEFOLDER/templates/pages/ by default)
     * @global object $htmlwarrior required
     * @global object $smarty required
     * @global array $text optional Translation strings in SITEFOLDER/locale/LANGNAME
     * @global array $urls Url optional Path translations in SITEFOLDER/nav.php
     * @param string $url_path optional optional URL
     * @param string $page_template_php_path
     * @return array Returns page_content (string),
     * page_variables (@ variables eg @title) and $template_filetime (time
     * when template was created - so we can add it to built html file)
     */
    public function load_page($url_path = false) {
        global $htmlwarrior, $smarty, $text, $urls;


        // shorten long variables
        $config = $htmlwarrior->config;
        $runtime = $htmlwarrior->runtime;
        $error_page = $config['error_page'];
        $lang_current = $runtime['lang_current'];
        $email_to_submit_on_404 = $config['email_to_submit_on_404'];


        // load current url_path if not loaded
        if ($url_path === false) {
            $url_path = $runtime['parsed_url']['path'];
        }


        // get template path based on url
        $page_tpl_path = get_page_template_path($url_path);


        // if error page is defined in config.php and template is not found
        // then redirect to error page
        if ($error_page) {
            if (!file_exists($page_tpl_path)) {
                if ($config['multilingual']) {
                    $redirect = $urls[$error_page][$lang_current]['link'];
                } else {
                    $redirect = '/' . $error_page;
                }
                if ($email_to_submit_on_404) {
                    $subject = 'error';
                    $body = 'Page not found: ' . $url_path . "\n";
                    $body .= 'HTTP Referer: ' . $_SERVER['HTTP_REFERER'];
                    mail($email_to_submit_on_404, $subject, $body);
                }
                header('HTTP/1.1 404 Not Found');
                header('Location: ' . $redirect);
            }
        }


        // create template
        $page_object = $smarty->createTemplate($page_tpl_path);


        // load page php and assign variables to template
        if (isset($page_variables['php'])) {
            $page_template_php_path = $config['basepath'] . '/' .
                    $runtime['site_dir'] .
                    $config['path_templates_pages'] . '/' .
                    $page_variables['php'];
        } else {
            $page_template_php_path = str_replace('.tpl', '.php', $page_tpl_path);
        }
        if (file_exists($page_template_php_path)) {
            $__init_page_php = function ($page_template_php_path) {
                        global $htmlwarrior;
                        require_once($page_template_php_path);
                        return $params;
                    };
            $params = $__init_page_php($page_template_php_path);

            foreach ($params as $key => $val) {
                $page_object->assign($key, $val);
            }
        }


        // load translations
        if ($config['multilingual']) {
            $page_object->assign('text', $text);
            $page_object->assign('lang_current', $runtime['lang_current']);
        }


        // parse template object
        $page_content = $smarty->fetch($page_object);


        // parse @ variables from template
        // todo: should we clean up @ variables now or in the index.php?
        $page_variables = parse_variables($page_content);


        // hm, this does not work, does it?
        if ($config['build']) {
            $template_filetime = filemtime($page_tpl_path);
        }

        return array($page_content, $page_variables, $template_filetime);
    }

}