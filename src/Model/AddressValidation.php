<?php


namespace Nocks\SDK\Model;


/**
 * Class AddressValidation
 *
 * @method void setCurrency(string $currency)
 * @method void setAddress(string $address)
 *
 * @package Nocks\SDK\Model
 */
class AddressValidation extends Model {

	/**
	 * Check if valid
	 *
	 * @return bool
	 */
	public function isValid() {
		return (bool) $this->validation;
	}
}
