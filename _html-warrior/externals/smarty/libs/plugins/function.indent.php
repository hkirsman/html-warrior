<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.indent.php
 * Type:     function
 * Name:     partial
 * Purpose:  include partial and assing parameters
 * -------------------------------------------------------------
 */
function smarty_function_indent($params, &$smarty)
{
		global $smarty, $config_q;

		$site_dir = explode("/", $smarty->template_dir);
		$site_dir = $site_dir[0];

		if ( isset($params["tpl"]) ) { 
			$params["template"] = $params["tpl"];
		}

		$a_output = explode("\n", $params["str"]);
		$first_line = true;
		foreach($a_output as $key=>$var) {
			$var = trim($var);
			if(!$first_line) {
				$a_output[$key] = $params["indent"].$var;
			} else { 
				$first_line = false;
				$a_output[$key] = $var;
			}
		}
		// fix: remove lines with only spaces
/*		$a_outputFinal = array();
		foreach($a_output as $key=>$var) { 
			if ( trim($var) != "" ) { 
				$a_outputFinal[$key] = $var;
			}
		}
		*/
		return implode("\n", $a_output);
}
?>