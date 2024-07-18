#!/usr/bin/env php
<?php
/**
 * PHPStan console bootstrap file.
 *
 * This script sets up the environment and runs PHPStan.
 */

// Define the configuration PHPStan
$phpStanConfig = __DIR__ . '/phpstan.neon';

// Define the path to PHPStan
$phpStanPath = __DIR__ . '/vendor/bin/phpstan';

// Define the command to execute
$command = escapeshellcmd($phpStanPath . ' analyse -c ' . $phpStanConfig . ' ' . implode(' ', array_slice($argv, 1)));

// Execute the command
passthru($command, $exitCode);

// Terminate the script execution with a return code
exit($exitCode);
