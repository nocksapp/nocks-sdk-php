<?php


namespace Nocks\SDK\Model;


/**
 * Class AddressValidation
 *
 * @package Nocks\SDK\Model
 */
class AddressValidationResult extends Model {

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
