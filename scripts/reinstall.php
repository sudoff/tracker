<?php declare(strict_types=1);

namespace Tracker;

require_once __DIR__ . "/.." . "/vendor/autoload.php";

line();
divider("*** Starting reinstall ***");

reInstall();
install();

divider("*** Completed reinstall ***");
line();