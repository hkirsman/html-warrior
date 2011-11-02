<?php

/**
 * Smarty plugin to generate correct url with lang variable
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
        global $htmlwarrior, $urls;

        $out = "";

        if ($htmlwarrior->config['multilingual']) {
            $lang_current = $htmlwarrior->runtime['lang_current'];

            // home - frontpage link is always first element in $urls array
            $home = current($urls);

            if ($content == '/') {
                $out = $home[$lang_current];
            } else {
                $out = $urls[$content][$lang_current]['link'];
            }
        }
        // else. do something?
    }

    return $out;
}