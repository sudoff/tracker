@echo off

rem -------------------------------------------------------------
rem  PHPStan command line bootstrap script for Windows.
rem
rem  This script sets up the environment and runs PHPStan.
rem -------------------------------------------------------------

@setlocal

set PHPSTAN_PATH=%~dp0

if "%PHP_COMMAND%" == "" set PHP_COMMAND=php.exe

"%PHP_COMMAND%" -d memory_limit=2G "%PHPSTAN_PATH%vendor\bin\phpstan" analyse -c "%PHPSTAN_PATH%phpstan.neon" %*

@endlocal
