<?php


namespace Nocks\SDK\Exception;


class HttpException extends Exception {

	private $statusCode;
	private $type;

	public function __construct($message, $statusCode, $type) {
		$this->statusCode = $statusCode;
		$this->type = $type;

		parent::__construct($message);
	}

	public function getStatusCode() {
		return $this->statusCode;
	}

	public function getType() {
		return $this->type;
	}
}