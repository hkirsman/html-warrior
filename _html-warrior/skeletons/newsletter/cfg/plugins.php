<?php
if(isset($page_variables["hasLeftCol"]))
	$smarty->assign("hasLeftCol", $page_variables["hasLeftCol"]);
else
	$smarty->assign("hasLeftCol", "");

if(isset($page_variables["hasRightCol"]))
	$smarty->assign("hasRightCol", $page_variables["hasRightCol"]);
else
	$smarty->assign("hasRightCol", "");

if(isset($page_variables["isSubpage"]))
	$smarty->assign("isSubpage", $page_variables["isSubpage"]);
else
	$smarty->assign("isSubpage", "");

if(isset($page_variables["title2"]))
	$smarty->assign("title2", $page_variables["title2"]);
else
	$smarty->assign("title2", "");

if(isset($page_variables["yah"])) {
	$smarty->assign("yah", explode(";", $page_variables["yah"]));
} else
	$smarty->assign("yah", "");


$plugin = array();
#$plugin[] = "supersleight";
$plugin[] = "jquery";
#$plugin[] = "jquery.fancybox";
#$plugin[] = "jquery.hrzAccordion";
#$plugin[] = "jquery.jcarousel";
#$plugin[] = "jquery.nivo.slider";
#$plugin[] = "jquery.swfupload";
$plugin[] = "favicon";



?>