<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\AddressValidationResult;
use Nocks\SDK\Model\Model;

class AddressValidationTransformer implements Transformer {

	/**
	 * @param array $data
	 *
	 * @return AddressValidationResult
	 */
	public function transform(array $data) {
		return new AddressValidationResult($data['validation']);
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