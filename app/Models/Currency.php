<?php

namespace App\Models;

use Core\BaseModel;
use Core\Database;

class Currency extends BaseModel
{
	protected string $table = 'currencies';

	public $id;
	public $name;
	public $code;
	public $nominal;

	public function save(): bool|int|string
	{
		$db = Database::getInstance();
		if ($this->id != null) {
			$db->query("UPDATE {$this->table} SET `name` = '{$this->name}', `code` = '{$this->code}', `nominal` = '{$this->nominal}' WHERE `id` = '{$this->id}'", self::class);
			return $this->id;
		} else {
			$db->query("INSERT INTO {$this->table} (name, code, nominal) VALUES ('{$this->name}', '{$this->code}', '{$this->nominal}')", self::class);
			return $db->getLastId();
		}
	}
}