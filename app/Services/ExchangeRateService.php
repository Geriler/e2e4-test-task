<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\ExchangeRate;
use Core\Database;

class ExchangeRateService
{
	private static string $url = 'https://www.cbr.ru/scripts/XML_daily.asp';

	public static function getByDate(string $date)
	{
		$db = Database::getInstance();
		$result = $db->query('SELECT er.value, er.date, c.code, c.name, c.nominal FROM exchange_rates er INNER JOIN currencies c on c.id = er.currency_id WHERE date = \''. $date . '\'');
		if (empty($result)) {
			$xml = simplexml_load_string(file_get_contents(self::$url . "?date_req=$date"));
			$db = Database::getInstance();
			$currencies = $db->query('SELECT * FROM currencies', Currency::class);
			foreach ($xml->Valute as $item) {
				$findCurrency = false;
				/** @var Currency $currency */
				foreach ($currencies as $currency) {
					if ($currency->code == $item->CharCode) {
						$findCurrency = true;
						$currencyId = $currency->id;
						break;
					}
				}
				if (!$findCurrency) {
					$currency = new Currency();
					$currency->name = $item->Name;
					$currency->code = $item->CharCode;
					$currency->nominal = $item->Nominal;
					$currencyId = $currency->save();
				}
				$exchangeRate = new ExchangeRate();
				$exchangeRate->value = str_replace(',', '.', $item->Value);
				$exchangeRate->date = $date;
				$exchangeRate->currency_id = $currencyId;
				$exchangeRate->save();

				$object = new \stdClass();
				$object->value = $exchangeRate->value;
				$object->date = $exchangeRate->date;
				$object->name = $currency->name;
				$object->code = $currency->code;
				$object->nominal = $currency->nominal;
				$result[] = $object;
			}
		}
		return $result;
	}
}
