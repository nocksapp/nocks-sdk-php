<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\TradeMarket;

class TradeMarketTransformer implements Transformer {

	private $currencyTransformer;

	public function __construct() {
		$this->currencyTransformer = new CurrencyTransformer();
	}

	/**
	 * @param array $data
	 *
	 * @return TradeMarket
	 */
	public function transform(array $data) {
		return new TradeMarket($this->currencyTransformer->transform($data));
	}

	/**
	 * @param Model $model
	 *
	 * @return array
	 */
	public function reverseTransform(Model $model) {
		return $this->currencyTransformer->reverseTransform($model->getData());
	}
}