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

function smarty_function_partial($params, &$smarty) {
    global $smarty, $config;

    $site_dir = explode("/", $smarty->template_dir);
    $site_dir = $site_dir[0];

    if (isset($params["tpl"])) {
        $params["template"] = $params["tpl"];
    } elseif (isset($params["name"])) {
        $params["template"] = $params["name"];
    }

    foreach ($params as $key => $var) {
        if ($key != "template") {
            $smarty->assign($key, $var);
        }
    }

    if ($params["showcss"]) {
        echo '<script type="text/javascript" src="http://www.google.com/jsapi"></script>';
        echo '<script type="text/javascript" src="' . $config["path_code"] . '/core/js/general.js"></script>';
        echo '<script type="text/javascript">var partialName = "' . $params["template"] . '";</script>';
        echo '<script type="text/javascript" src="' . $config["path_code"] . '/core/js/showcss.js"></script>';
    }

    // copy template from code to site if template does not exist
    if (!file_exists($smarty->template_dir . "/partials/" . $params["template"] . ".tpl")) {
        echo '<div style="background: red">Templatet ei ole olemas. Kopeerin uue?. <a href="?copy=yes">jah</a></div>';
        if (@$_GET["copy"] == "yes") {
            if (copy($config["code_path"] . "/templates/partials/" . $params["template"] . ".tpl", $smarty->template_dir . "/partials/" . $params["template"] . ".tpl")) {
                echo "done";
            } else {
                echo $config["code_path"] . "/templates/partials/" . $params["template"] . ".tpl does not exist!";
            }
        }
    }
    $output = $smarty->fetch("partials/" . $params["template"] . ".tpl");

    $page_variables = parse_variables($output);
    $output = remove_variables($output);

    // copy files if these are listed in template
    if (@$_GET["copy"] == "yes") {
        if ($page_variables["_files"]) {
            foreach ($page_variables["_files"] as $key => $var) {
                if (file_exists($config["code_path"] . "/" . $var) && !file_exists($config["basepath"] . "/" . $site_dir . "/" . $var)) {
                    if (copy($config["code_path"] . "/" . $var, $config["basepath"] . "/" . $site_dir . "/" . $var)) {
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

    // reset vars
    foreach ($params as $key => $var) {
        if ($key != "template" && $key != "indent") {
            $smarty->clearAssign($key);
        }
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
    if ($config["show_partial_edit_links"] && $params["template"] != "script") {
        $s_outputFinal = trim($s_outputFinal);
        if (strlen($s_outputFinal)) {
            if (!isset($smarty->partial_index)) {
                $smarty->partial_index = 1;
            } else {
                $smarty->partial_index++;
            }

            $placeholder_params_begin = 'id="' . $config["smartysh_prefix"] . '_placeholder_begin__' . $smarty->partial_index . '"';
            $placeholder_params_end = 'id="' . $config["smartysh_prefix"] . '_placeholder_end__' . $smarty->partial_index . '"';
            if (get_first_tag_name($s_outputFinal) == "li") {
                $s_outputFinal = '<li ' . $placeholder_params_begin . ' style="display:none"><script type="text/javascript">smartysh_partial_edit_links[' . $smarty->partial_index .
                        ']={"name":"' . $params["template"] . '", "path_edit":"' . mk_partial_edit_link($params["template"] . ".tpl") . '"}</script></li>' .
                        $s_outputFinal .
                        '<li ' . $placeholder_params_end . ' style="display:none"></li>';
            } else {
                $s_outputFinal = '
                    <script type="text/javascript" ' . $placeholder_params_begin .
                        '>smartysh_partial_edit_links[' . $smarty->partial_index .
                        ']={"name":"' . $params["template"] . '", "path_edit":"' . mk_partial_edit_link($params["template"] . ".tpl") . '"}</script>' .
                        $s_outputFinal .
                        '<script type="text/javascript" ' . $placeholder_params_end .
                        '></script>';
            }
        }
    }
    return $s_outputFinal;
}

?>