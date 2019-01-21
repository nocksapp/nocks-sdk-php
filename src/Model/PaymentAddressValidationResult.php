<?php


namespace Nocks\SDK\Model;


/**
 * Class PaymentAddressValidationResult
 *
 * @package Nocks\SDK\Model
 */
class PaymentAddressValidationResult extends Model {

	/**
	 * Check if a address is valid
	 *
	 * @param $address
	 *
	 * @return bool
	 */
	public function isValid($address) {
		return !!$this->{$address};
	}

	/**
	 * Check if all addresses are valid
	 *
	 * @return bool
	 */
	public function areAllValid() {
		return count(array_filter($this->getData())) === count($this->getData());
	}
}
