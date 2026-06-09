<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(fn () => route('admin.login'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Throwable $e) {
            echo get_class($e) . ': ' . $e->getMessage() . "\n" . $e->getTraceAsString();
            die();
        });
    })->create();

if (isset($_SERVER['VERCEL']) || isset($_ENV['VERCEL'])) {
    $app->useStoragePath('/tmp/storage');
}

return $app;
