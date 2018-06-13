<?php


namespace Nocks\SDK\Model;

/**
 * Class Currency
 *
 * @method string getAmount()
 * @method string getCurrency()
 *
 * @package Nocks\SDK\Model
 */
class Currency extends Model {

	private $value;

	public function __construct(array $data = null) {
		parent::__construct($data);

		$this->value = isset($data['value']) ? $data['value'] : floatval($this->getAmount());

		if (!isset($this->amount)) {
			$this->amount = (string) $this->value;
		}
	}

	/**
	 * @param $value
	 */
	public function setValue($value) {
		$this->value = $value;
	}

	/**
	 * @return float
	 */
	public function getValue() {
		return $this->value;
	}
}