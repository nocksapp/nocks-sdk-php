<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\TradeMarketQuote;

class TradeMarketQuoteTransformer implements Transformer {

	/**
	 * @param array $data
	 *
	 * @return TradeMarketQuote
	 */
	public function transform(array $data) {
		return new TradeMarketQuote($data);
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