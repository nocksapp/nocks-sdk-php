<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Date;

class DateTransformer {

	private static $properties = [
		'created_at',
		'updated_at',
		'cancelled_at',
		'filled_at',
		'expire_at',
		'start',
		'end',
		'issued_at',
		'paid_at',
		'due_at',
		'active_at',
	];

	/**
	 * Transform date
	 *
	 * @param $data
	 *
	 * @return mixed
	 */
	public function transform(array $data) {
		foreach (DateTransformer::$properties as $property) {
			if (isset($data[$property])) {
				$data[$property] = new Date($data[$property]);
			}
		}

		return $data;
	}

	/**
	 * Reverse transform date
	 *
	 * @param $data
	 *
	 * @return mixed
	 */
	public function reverseTransform($data) {
		foreach (DateTransformer::$properties as $property) {
			if (isset($data[$property]) && $data[$property] instanceof Date && $data[$property]->hasDateTime()) {
				$data[$property] = $data[$property]->getDateTime()->format('Y-m-d H:i:s');
			}
		}

		return $data;
	}
}
