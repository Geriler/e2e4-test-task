<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->usePutenv()->loadEnv(__DIR__ . '/.env');
