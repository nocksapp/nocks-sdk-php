<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Balance;
use Nocks\SDK\Model\Model;

class BalanceTransformer implements Transformer {

	private $currencyTransformer;
	private $balanceCurrencyTransformer;

	public function __construct() {
		$this->currencyTransformer = new CurrencyTransformer();
		$this->balanceCurrencyTransformer = new BalanceCurrencyTransformer();
	}

	/**
	 * @param array $data
	 *
	 * @return Balance
	 */
	public function transform(array $data) {
		if (isset($data['deposit_limit_month'])) {
			$data['deposit_limit_month'] = $this->currencyTransformer->transform($data['deposit_limit_month']);
		}

		if (isset($data['currency']) && isset($data['currency']['data'])) {
			$data['currency'] = $this->balanceCurrencyTransformer->transform($data['currency']['data']);
		}

		return new Balance($this->currencyTransformer->transform($data));
	}

	/**
	 * @param Model $model
	 *
	 * @return mixed
	 */
	public function reverseTransform(Model $model) {
		return $this->currencyTransformer->reverseTransform($model->getData());
	}
}