<?php
/*
  We add 2 codes to make favicon work: first for IE and second for all the other browsers.
  This is tested on IE7-IE9, FF8, Chrome 15.0.874.121 m


  http://en.wikipedia.org/wiki/ICO_%28file_format%29
  For IE, the official IANA-registered MIME type for .ICO files is image/vnd.microsoft.icon.

  When using the .ICO format for (X)HTML img elements, Internet Explorer versions 6 - 9b2
  cannot display files served with the correct MIME type. A workaround is to use
  the non-standard “image/x-icon” MIME type.
*/

$site_header = <<<EOF
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link rel="icon" href="favicon.png" type="image/png" />
EOF;

$site_footer = '';