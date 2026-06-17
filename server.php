<?php
/**
 * PHP Built-in Server Router
 *
 * Usage: php -S localhost:8000 server.php
 *
 * This replaces Apache's mod_rewrite (.htaccess) for the built-in server,
 * which doesn't support .htaccess files.
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Serve static files directly (CSS, JS, images, fonts)
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    $extension = pathinfo($uri, PATHINFO_EXTENSION);

    $mimeTypes = [
        'css'  => 'text/css',
        'js'   => 'application/javascript',
        'json' => 'application/json',
        'png'  => 'image/png',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif'  => 'image/gif',
        'svg'  => 'image/svg+xml',
        'ico'  => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2'=> 'font/woff2',
        'ttf'  => 'font/ttf',
        'eot'  => 'application/vnd.ms-fontobject',
        'pdf'  => 'application/pdf',
        'html' => 'text/html',
    ];

    if (isset($mimeTypes[$extension])) {
        header('Content-Type: ' . $mimeTypes[$extension]);
    }

    return false; // Let PHP serve the file directly
}

// Block access to sensitive directories/files
$blocked = ['/application/', '/system/', '/.env', '/.git'];
foreach ($blocked as $path) {
    if (strpos($uri, $path) === 0) {
        http_response_code(403);
        echo '403 Forbidden';
        return true;
    }
}

// Route everything else through index.php (CodeIgniter front controller)
$_SERVER['PATH_INFO'] = $uri;
$_SERVER['SCRIPT_NAME'] = '/index.php';
require __DIR__ . '/index.php';
