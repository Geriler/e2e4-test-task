<?php

namespace Core;

class App
{
	private static $instance;

	private function __construct()
	{
	}

	public static function getInstance(): self
	{
		if (self::$instance == null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function run(): Response
	{
		$current_url = parse_url($_SERVER['REQUEST_URI'])['path'];
		$router = Router::getInstance();
		$route = $router->match($current_url);
		if ($route != null) {
			if (!in_array($_SERVER['REQUEST_METHOD'], $route->getMethods())) {
				$response = new Response();
				$response->setStatusCode(400);
				$response->setError("This route doesn't support {$_SERVER['REQUEST_METHOD']}. Use " . implode('/', $route->getMethods()));
				return $response;
			}
			$class = $route->getController();
			$action = $route->getAction();
			$controller = new $class;
			return $controller->$action();
		} else {
			$response = new Response();
			$response->setStatusCode(404);
			$response->setError("Route '$current_url' not found");
			return $response;
		}
	}
}