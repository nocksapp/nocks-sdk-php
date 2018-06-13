<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\TradeOrder;

class TradeOrderTransformer implements Transformer {

	private $currencyTransformer;
	private $dateTransformer;

	public function __construct() {
		$this->currencyTransformer = new CurrencyTransformer();
		$this->dateTransformer = new DateTransformer();
	}

	/**
	 * @param array $data
	 *
	 * @return TradeOrder
	 */
	public function transform(array $data) {
		return new TradeOrder($this->currencyTransformer->transform($this->dateTransformer->transform($data)));
	}

	/**
	 * @param Model $model
	 *
	 * @return mixed
	 */
	public function reverseTransform(Model $model) {
		return $this->currencyTransformer->reverseTransform($this->dateTransformer->reverseTransform($model->getData()));
	}
}