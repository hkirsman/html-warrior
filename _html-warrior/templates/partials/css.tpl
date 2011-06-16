{php}
global $smarty;
echo html_css($smarty->tpl_vars["file"]->value, $smarty->tpl_vars["media"]->value);
{/php}