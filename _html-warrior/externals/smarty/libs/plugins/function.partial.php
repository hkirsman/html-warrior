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
    global $smarty, $htmlwarrior;

    // make $page variable accessible to partial helper
    $page = $htmlwarrior->page;

    if (empty($params['tpl'])) {
        trigger_error("[plugin] fetch parameter 'tpl' cannot be empty", E_USER_NOTICE);
        return;
    }

    $path_partial_helper = $htmlwarrior->config["basepath"] . "/" .
            $htmlwarrior->runtime["site_dir"] .
            $htmlwarrior->config["path_templates_partials"] . "/" .
            $params["tpl"] . ".php";

    if (file_exists($path_partial_helper)) {
        
        require($path_partial_helper);
    }

    if ($params["showcss"]) {
        echo '<script type="text/javascript" src="http://www.google.com/jsapi"></script>';
        echo '<script type="text/javascript" src="' . $htmlwarrior->config["path_code"] . '/core/js/general.js"></script>';
        echo '<script type="text/javascript">var partialName = "' . $params["tpl"] . '";</script>';
        echo '<script type="text/javascript" src="' . $htmlwarrior->config["path_code"] . '/core/js/showcss.js"></script>';
    }

    // copy template from code to site if template does not exist
    if (!file_exists($smarty->getTemplateDir(0) . "/partials/" . $params["tpl"] . ".tpl")) {
        echo '<div style="background: red">Templatet ei ole olemas. Kopeerin uue?. <a href="?copy=yes">jah</a></div>';
        if (@$_GET["copy"] == "yes") {
            if (copy($htmlwarrior->config["code_path"] . "/templates/partials/" . $params["tpl"] . ".tpl", $smarty->getTemplateDir(0) . "/partials/" . $params["template"] . ".tpl")) {
                echo "done";
            } else {
                echo $htmlwarrior->config["code_path"] . "/templates/partials/" . $params["tpl"] . ".tpl does not exist!";
            }
        }
    }

    $tpl = $smarty->createTemplate('partials/' . $params['tpl'] . '.tpl', $smarty);
    foreach ($params as $key => $var) {
        if ($key != "tpl") {
            $tpl->assign($key, $var);
        }
    }
    $output = $smarty->fetch($tpl);
    $output = remove_bom($output);

    $page_variables = parse_variables($output);
    $output = remove_variables($output);

    // copy files if these are listed in template
    if (@$_GET["copy"] == "yes") {
        if ($page_variables["_files"]) {
            foreach ($page_variables["_files"] as $key => $var) {
                if (file_exists($htmlwarrior->config["code_path"] . "/" . $var) && !file_exists($htmlwarrior->config["basepath"] . "/" . $htmlwarrior->runtime["site_dir"] . "/" . $var)) {
                    if (copy($htmlwarrior->config["code_path"] . "/" . $var, $htmlwarrior->config["basepath"] . "/" . $htmlwarrior->runtime["site_dir"] . "/" . $var)) {
                        echo "done copying $var";
                    }
                }
            }
        }
        if ($page_variables["stylefile"]) {
            // todo?
        }
        // get help if exists? todo
    }

    $a_output = explode("\n", $output);
    $first_line = true;
    foreach ($a_output as $key => $var) {
        if (!$first_line || $params["fullindent"]) {
            $a_output[$key] = $params["indent"] . $var;
        } else {
            $first_line = false;
            $a_output[$key] = $var;
        }
    }
    // fix: remove lines with only spaces
    $a_outputFinal = array();
    foreach ($a_output as $key => $var) {
        if (trim($var) != "") {
            $a_outputFinal[$key] = $var;
        }
    }

    $s_outputFinal = implode("\n", $a_outputFinal);
    // write placeholders with script tag so they don't mess up the docs
    // validity
    if ($htmlwarrior->config["show_partial_edit_links"] && $params["tpl"] != "script") {
        $s_outputFinal = trim($s_outputFinal);
        if (strlen($s_outputFinal)) {
            if (!isset($smarty->partial_index)) {
                $smarty->partial_index = 1;
            } else {
                $smarty->partial_index++;
            }

            $placeholder_params_begin = 'id="' . $htmlwarrior->config["htmlwarrior_prefix"] . '_placeholder_begin__' . $smarty->partial_index . '"';
            $placeholder_params_end = 'id="' . $htmlwarrior->config["htmlwarrior_prefix"] . '_placeholder_end__' . $smarty->partial_index . '"';
            if (get_first_tag_name($s_outputFinal) == "li") {
                $s_outputFinal = '<li ' . $placeholder_params_begin . ' style="display:none"><script type="text/javascript">htmlwarrior_partial_edit_links[' . $smarty->partial_index .
                        ']={"name":"' . $params["tpl"] . '", "path_edit":"' . mk_partial_edit_link($params["tpl"] . ".tpl") . '"}</script></li>' .
                        $s_outputFinal .
                        '<li ' . $placeholder_params_end . ' style="display:none"></li>';
            } else {
                $s_outputFinal = '
                    <script type="text/javascript" ' . $placeholder_params_begin .
                        '>htmlwarrior_partial_edit_links[' . $smarty->partial_index .
                        ']={"name":"' . $params["tpl"] . '", "path_edit":"' . mk_partial_edit_link($params["tpl"] . ".tpl") . '"}</script>' .
                        $s_outputFinal .
                        '<script type="text/javascript" ' . $placeholder_params_end .
                        '></script>';
            }
        }
    }
    return $s_outputFinal;
}