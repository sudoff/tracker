@echo off

@setlocal

set TRACKER_PATH=%~dp0

if "%PHP_COMMAND%" == "" set PHP_COMMAND=php.exe

"%PHP_COMMAND%" -d memory_limit=1G "%TRACKER_PATH%tracker" %*

@endlocal
