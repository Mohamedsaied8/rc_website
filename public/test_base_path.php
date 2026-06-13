<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
var_dump($app->basePath());
var_dump($app->environmentFilePath());
var_dump(env('APP_KEY'));
var_dump($app->getCachedConfigPath());

