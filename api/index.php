<?php

/**
 * Vercel Serverless Entry Point
 * 
 * Vercel requires this file to serve PHP requests.
 * We also redirect some writable paths to /tmp since Vercel's filesystem is read-only.
 */

// Override storage paths for read-only Vercel environment
$_ENV['VIEW_COMPILED_PATH'] = '/tmp';
$_ENV['APP_CONFIG_CACHE'] = '/tmp/config.php';
$_ENV['APP_EVENTS_CACHE'] = '/tmp/events.php';
$_ENV['APP_PACKAGES_CACHE'] = '/tmp/packages.php';
$_ENV['APP_ROUTES_CACHE'] = '/tmp/routes.php';
$_ENV['APP_SERVICES_CACHE'] = '/tmp/services.php';

require __DIR__ . '/../public/index.php';
