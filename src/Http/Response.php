<?php


namespace Nocks\SDK\Http;


class Response implements ResponseInterface {

	private $statusCode;
	private $body;

	public function __construct($statusCode, $body) {
		$this->statusCode = $statusCode;
		$this->body = $body;
	}

	/**
	 * Get the response status code
	 *
	 * @return integer
	 */
	public function getStatusCode() {
		return $this->statusCode;
	}

	/**
	 * Get the response body
	 *
	 * @return array
	 */
	public function getBody() {
		return json_decode($this->body, true);
	}

	/**
	 * Check if the response was successful
	 *
	 * @return bool
	 */
	public function isSuccessful() {
		return $this->statusCode >= 200 && $this->statusCode < 300;
	}
}