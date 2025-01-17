<?php

declare(strict_types=1);

namespace Tracker;

define('BASE_PATH', realpath(dirname(__FILE__)));

const SPACE = 'Tracker';

const VENDOR_PATH = BASE_PATH . DIRECTORY_SEPARATOR . 'vendor';

const RUNTIME_PATH = BASE_PATH . DIRECTORY_SEPARATOR . 'runtime';
const CACHE_PATH   = RUNTIME_PATH . DIRECTORY_SEPARATOR . 'cache';
const LOG_PATH     = RUNTIME_PATH . DIRECTORY_SEPARATOR . 'log';
const TMP_PATH     = RUNTIME_PATH . DIRECTORY_SEPARATOR . 'tmp';

const DIRECTORIES = [
    RUNTIME_PATH,
    CACHE_PATH,
    LOG_PATH,
    TMP_PATH,
];

const CONFIG_FLAG_FILE = BASE_PATH . DIRECTORY_SEPARATOR . 'config.php';
const ENV_FILE         = BASE_PATH . DIRECTORY_SEPARATOR . '.env';

const INSTALLER_LOG_FILE = BASE_PATH . DIRECTORY_SEPARATOR . 'installer.log';
const FLOW_LOG_FILE      = LOG_PATH . DIRECTORY_SEPARATOR . 'flow.log';
const CRITICAL_LOG_FILE  = LOG_PATH . DIRECTORY_SEPARATOR . 'critical.log';

const CONFIG_SECTION_REMOTE      = 'REMOTE';
const CONFIG_SECTION_REMOTE_HOST = SPACE . '_' . CONFIG_SECTION_REMOTE . '_HOST';
const CONFIG_SECTION_REMOTE_PORT = SPACE . '_' . CONFIG_SECTION_REMOTE . '_PORT';
