<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\TradeMarketBook;

class TradeMarketBookTransformer implements Transformer {

	/**
	 * @param array $data
	 *
	 * @return TradeMarketBook
	 */
	public function transform( array $data ) {
		return new TradeMarketBook($data);
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