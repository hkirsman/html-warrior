<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.partial.php
 * Type:     function
 * Name:     partial
 * Purpose:  include partial and assing parameters
 * -------------------------------------------------------------
 */

function smarty_function_partial($params, $template) {
    global $htmlwarrior, $smarty, $text, $urls;


    // shorten long variables
    $config = $htmlwarrior->config;
    $runtime = $htmlwarrior->runtime;
    $page = $htmlwarrior->page;


    // show error if required attribute
    if (empty($params['tpl'])) {
        trigger_error('[plugin] fetch parameter \'tpl\' cannot be empty', E_USER_NOTICE);
        return;
    }


    // create full path for partial
    $path_partial_helper = $config['basepath'] . '/' .
            $runtime['site_dir'] .
            $config['path_templates_partials'] . '/' .
            $params['tpl'] . '.php';


    // check if partial template exists
    if (file_exists($path_partial_helper)) {
        require($path_partial_helper);
    }


    // show partials default css in alertbox if showcss parameter is set for partial
    if ($params['showcss']) {
        echo '<script type="text/javascript" src="http://www.google.com/jsapi"></script>';
        echo '<script type="text/javascript" src="' . $config['path_code'] . '/core/js/general.js"></script>';
        echo '<script type="text/javascript">var partialName = "' . $params['tpl'] . '";</script>';
        echo '<script type="text/javascript" src="' . $config['path_code'] . '/core/js/showcss.js"></script>';
    }


    // todo. not working right now
    // copy template from code to site if template does not exist
    if (!file_exists($smarty->getTemplateDir(0) . '/partials/' . $params['tpl'] . '.tpl')) {
        echo '<div style="background: red">Templatet ei ole olemas. Kopeerin uue?. <a href="?copy=yes">jah</a></div>';
        if (@$_GET['copy'] == 'yes') {
            if (copy($config['code_path'] . '/templates/partials/' . $params['tpl'] . '.tpl', $smarty->getTemplateDir(0) . '/partials/' . $params['template'] . '.tpl')) {
                echo 'done';
            } else {
                echo $config['code_path'] . '/templates/partials/' . $params['tpl'] . '.tpl does not exist!';
            }
        }
    }


    // create template
    $tpl = $smarty->createTemplate('partials/' . $params['tpl'] . '.tpl', $smarty);


    // assign partial variables to template
    foreach ($params as $key => $var) {
        if ($key != 'tpl') {
            $tpl->assign($key, $var);
        }
    }


    // load translations
    if ($config['multilingual']) {
        $smarty->assign('text', $text);
        $smarty->assign('lang_current', $runtime['lang_current']);
    }


    // parse template object
    $output = $smarty->fetch($tpl);


    // remove utf-8 bom from template
    // odd things happen if these are not removed
    // todo: for other templates too
    $output = remove_bom($output);


    // parse @ variables
    // todo: should these be made available for pages and layouts too?
    // todo2: should we parse variables before fetch so we could use smarty variables in @ parameters
    $page_variables = parse_variables($output);
    $output = remove_variables($output);


    // copy files if these are listed in template
    if (@$_GET['copy'] == 'yes') {
        if ($page_variables['_files']) {
            foreach ($page_variables['_files'] as $key => $var) {
                if (file_exists($config['code_path'] . '/' . $var) && !file_exists($config['basepath'] . '/' . $runtime['site_dir'] . '/' . $var)) {
                    if (copy($config['code_path'] . '/' . $var, $config['basepath'] . '/' . $runtime['site_dir'] . '/' . $var)) {
                        echo 'done copying $var';
                    }
                }
            }
        }
        if ($page_variables['stylefile']) {
            // todo?
        }
        // get help if exists? todo
    }


    // fix indents
    // todo: create functions for this?
    {
        $a_output = explode("\n", $output);
        $first_line = true;
        foreach ($a_output as $key => $var) {
            if (!$first_line || $params['fullindent']) {
                $a_output[$key] = $params['indent'] . $var;
            } else {
                $first_line = false;
                $a_output[$key] = $var;
            }
        }
        // fix: remove lines with only spaces
        $s_outputFinal = implode("\n", $a_output);
        $s_outputFinal = trim($s_outputFinal);
    }


    // write placeholders with script tag so they don't mess up the docs
    // validity
    // todo: create functions for this?
    // todo2: make it work too. we had some problems with it some time ago.
    if ($config['show_partial_edit_links'] && $params['tpl'] != 'script') {
        $s_outputFinal = trim($s_outputFinal);
        if (strlen($s_outputFinal)) {
            if (!isset($smarty->partial_index)) {
                $smarty->partial_index = 1;
            } else {
                $smarty->partial_index++;
            }

            $placeholder_params_begin = 'id="' . $config['htmlwarrior_prefix'] . '_placeholder_begin__' . $smarty->partial_index . '"';
            $placeholder_params_end = 'id="' . $config['htmlwarrior_prefix'] . '_placeholder_end__' . $smarty->partial_index . '"';
            if (get_first_tag_name($s_outputFinal) == 'li') {
                $s_outputFinal = '<li ' . $placeholder_params_begin . ' style="display:none"><script type="text/javascript">htmlwarrior_partial_edit_links[' . $smarty->partial_index .
                        ']={"name":"' . $params['tpl'] . '", "path_edit":"' . mk_partial_edit_link($params['tpl'] . '.tpl') . '"}</script></li>' .
                        $s_outputFinal .
                        '<li ' . $placeholder_params_end . ' style="display:none"></li>';
            } else {
                $s_outputFinal = '
                    <script type="text/javascript" ' . $placeholder_params_begin .
                        '>htmlwarrior_partial_edit_links[' . $smarty->partial_index .
                        ']={"name":"' . $params['tpl'] . '", "path_edit":"' . mk_partial_edit_link($params['tpl'] . '.tpl') . '"}</script>' .
                        $s_outputFinal .
                        '<script type="text/javascript" ' . $placeholder_params_end .
                        '></script>';
            }
        }
    }
    return $s_outputFinal;
}