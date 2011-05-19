======================================
    MicroApache 2.0.64 README.TXT 
           Release Notes
      M Shaw - April 15th 2011
======================================
 http://microapache.kerys.co.uk
=========================================
* SECURITY WARNING - YOU MUST READ THIS *
=========================================

If this variant of Apache is used as a "public-facing" webserver you should
configure it appropriately. This requires a knowledge of Apache and HTTP
server configuration options. This distribution is configured for use on
secure, private home networks only and NOT for internet use. 

If you don't understand how to configure Apache for internet-facing security 
then PLEASE DO NOT USE MICROAPACHE IN THIS CONTEXT!

Please note that you MUST delete cgi-bin/cgitext.exe before making your server
live where it is exposed to others. This app will give away sensitive server
information. Please do not ignore this warning.

Website, GPL Licences and Documentation
=======================================
Website: http://microapache.kerys.co.uk

GPL Licence - See the enclosed gpl-licence.txt file or ZIP file

Source code is unmodified and available from http://www.apache.org

Move and/or delete this file if you wish after reading
Move and/or delete gpl-licence.txt after reading

Apache Org will NOT provide support for MicroApache. DO NOT ask them!

You can find the manual for Apache 2.0.x here:
http://httpd.apache.org/docs/2.0/

Installed Folder Size (Apache 2.0.64/no-PHP)
============================================
515 kb (including 63.1kb of disposable apps in cgi-bin/ )

Net distro size = 451.9kb
                  -------

2.0.63 mod_deflate problems
===========================
(* The 2.0.64 version of mod_deflate appears to be OK - test confirmations welcome *)

Problems were encountered with the 2.0.63 version of mod_deflate.dll (so)
For unknown reasons this would crash with a "failed to read" memory error
in Windows. Experimenting failed to reveal the cause of the problem.

However it was found that the problem does not occur with the 2.0.61 version
of mod_deflate so this has been substituted. It is accepted that this is NOT
an ideal "fix" but due to lack of sufficient information to resolve the issue
in any other way means this is currently the only solution. It is hoped that
the 2.0.64 relase of Apache/Win32 will resolve the problem. The 2.0.61 version
of mod_deflate was tested and appears to work well with Apache 2.0.63

The issue does NOT relate to the following:
(Although it may be due to a combination of some or all of these)
  UPX compression
  Renaming of mod_deflate.so to mod_deflate.dll
  httpd.conf configuration
  Custom logging
  Non-standard file locations

CGI Directory Location
======================
The released config may NOT place /cgi-bin/ at the root of the "server root"
This will be true if there is no ScriptAlias statement defined.
You will require an entry such as this: 

<IfModule mod_cgi.c>
#-- Enable only if CGI is selected
<Directory cgi-bin>
  # Override deny from "."
  AllowOverride None
  Order Deny,Allow
  Allow from All
</Directory>
ScriptAlias /cgi-bin/ "cgi-bin/"
</IfModule>

Note that there MUST be a trailing-slash on "cgi-bin/"

The full-URL is relative to the document-root which is placed at the root of 
your disk drive by default. This is due to MicroApache's intended use in serving
USB sticks and floppy disk drives. The correct path to /cgi-bin/ must include
the full path to your server root. You can change this by either editing
httpd.conf or moving the contents of /cgi-bin/ to the root of your USB stick.
Also, please bear in mind that if using the full URL from the disk root that 
you cannot "drill down-to" your server root via a web browser. 
You must type/link in the URL directly in your browser if ScriptAlias is not defined

CGI Demo Programs (*PLEASE Ensure You Delete CGITEsT.EXE *)
============================================================
You may delete any example app(s) in .\cgi-bin if you wish

asmdemo.exe	Demo assembler CGI output
cgitest.exe     A brief CGI test diagnostic (YOU *MUST* DELETE THIS)
tailcgi.exe     A useful real-time CGI-based log viewer
/css/tail.css   (If included) This is a css file for tailcgi.exe - you may 
                either delete it or move the folder to your document root

Misc Files
==========
The following files *may* be included with your distro...
GO.BAT          Batch file to start the server
STOP.BAT        Batch file to halt the server (and all other copies of it)
RESTART.BAT     Batch file to restart the server (and all other copies of it)
KILLPROC.EXE    Program to kill Win32 processes used by STOP.BAT

Configuration Etc.
==================
This Apache distro was designed specifically to run a complete website from 
a floppy disk or USB stick.

The default webroot is \wwwroot\htdocs (/wwwroot/htdocs) or "\" 
depending on the release version.
Apache uses Unix slash characters for the config (/ rather than \)
Move phpinfo.php (if supplied) to your webroot for testing PHP then delete it

Valid document roots include 
"." (current dir)
"/" (root dir)
x:/path (rooted path)

Due to a bug you cannot configure a rooted path with no drive letter
"/rootdir" is NOT valid in a DocumentRoot or ServerRoot statement

You may delete any modules to reduce the size of the distro but
remember to uncomment any relevant config in httpd.conf

The .\conf\httpd.conf is for EXAMPLE ONLY - tweak to suit your setup

The binaries are unchanged standard Apache distro so please read the
relevant Apache documentation before asking questions!. This distro
is able to provide the complete Apache feature set (with tweaking!)

NOTE: Please pay attention to proper Apache security config before 
making any public server live!

Stopping and Starting the Server
================================
Two batch files may be included with your distro, GO.BAT and STOP.BAT respectively

The meaning of these should be obvious. GO.BAT will launch mapache.exe minimised.
STOP.BAT will use "KILLPROC.EXE" to abruptly terminate the mapache.exe server process
Please note that if you have multiple copies of mapache.running that this batch 
file will kill ALL instances of the program.
Alternatively you may maximise the Apache console and press CTRL+C to terminate
all mapache processes.

PHP - IMPORTANT
===============

This section applies if you have downloaded a copy of MicroApache with PHP bundled
or you intend to install MicroPHP.

*** YOU *MUST* CHECK AND CONFIGURE PHP SECURITY SETTiNGS BEFORE GOING LIVE! ***
*** YOU *SHOULD* REMOVE ALL PHPINFO.PHP FILE(S) BEFORE GOING LIVE! ***

Please note support PHP developers will cease support for PHP 4.x.x 31/12/2007

For mor information go to http://www.php.net

Please note that you need to correctly configure PHP security in PHP.INI!!!

PHP 4.x files...

php4apache2.dll    PHP4 main DLL
php4ts.dll         PHP4 transaction DLL (usually in \WINNT or \WINDOWS)
php.ini            Example config file - please check security settings!

PHP 5.x files...

php5apache2.dll    PHP5 main DLL
php5ts.dll         PHP5 transaction DLL (usually in \WINNT or \WINDOWS)
php.ini            Example config file - please check security settings!

No support provided whatsoever but CONSTRUCTIVE suggestions are welcomed.
If you find MicroApache useful then a simple thank-you email would be
appreciated! :)

EOF --

