<?php

# to add more variables to page templates ( like @title )
# add these here
if (isset($page_variables["title2"]))
    $smarty->assign("title2", $page_variables["title2"]);
else
    $smarty->assign("title2", "");

#$plugin = array();
#$plugin[] = "supersleight";
$plugin[] = "jquery";
#$plugin[] = "jquery.fancybox";
#$plugin[] = "jquery.hrzAccordion";
#$plugin[] = "jquery.jcarousel";
#$plugin[] = "jquery.nivo.slider";
#$plugin[] = "jquery.swfupload";
#$plugin[] = "favicon";