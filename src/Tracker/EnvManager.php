<?php declare(strict_types=1);

namespace Tracker;

use RuntimeException;

class EnvManager
{
    /**
     * Check if the file exists and is accessible, or create it if it does not exist.
     *
     * @param string $filePath
     * @return bool
     */
    protected static function isFileAccessible(string $filePath): bool
    {
        return (file_exists($filePath) && is_readable($filePath)) || file_put_contents($filePath, "#.env config\n") !== false;
    }

    /**
     * Read the .env file and return its content as an associative array.
     *
     * @param string $filePath
     * @return array<string, int|float|string>|null
     */
    protected static function readFile(string $filePath): ?array
    {
        $envContent = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($envContent === false) {
            return null;
        }

        $envData = [];
        foreach ($envContent as $line) {
            if (strpos($line, '=') !== false) {
                [$key, $value] = explode('=', $line, 2);
                $envKey = trim($key);
                if ($envKey[0] !== "#") {
                    $envData[$envKey] = trim($value);
                }
            }
        }

        return $envData;
    }

    /**
     * Update the .env file with the provided associative array.
     *
     * @param string $filePath
     * @param array<string, int|float|string> $envData
     * @return bool
     */
    protected static function updateFile(string $filePath, array $envData): bool
    {
        $newEnvContent = [];
        foreach ($envData as $key => $value) {
            $newEnvContent[] = "$key=$value";
        }
        return file_put_contents($filePath, implode(PHP_EOL, $newEnvContent)) !== false;
    }

    /**
     * Update the .env file with the provided setup variables and definitions.
     *
     * @param string $envFile
     * @param array<string, float|int|string> $setupVariables
     * @param array<string, array<string, int|float|string>> $definition
     * @return void
     */
    public static function setup(string $envFile, array $setupVariables = [], array $definition = []): void
    {
        if (empty($setupVariables)) {
            throw new RuntimeException("Empty setup data.");
        }

        if (!static::isFileAccessible($envFile)) {
            throw new RuntimeException("The {$envFile} file does not exist or is not readable.");
        }

        $envData = static::readFile($envFile);
        if ($envData === null) {
            throw new RuntimeException("Failed to read the {$envFile} file.");
        }

        foreach ($setupVariables as $key => $value) {
            $filteredValue = trim((string)$value);
            if (isset($definition[$key])) {
                $filteredValue = filter_var($filteredValue, FILTER_SANITIZE_STRING, $definition[$key] ?? []);
            }
            if ($filteredValue !== false) {
                $envData[strtoupper($key)] = $filteredValue;
            }
        }

        if (!static::updateFile($envFile, $envData)) {
            throw new RuntimeException("Failed to write to the {$envFile} file.");
        }
    }
}