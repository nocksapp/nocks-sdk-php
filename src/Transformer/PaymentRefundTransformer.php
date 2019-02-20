<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\PaymentRefund;

class PaymentRefundTransformer implements Transformer {

	private $currencyTransformer;
	private $dateTransformer;
	private $paymentMethodTransformer;

	public function __construct() {
		$this->currencyTransformer = new CurrencyTransformer();
		$this->dateTransformer = new DateTransformer();
		$this->paymentMethodTransformer = new PaymentMethodTransformer();
	}

	/**
	 * @param array $data
	 *
	 * @return PaymentRefund
	 */
	public function transform(array $data) {
		if (isset($data['payment_method']) && isset($data['payment_method']['data'])) {
			$data['payment_method'] = $this->paymentMethodTransformer->transform($data['payment_method']['data']);
		}

		return new PaymentRefund($this->dateTransformer->transform($this->currencyTransformer->transform($data)));
	}

	/**
	 * @param Model $paymentRefund
	 *
	 * @return array
	 */
	public function reverseTransform(Model $paymentRefund) {
		$data = $paymentRefund->getData();

		if (isset($data['payment_method']) && $data['payment_method'] instanceof Model) {
			$data['payment_method'] = $this->paymentMethodTransformer->reverseTransform($data['payment_method']);
		}

		return $this->dateTransformer->reverseTransform($this->currencyTransformer->reverseTransform($data));
	}
}
