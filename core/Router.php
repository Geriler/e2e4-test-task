<?php

namespace Core;

class Router
{
	private static $instance;
	private static $routes;

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

	public static function add(Route $route)
	{
		self::$routes[] = $route;
	}

	public function match($url): ?Route
	{
		$isFoundRoute = false;
		foreach (self::$routes as $route) {
			preg_match($route->getRoute(), $url, $matches);
			if (!empty($matches)) {
				$isFoundRoute = true;
				break;
			}
		}
		return $isFoundRoute ? $route : null;
	}
}
