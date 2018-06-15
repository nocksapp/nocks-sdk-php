<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\AddressValidation;
use Nocks\SDK\Model\Model;

class AddressValidationTransformer implements Transformer {

	/**
	 * @param array $data
	 *
	 * @return AddressValidation
	 */
	public function transform(array $data) {
		return new AddressValidation($data);
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