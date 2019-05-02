<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Currency;

class CurrencyTransformer {

	private static $properties = [
		'source_amount',
		'target_amount',
		'received_amount',
		'tip_amount',
		'fee_amount',
		'amount',
		'last',
		'volume',
		'volume_total',
		'low',
		'high',
		'buy',
		'sell',
		'tip',
		'fee',
		'total',
		'amount_filled',
		'amount_cost',
		'amount_fee',
		'amount_fillable',
		'amount_refunded',
		'available',
		'reserved',
		'deposit_max',
		'used',
		'limit',
	];

	/**
	 * Transform currency
	 *
	 * @param $data
	 *
	 * @return mixed
	 */
	public function transform($data) {
		foreach (CurrencyTransformer::$properties as $property) {
			if (isset($data[$property])) {
				$data[$property] = new Currency($data[$property]);
			}
		}

		return $data;
	}

	/**
	 * Reverse transform currency
	 *
	 * @param $data
	 *
	 * @return mixed
	 */
	public function reverseTransform($data) {
		foreach (CurrencyTransformer::$properties as $property) {
			if (isset($data[$property]) && $data[$property] instanceof Currency) {
				$data[$property] = $data[$property]->getData();
			}
		}

		return $data;
	}
}
