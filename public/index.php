<?php

use Core\App;

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../app/routes.php';

$app = App::getInstance();
$response = $app->run();
http_response_code($response->getStatusCode());
echo $response->getJsonMessage();
