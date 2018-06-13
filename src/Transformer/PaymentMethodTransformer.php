<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\PaymentMethod;

class PaymentMethodTransformer implements Transformer {

	/**
	 * @param array $data
	 *
	 * @return PaymentMethod
	 */
	public function transform(array $data) {
		return new PaymentMethod($data);
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