<?php

namespace App\Models;

use Core\BaseModel;
use Core\Database;

class ExchangeRate extends BaseModel
{
	protected string $table = 'exchange_rates';

	public $id;
	public $value;
	public $date;
	public $currency_id;

	public function save(): bool|int|string
	{
		$db = Database::getInstance();
		if ($this->id != null) {
			$db->query("UPDATE {$this->table} SET `value` = '{$this->value}', `date` = '{$this->date}', `currency_id` = '{$this->currency_id}' WHERE `id` = '{$this->id}'", self::class);
			return $this->id;
		} else {
			$db->query("INSERT INTO {$this->table} (value, date, currency_id) VALUES ('{$this->value}', '{$this->date}', '{$this->currency_id}')", self::class);
			return $db->getLastId();
		}
	}
}
