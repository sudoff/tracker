<?php declare(strict_types=1);

namespace Tracker;

require_once __DIR__ . '/..' . '/constants.php';
require_once __DIR__ . '/..' . '/functions.php';

line();
divider("*** Starting uninstall ***");

reInstall();
removeDirectory(VENDOR_PATH);

divider("*** Completed uninstall ***");
line();