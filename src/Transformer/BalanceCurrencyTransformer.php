<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\BalanceCurrency;
use Nocks\SDK\Model\Model;

class BalanceCurrencyTransformer implements Transformer {

	private $currencyTransformer;
	private $paymentMethodTransformer;

	public function __construct() {
		$this->currencyTransformer = new CurrencyTransformer();
		$this->paymentMethodTransformer = new PaymentMethodTransformer();
	}

	/**
	 * @param array $data
	 *
	 * @return BalanceCurrency
	 */
	public function transform(array $data) {
		if (isset($data['deposit_payment_methods']) && isset($data['deposit_payment_methods']['data'])) {
			$data['deposit_payment_methods'] = array_map(function($paymentMethod) {
				return $this->paymentMethodTransformer->transform($paymentMethod);
			}, $data['deposit_payment_methods']['data']);
		}

		if (isset($data['withdrawal_payment_methods']) && isset($data['withdrawal_payment_methods']['data'])) {
			$data['withdrawal_payment_methods'] = array_map(function($paymentMethod) {
				return $this->paymentMethodTransformer->transform($paymentMethod);
			}, $data['withdrawal_payment_methods']['data']);
		}

		return new BalanceCurrency($this->currencyTransformer->transform($data));
	}

	/**
	 * @param Model $model
	 *
	 * @return mixed
	 */
	public function reverseTransform(Model $model) {
		return $this->currencyTransformer->reverseTransform($model->getData());
	}
}