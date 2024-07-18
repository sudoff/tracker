<?php declare(strict_types=1);


namespace Tracker;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RuntimeException;
use Tracker\Tracker\EnvManager;

function writeFile(string $filename, string $content, int $flag = 0): bool
{
    return file_put_contents($filename, $content, $flag) !== false;
}

function isFileAvailable(string $filename): bool
{
    return file_exists($filename) && is_writable($filename);
}

function log(string $message): void
{
    writeFile(INSTALLER_LOG_FILE, $message . PHP_EOL, FILE_APPEND);
}

function divider(string $message = "", bool $postEmpty = false): void
{
    $preDividerLength = $postEmpty ? 6 : 12;
    $postDividerLength = 130;
    if ($message) {
        $message = " {$message} ";
        $postDividerLength -= (strlen($message) + $preDividerLength);
    }
    echo str_repeat("-", $preDividerLength), $message;
    if (!$postEmpty) {
        echo str_repeat("-", $postDividerLength);
    }
    echo PHP_EOL;
    log($message);
}

function line(): void
{
    divider(str_repeat("*", 100));
}

function exitWithError(string $message): void
{
    echo PHP_EOL, PHP_EOL, PHP_EOL, $message, PHP_EOL;
    log($message);

    divider(str_repeat("*", 100));
    exit(1);
}

function removeDirectory(string $dir): void
{
    if (is_dir($dir)) {
        $iterator = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        rmdir($dir);
        divider("Removed directory: {$dir}");
    } else {
        divider("Directory not found: {$dir}", true);
    }
}

function removeFile(string $file): void
{
    if (file_exists($file)) {
        unlink($file);
        divider("Removed file: {$file}");
    } else {
        divider("File not found: {$file}", true);
    }
}

function configureDevMode(): void
{
    $configFile = CONFIG_FLAG_FILE;
    $isDev = getenv('COMPOSER_DEV_MODE');

    divider("Configuring dev mode");
    $configContent = $isDev ? "<?php const DEV_MODE = true;" : "<?php const DEV_MODE = false;";
    if (!writeFile($configFile, $configContent)) {
        exitWithError("Failed to write to configuration file: {$configFile}");
    } else {
        $message = $isDev ? "Development mode config file created: " : "Production mode config file set: ";
        $message .= $configFile;
        divider($message, true);
    }
}

function createDirectories(): void
{
    foreach (DIRECTORIES as $dir) {
        divider("Checking directory: {$dir}", true);
        if (!file_exists($dir)) {
            if (!mkdir($dir, 0755, true)) {
                divider("Failed to create directory: {$dir}", true);
                continue;
            }
            divider("Created directory: {$dir}", true);
        } else {
            divider("Directory already exists: {$dir}", true);
        }
    }
}

/**
 * @param array<string, string> $arguments
 * @return void
 */
function setRemoteConfig(array $arguments = []): void
{
    if (empty($arguments)) {
        divider("Empty remote configuration, use default values");
        return;
    }

    try {
        $envFile = ENV_FILE;
        EnvManager::setup(ENV_FILE, $arguments);
        divider("{$envFile} file updated successfully.");
    } catch (RuntimeException $e) {
        exitWithError($e->getMessage());
    }
}

function configureRemote()
{
    $envFile = ENV_FILE;
    if (!isFileAvailable($envFile)) {
        divider("Configuring remote settings...");

        $setupOptions = [
            CONFIG_SECTION_REMOTE_HOST => 'localhost',
            CONFIG_SECTION_REMOTE_PORT => 1088,
        ];

        setRemoteConfig($setupOptions);
    }
}

function configureEnvironment(): void
{
    configureDevMode();
    configureRemote();
}

function install(): void
{
    createDirectories();
    configureEnvironment();
}

function reInstall(): void
{
    removeDirectory(RUNTIME_PATH);
    removeFile(CONFIG_FLAG_FILE);
    removeFile(ENV_FILE);
}

function parseArguments(): array
{
    $options = getopt("s:h:u:p:d", [
        "driver",
        "host:",
        "user:",
        "pass:",
        "database:",
        "install-dev",
        "install-prod"
    ]);
    $actions = [
        'install-dev' => isset($options['install-dev']),
        'install-prod' => isset($options['install-prod']),
    ];

    $remoteConfig = [
        CONFIG_SECTION_REMOTE_HOST => $options['h'] ?? $options['host'] ?? 'localhost',
        CONFIG_SECTION_REMOTE_PORT => $options['p'] ?? $options['port'] ?? '1088',
    ];

    return [$actions, $remoteConfig];
}