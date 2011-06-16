<?php
/**
 * Smarty plugin to execute WIKI code
 * 
 * @package Smarty
 * @subpackage PluginsBlock
 * @author Hannes Kirsman
 */

/**
 * Smarty {wiki}{/wiki} block plugin
 * 
 * @param string $content contents of the block
 * @param object $template template object
 * @param boolean $ &$repeat repeat flag
 * @return string content re-formatted
 */
function smarty_block_wiki($params, $content, $template, &$repeat)
{ 
	global $smarty, $config_q;

	require_once($config_q["code_path"]."/externals/wiki2html_machine/parseRaw.inc.php");
	return simpleText($content);

}

?>