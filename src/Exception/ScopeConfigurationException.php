<?php


namespace Nocks\SDK\Exception;


use Throwable;

class ScopeConfigurationException extends Exception {

	public function __construct($requiredProperties, $code = 0, Throwable $previous = null ) {
		$message = 'For this method the following scope properties are required "' . implode(', ', $requiredProperties) . '"';

		parent::__construct($message, $code, $previous);
	}
}