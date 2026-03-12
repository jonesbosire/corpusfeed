<?php
/**
 * Laravel cache-clear helper
 * Access: https://corpusfeed.co.ke/clear-cache.php?key=cfl2025clear
 */

define('SECRET', 'cfl2025clear');

if (($_GET['key'] ?? '') !== SECRET) {
    http_response_code(403);
    die('403 Forbidden. Add ?key=cfl2025clear to the URL.');
}

$base = __DIR__ . '/..';

$results = [];

// 1. Config cache
$configCache = $base . '/bootstrap/cache/config.php';
if (file_exists($configCache)) {
    $results['config:clear'] = @unlink($configCache) ? '✓' : '✗ (permission error)';
} else {
    $results['config:clear'] = '✓ (already clear)';
}

// 2. Route cache
$routeCache = $base . '/bootstrap/cache/routes-v7.php';
if (!file_exists($routeCache)) {
    $routeCache = $base . '/bootstrap/cache/routes.php';
}
if (file_exists($routeCache)) {
    $results['route:clear'] = @unlink($routeCache) ? '✓' : '✗ (permission error)';
} else {
    $results['route:clear'] = '✓ (already clear)';
}

// 3. Events cache
$eventsCache = $base . '/bootstrap/cache/events.php';
if (file_exists($eventsCache)) {
    $results['event:clear'] = @unlink($eventsCache) ? '✓' : '✗ (permission error)';
} else {
    $results['event:clear'] = '✓ (already clear)';
}

// 4. View cache (compiled blade files)
$viewDir = $base . '/storage/framework/views/';
$viewFiles = glob($viewDir . '*.php') ?: [];
$viewCount = 0;
foreach ($viewFiles as $f) {
    if (@unlink($f)) $viewCount++;
}
$results['view:clear'] = '✓ (' . $viewCount . ' files removed)';

// 5. Application cache (file driver)
$cacheDir = $base . '/storage/framework/cache/data/';
$cacheCount = 0;
if (is_dir($cacheDir)) {
    $iter = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($cacheDir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );
    foreach ($iter as $f) {
        if ($f->isFile() && @unlink($f->getRealPath())) $cacheCount++;
    }
}
$results['cache:clear'] = '✓ (' . $cacheCount . ' files removed)';

// 6. Sessions (optional — clears all user sessions)
if (isset($_GET['sessions'])) {
    $sessionDir = $base . '/storage/framework/sessions/';
    $sessionCount = 0;
    foreach (glob($sessionDir . '*') ?: [] as $f) {
        if (is_file($f) && @unlink($f)) $sessionCount++;
    }
    $results['session:clear'] = '✓ (' . $sessionCount . ' sessions removed)';
}

echo '<pre style="font-family:monospace;font-size:14px;padding:20px;background:#111;color:#0f0;">';
echo "CorpusFeed — Laravel Cache Clear\n";
echo str_repeat('─', 40) . "\n\n";

foreach ($results as $cmd => $status) {
    echo $status . "  php artisan $cmd\n";
}

echo "\n" . str_repeat('─', 40) . "\n";
echo "Done at " . date('Y-m-d H:i:s') . " (UTC)\n";
echo '</pre>';
