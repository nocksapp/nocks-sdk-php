<?php


namespace Nocks\SDK\Model;

/**
 * Class FundingSource
 *
 * @method string getUuid()
 * @method string getAddress()
 * @method array getMetadata()
 * @method string getType()
 * @method string getHolder()
 * @method string getLabel()
 * @method string getCurrency()
 * @method Date getCreatedAt()
 * @method Date getUpdatedAt()
 * @method Date getActiveAt()
 * @method string getResource()
 *
 * @method void setNumber(string $number)
 * @method void setMethod(PaymentMethod $method)
 * @method void setMetadata(string $metadata)
 *
 * @package Nocks\SDK\Model
 */
class FundingSource extends Model {

	/**
	 * @return bool
	 */
	public function isActive() {
		return boolval($this->is_active);
	}

	/**
	 * @return bool
	 */
	public function isVerified() {
		return boolval($this->is_verified);
	}
}