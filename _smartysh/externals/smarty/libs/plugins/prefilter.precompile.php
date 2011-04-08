<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     prefilter.precompile.php
 * Type:     prefilter
 * Name:     precompile
 * Purpose:  Foo
 * -------------------------------------------------------------
 */
 function smarty_prefilter_pre01($source, &$smarty)
 {
		print_r($source);
		die();
     return preg_replace('!<(\w+)[^>]+>!e', 'strtolower("$1")', $source);
 }
?>