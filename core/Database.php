<?php

namespace Core;

use PDO;

class Database
{
	private static $instance;
	private PDO $pdo;

	private function __construct()
	{
		$this->pdo = new PDO(
			(getenv('DB_DRIVER') .
				':host=' . getenv('DB_HOST') .
				((!empty(getenv('DB_PORT'))) ? (';port=' . getenv('DB_PORT')) : '') .
				';dbname=' . getenv('DB_NAME')),
			getenv('DB_USERNAME'), getenv('DB_PASSWORD')
		);
	}

	public static function getInstance(): self
	{
		if (self::$instance == null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function query(string $sql, string $className = 'stdClass'): bool|array|null
	{
		$sth = $this->pdo->prepare($sql);
		$result = $sth->execute();
		if ($result === false) return null;
		return $sth->fetchAll(PDO::FETCH_CLASS, $className);
	}

	public function getLastId(): bool|string
	{
		return $this->pdo->lastInsertId();
	}
}
