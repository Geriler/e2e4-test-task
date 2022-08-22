<?php

namespace Core;

class Route
{
	private string $route;
	private string $controller;
	private string $action;
	private ?string $name;
	private array $methods;

	public function getRoute(): string
	{
		return $this->route;
	}

	public function getController(): string
	{
		return $this->controller;
	}

	public function getAction(): string
	{
		return $this->action;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function getMethods(): array
	{
		return $this->methods;
	}

	private function __construct(string $route, string $controller, string $action, array $methods, string $name = null)
	{
		$this->route = $route;
		$this->controller = $controller;
		$this->action = $action;
		$this->methods = $methods;
		$this->name = $name;
	}

	private static function add(string $route, string $controller, string $action, array $methods, string $name = null): self
	{
		$newRoute = new self("~^$route$~i", $controller, $action, $methods, $name);
		Router::add($newRoute);
		return $newRoute;
	}

	public static function get(string $route, string $controller, string $action, string $name = null): self
	{
		return self::add($route, $controller, $action, ['GET', 'HEAD'], $name);
	}

	public static function post(string $route, string $controller, string $action, string $name = null): self
	{
		return self::add($route, $controller, $action, ['POST'], $name);
	}
}