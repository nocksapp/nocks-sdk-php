<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\FundingSource;

class FundingSourceTransformer implements Transformer {

	private $currencyTransformer;
	private $dateTransformer;
	private $paymentMethodTransformer;

	public function __construct() {
		$this->currencyTransformer = new CurrencyTransformer();
		$this->dateTransformer = new DateTransformer();
		$this->paymentMethodTransformer = new PaymentMethodTransformer();
	}

	/**
	 * Transform FundingSource
	 *
	 * @param $data
	 *
	 * @return FundingSource
	 */
	public function transform(array $data) {
		return new FundingSource($this->currencyTransformer->transform($this->dateTransformer->transform($data)));
	}

	/**
	 * Reverse Transform FundingSource
	 *
	 * @param Model $fundingSource
	 *
	 * @return array
	 */
	public function reverseTransform(Model $fundingSource) {
		$data = $fundingSource->getData();

		// payment_method
		if (isset($data['payment_method']) && $data['payment_method'] instanceof Model) {
			$data['payment_method'] = $this->paymentMethodTransformer->reverseTransform($data['payment_method']);
		}

		return $this->currencyTransformer->reverseTransform($this->dateTransformer->reverseTransform($data));
	}
}