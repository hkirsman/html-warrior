<?php

/**
 * Smarty plugin to generate correct url with lang variable
 * Also tries to nicify url: add slash before path and remove it from the end.
 * 
 * @package Smarty
 * @subpackage PluginsBlock
 * @author Hannes Kirsman
 */

/**
 * Smarty {geturl}{/geturl} block plugin
 * 
 * @param string $content contents of the block
 * @param object $template template object
 * @param boolean $ &$repeat repeat flag
 * @return string content re-formatted
 */
function smarty_block_geturl($params, $content, $template, &$repeat) {
    if (!$repeat) {
        global $htmlwarrior;

        $out = "";
        $content = '/' . trim($content, '/');

        if ($htmlwarrior->config['multilingual']) {
            $lang_current = '/' . $htmlwarrior->runtime['lang_current'];

            if ($content == "/") {
                $out = $lang_current;
            } else {
                $out = $lang_current . $content;
            }
        } else {
            $out = $content;
        }
    }

    return $out;
}