<?php

namespace Core;

class Response
{
	private $status_code;
	private $data;
	private $error;

	public function getStatusCode(): int
	{
		return $this->status_code;
	}

	public function setStatusCode(int $status_code): void
	{
		$this->status_code = $status_code;
	}

	public function getJsonMessage(): string
	{
		header('Content-Type: application/json');
		return json_encode($this->getMessage());
	}

	public function setData($data): void
	{
		$this->data = $data;
	}

	public function setError($error): void
	{
		$this->error = $error;
	}

	private function hasError(): bool
	{
		return $this->error != null;
	}

	private function getMessage(): array
	{
		if ($this->hasError()) {
			return ['error' => $this->error];
		}
		return ['data' => $this->data];
	}
}