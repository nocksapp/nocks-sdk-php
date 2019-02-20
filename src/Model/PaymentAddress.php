<?php


namespace Nocks\SDK\Model;


/**
 * Class Address
 *
 * @method void setCurrency(string $currency)
 * @method void setAddress(string $address)
 *
 * @method string getCurrency()
 * @method string getAddress()
 *
 * @package Nocks\SDK\Model
 */
class PaymentAddress extends Model {

	/**
	 * Check if valid
	 *
	 * @return bool
	 */
	public function isValid() {
		return (bool) $this->validation;
	}
}
