<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\MerchantInvoice;

class MerchantInvoiceTransformer implements Transformer {

	private $dateTransformer;
	private $merchantClearingTransformer;

	public function __construct() {
		$this->dateTransformer = new DateTransformer();
		$this->merchantClearingTransformer = new MerchantClearingTransformer();
	}

	/**
	 * @param array $data
	 *
	 * @return MerchantInvoice
	 */
	public function transform(array $data) {
		// merchant_clearings
		if (isset($data['merchant_clearings']) && isset($data['merchant_clearings']['data'])) {
			$data['merchant_clearings'] = array_map(function($merchantClearing) {
				return $this->merchantClearingTransformer->transform($merchantClearing);
			}, $data['merchant_clearings']['data']);
		}

		return new MerchantInvoice($this->dateTransformer->transform($data));
	}

	/**
	 * @param Model $model
	 *
	 * @return mixed
	 */
	public function reverseTransform(Model $model) {
		return $this->dateTransformer->reverseTransform($model->getData());
	}
}