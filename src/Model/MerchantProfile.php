<?php


namespace Nocks\SDK\Model;

/**
 * Class MerchantProfile
 *
 * @method string getUuid()
 * @method string getName()
 * @method Date getCreatedAt()
 * @method Date getUpdatedAt()
 *
 * @method void setName(string $name)
 *
 * @package Nocks\SDK\Model
 */
class MerchantProfile extends Model {

	/**
	 * @return bool
	 */
	public function isActive() {
		return (bool) $this->is_active;
	}
}