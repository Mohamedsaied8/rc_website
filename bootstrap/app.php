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
        // Trust the reverse proxy (nginx / load balancer) so HTTPS scheme and
        // client IP are detected correctly behind it.
        $middleware->trustProxies(at: '*', headers:
            \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR |
            \Illuminate\Http\Request::HEADER_X_FORWARDED_HOST |
            \Illuminate\Http\Request::HEADER_X_FORWARDED_PORT |
            \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO
        );

        $middleware->redirectGuestsTo(function (\Illuminate\Http\Request $request) {
            if ($request->is('admin*')) {
                return route('admin.login');
            }
            return route('login');
        });

        // Paymob posts the payment result server-to-server; it can't carry a CSRF token.
        // It is authenticated instead via HMAC signature verification in PaymentController.
        $middleware->validateCsrfTokens(except: [
            'payment/callback',
        ]);

        // SSO: bridge the shared Supabase session cookie into Laravel's web guard
        // on every web request. Appended so it runs after the session is started.
        $middleware->web(append: [
            \App\Http\Middleware\SupabaseAuth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

if (isset($_SERVER['VERCEL']) || isset($_ENV['VERCEL'])) {
    $app->useStoragePath('/tmp/storage');
}

return $app;
