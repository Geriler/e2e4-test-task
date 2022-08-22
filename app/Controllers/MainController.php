<?php

namespace App\Controllers;

use App\Services\ExchangeRateService;
use Core\Response;
use DateTime;

class MainController
{
	public function getExchangeRate(): Response
	{
		$response = new Response();
		try {
			$date = new DateTime($_REQUEST['date']) ?? new DateTime();
		} catch (\Exception $e) {
			$response->setStatusCode(400);
			$response->setError($e->getMessage());
			return $response;
		}
		$date = $date->format('d/m/Y');
		$result = ExchangeRateService::getByDate($date);
		$response->setStatusCode(200);
		$response->setData($result);
		return $response;
	}
}
