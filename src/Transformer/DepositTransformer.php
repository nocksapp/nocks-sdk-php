<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\Deposit;

class DepositTransformer implements Transformer {

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
	 * @return Deposit
	 */
	public function transform(array $data) {
		if (isset($data['payment_method']) && isset($data['payment_method']['data'])) {
			$data['payment_method'] = $this->paymentMethodTransformer->transform($data['payment_method']['data']);
		}

		return new Deposit($this->currencyTransformer->transform($this->dateTransformer->transform($data)));
	}

	/**
	 * @param Model $model
	 *
	 * @return mixed
	 */
	public function reverseTransform(Model $model) {
		$data = $model->getData();

		// payment_method
		if (isset($data['payment_method']) && $data['payment_method'] instanceof Model) {
			$data['payment_method'] = $this->paymentMethodTransformer->reverseTransform($data['payment_method']);
		}

		return $this->currencyTransformer->reverseTransform($this->dateTransformer->reverseTransform($data));
	}
}