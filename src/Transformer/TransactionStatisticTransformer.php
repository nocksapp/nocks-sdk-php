<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\TransactionStatistic;

class TransactionStatisticTransformer implements Transformer {

	private $currencyTransformer;

	public function __construct() {
		$this->currencyTransformer = new CurrencyTransformer();
	}

	/**
	 * @param array $data
	 *
	 * @return array
	 */
	public function transform(array $data) {
		$transformed = [];

		foreach ($data as $code => $statics) {
			$transformed[$code] = new TransactionStatistic(array_merge($this->currencyTransformer->transform($statics), [
				'code' => $code,
			]));
		}

		return $transformed;
	}

	/**
	 * @param Model $model
	 *
	 * @return array
	 */
	public function reverseTransform(Model $model) {
		return $model->getData();
	}
}