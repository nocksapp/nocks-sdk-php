<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\MerchantClearingDistribution;

class MerchantClearingDistributionTransformer implements Transformer {

	/**
	 * @param array $data
	 *
	 * @return MerchantClearingDistribution
	 */
	public function transform(array $data) {
		return new MerchantClearingDistribution($data);
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