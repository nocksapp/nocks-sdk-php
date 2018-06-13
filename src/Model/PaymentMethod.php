<?php


namespace Nocks\SDK\Model;

/**
 * Class PaymentMethod
 *
 * @method string getCode()
 * @method string getName()
 * @method string getDescription()
 * @method float getAmountMinimum()
 * @method float getAmountMaximum()
 * @method float getFeeFixed()
 * @method float getFeePercentage()
 * @method float getResource()
 *
 * @method void setMethod(string $method)
 * @method void setMetadata(array $metadata)
 *
 * @package Nocks\SDK\Model
 */
class PaymentMethod extends Model {

	/**
	 * @return bool
	 */
	public function isVerificationMethod() {
		return boolval($this->is_verification_method);
	}

	/**
	 * @return bool
	 */
	public function isTransactionMethod() {
		return boolval($this->is_transaction_method);
	}

	/**
	 * @return bool
	 */
	public function isDepositMethod() {
		return boolval($this->is_deposit_method);
	}

	/**
	 * @return bool
	 */
	public function isWithdrawalMethod() {
		return boolval($this->is_withdrawal_method);
	}

	/**
	 * @return bool
	 */
	public function isRefundMethod() {
		return boolval($this->is_refund_method);
	}

	/**
	 * @return bool
	 */
	public function isDefault() {
		return boolval($this->is_default);
	}
}