<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\PaymentAddressValidationResult;
use Nocks\SDK\Model\Model;

class PaymentAddressValidationTransformer implements Transformer {

	/**
	 * @param array $data
	 *
	 * @return PaymentAddressValidationResult
	 */
	public function transform(array $data) {
		return new PaymentAddressValidationResult($data['validation']);
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