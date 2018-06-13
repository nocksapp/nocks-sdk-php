<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\TradeMarketDistribution;

class TradeMarketDistributionTransformer implements Transformer {

	/**
	 * @param array $data
	 *
	 * @return TradeMarketDistribution
	 */
	public function transform(array $data) {
		return new TradeMarketDistribution($data);
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