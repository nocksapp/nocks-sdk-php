<?php


namespace Nocks\SDK\Model;

/**
 * Class User
 *
 * @method string getUuid()
 * @method string getType()
 * @method string getEmail()
 * @method string getGender()
 * @method string getFirstName()
 * @method string getLastName()
 * @method string getMobile()
 * @method string getLocale()
 * @method Date getCreatedAt()
 * @method Date getUpdatedAt()
 * @method string getResource()
 *
 * @method void setUuid(string $uuid)
 * @method void setGender(string $gender)
 * @method void setFirstName(string $firstName)
 * @method void setLastName(string $lastName)
 * @method void setLocale(string $locale)
 * @method void setEmailSecret(string $emailSecret)
 * @method void setMobileSecret(string $mobileSecret)
 *
 * @package Nocks\SDK\Model
 */
class User extends Model {

	/**
	 * @return bool
	 */
	public function isEmailVerified() {
		return (bool) $this->email_verified;
	}

	/**
	 * @return bool
	 */
	public function isMobileVerified() {
		return (bool) $this->mobile_verified;
	}

	/**
	 * @return bool
	 */
	public function isActive() {
		return (bool) $this->is_active;
	}

	/**
	 * @return bool
	 */
	public function isVerified() {
		return (bool) $this->is_verified;
	}

	/**
	 * @return bool
	 */
	public function isTwoFactorEnabled() {
		$prop = '2fa_enabled';
		return (bool) $this->{$prop};
	}

	/**
	 * @return bool
	 */
	public function isIdentityVerified() {
		return (bool) $this->identity_verified;
	}
}