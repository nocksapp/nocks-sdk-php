<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\TradeMarketHistory;

class TradeMarketHistoryTransformer implements Transformer {

	private $dateTransformer;

	public function __construct() {
		$this->dateTransformer = new DateTransformer();
	}
	/**
	 * @param array $data
	 *
	 * @return TradeMarketHistory
	 */
	public function transform(array $data) {
		return new TradeMarketHistory($this->dateTransformer->transform($data));
	}

	/**
	 * @param Model $model
	 *
	 * @return array
	 */
	public function reverseTransform(Model $model) {
		return $this->dateTransformer->reverseTransform($model->getData());
	}
}