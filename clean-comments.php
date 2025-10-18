<?php
declare(strict_types=1);

$root = __DIR__;
$targets = [
    $root . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views',
    $root . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'js',
    $root . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'css',
    $root . DIRECTORY_SEPARATOR . 'app',
    $root . DIRECTORY_SEPARATOR . 'routes',
];

$ignoreDirs = [
    'vendor',
    'node_modules',
    'storage',
    'bootstrap' . DIRECTORY_SEPARATOR . 'cache',
    'public' . DIRECTORY_SEPARATOR . 'vendor',
];

$extensions = ['blade.php', 'php', 'js', 'css', 'html'];

$dryRun = in_array('--dry-run', $argv, true);
$noBackup = in_array('--no-backup', $argv, true);

function shouldIgnore(string $path, array $ignoreDirs): bool {
    foreach ($ignoreDirs as $ignore) {
        if (strpos($path, DIRECTORY_SEPARATOR . $ignore) !== false) {
            return true;
        }
    }
    return false;
}

function cleanContent(string $content, string $ext): string {
    if ($ext === 'blade.php' || $ext === 'html') {
        $content = preg_replace('/<!--.*?-->/s', '', $content);
    }
    if ($ext === 'blade.php') {
        $content = preg_replace('/\{\{\-\-.*?\-\-\}\}/s', '', $content);
    }
    if ($ext === 'php' || $ext === 'blade.php' || $ext === 'js' || $ext === 'css') {
        $content = preg_replace('/\/\*.*?\*\//s', '', $content);
        $content = preg_replace('/(^|\s)\/\/.*$/m', '$1', $content);
    }
    $content = preg_replace("/\n{3,}/", "\n\n", $content);
    return $content;
}

function processPath(string $path, array $extensions, array $ignoreDirs, bool $dryRun, bool $noBackup): void {
    if (!is_dir($path)) return;

    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
    foreach ($iterator as $fileInfo) {
        if (!$fileInfo->isFile()) continue;

        $filePath = $fileInfo->getPathname();
        if (shouldIgnore($filePath, $ignoreDirs)) continue;

        $basename = $fileInfo->getBasename();
        $isBlade = substr($basename, -10) === 'blade.php';
        $matchExt = $isBlade ? 'blade.php' : $fileInfo->getExtension();

        if (!in_array($matchExt, $extensions, true)) continue;

        $original = file_get_contents($filePath);
        $cleaned = cleanContent($original, $matchExt);

        if ($original === $cleaned) {
            echo "[skip] $filePath (no changes)\n";
            continue;
        }

        if ($dryRun) {
            $diffChars = strlen($original) - strlen($cleaned);
            echo "[dry-run] $filePath - removed ~{$diffChars} chars\n";
            continue;
        }

        if (!$noBackup) {
            @copy($filePath, $filePath . '.bak');
        }

        file_put_contents($filePath, $cleaned);
        echo "[cleaned] $filePath\n";
    }
}

foreach ($targets as $t) {
    processPath($t, $extensions, $ignoreDirs, $dryRun, $noBackup);
}

echo "Done.\n";