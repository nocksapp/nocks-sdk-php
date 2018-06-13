<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\MerchantProfileTurnover;

class MerchantProfileTurnoverTransformer implements Transformer {

	private $currencyTransformer;
	private $dateTransformer;

	public function __construct() {
		$this->currencyTransformer = new CurrencyTransformer();
		$this->dateTransformer = new DateTransformer();
	}

	/**
	 * @param array $data
	 *
	 * @return MerchantProfileTurnover
	 */
	public function transform(array $data) {
		if (isset($data['period'])) {
			$data['period'] = $this->dateTransformer->transform($data['period']);
		}

		return new MerchantProfileTurnover($this->currencyTransformer->transform($data));
	}

	/**
	 * @param Model $model
	 *
	 * @return mixed
	 */
	public function reverseTransform(Model $model) {
		return $this->currencyTransformer->reverseTransform($this->dateTransformer->reverseTransform($model->getData()));
	}
}