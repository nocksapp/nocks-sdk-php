<?php


namespace Nocks\SDK\Model;

/**
 * Class Currency
 *
 * @method string getAmount()
 * @method string getCurrency()
 *
 * @method void setAmount(string $amount)
 * @method void setCurrency(string $currency)
 *
 * @package Nocks\SDK\Model
 */
class Currency extends Model {

	private $value;

	public function __construct(array $data = []) {
		parent::__construct($data);

		if (isset($data['value'])) {
			$this->setValue($data['value']);
			$this->setAmount((string) $this->value);
		} else if ($this->hasAmount()) {
			$this->value = floatval($this->getAmount());
		}
	}

	/**
	 * @param $value
	 */
	public function setValue($value) {
		$this->value = $value;
		$this->setAmount((string) $this->value);
	}

	/**
	 * @return float
	 */
	public function getValue() {
		return $this->value;
	}
}