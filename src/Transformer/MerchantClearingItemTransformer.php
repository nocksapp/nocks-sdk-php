<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\MerchantClearingItem;

class MerchantClearingItemTransformer {

	private $currencyTransformer;
	private $dateTransformer;

	public function __construct() {
		$this->currencyTransformer = new CurrencyTransformer();
		$this->dateTransformer = new DateTransformer();
	}

	/**
	 * @param array $data
	 *
	 * @return MerchantClearingItem
	 */
	public function transform(array $data) {
		return new MerchantClearingItem($this->currencyTransformer->transform($this->dateTransformer->transform($data)));
	}

	/**
	 * @param MerchantClearingItem $merchantClearingItem
	 *
	 * @return mixed
	 */
	public function reverseTransform(MerchantClearingItem $merchantClearingItem) {
		return $this->currencyTransformer->reverseTransform($this->dateTransformer->reverseTransform($merchantClearingItem->getData()));
	}

}