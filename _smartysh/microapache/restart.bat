@echo off
REM RESTart.BAT - MicroApache - http://microapache.amadis.sytes.net
ECHO Stopping MicroApache ...
REM Abruptly kill the MicroApache process
REM Use KILLPROC.EXE /? for more information
killproc.exe mapache.exe -all
REM ApacheKill.exe is now available which terminates mapache.exe process by default

REM Restart the server
ECHO Restarting MicroApache ...
ECHO Press CTRL+C or use a process-killer to stop the server
REM Win2k/XP synax
start /min "MicroApache Webserver" mapache.exe -w
