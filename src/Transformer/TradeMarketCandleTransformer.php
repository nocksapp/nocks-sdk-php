<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\TradeMarketCandle;

class TradeMarketCandleTransformer implements Transformer {

	/**
	 * @param array $data
	 *
	 * @return TradeMarketCandle
	 */
	public function transform(array $data) {
		return new TradeMarketCandle($data);
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