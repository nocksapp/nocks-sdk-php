<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\MerchantClearing;

class MerchantClearingTransformer implements Transformer {

	private $currencyTransformer;
	private $dateTransformer;
	private $merchantClearingItemTransformer;

	public function __construct() {
		$this->currencyTransformer = new CurrencyTransformer();
		$this->dateTransformer = new DateTransformer();
		$this->merchantClearingItemTransformer = new MerchantClearingItemTransformer();
	}

	/**
	 * @param array $data
	 *
	 * @return MerchantClearing
	 */
	public function transform(array $data) {
		// merchant_clearing_items
		if (isset($data['merchant_clearing_items']) && isset($data['merchant_clearing_items']['data'])) {
			$data['merchant_clearing_items'] = array_map(function($merchantClearingItem) {
				return $this->merchantClearingItemTransformer->transform($merchantClearingItem);
			}, $data['merchant_clearing_items']['data']);
		}

		return new MerchantClearing($this->dateTransformer->transform($this->currencyTransformer->transform($data)));
	}

	/**
	 * @param Model $model
	 *
	 * @return mixed
	 */
	public function reverseTransform(Model $model) {
		return $this->dateTransformer->reverseTransform($this->currencyTransformer->reverseTransform($model->getData()));
	}
}