<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\Bill;

class BillTransformer implements Transformer {

	private $currencyTransformer;
	private $dateTransformer;
	private $transactionTransformer;
	private $paymentMethodTransformer;

	public function __construct() {
		$this->currencyTransformer = new CurrencyTransformer();
		$this->dateTransformer = new DateTransformer();
		$this->transactionTransformer = new TransactionTransformer();
		$this->paymentMethodTransformer = new PaymentMethodTransformer();
	}

	/**
	 * @param array $data
	 *
	 * @return Bill
	 */
	public function transform(array $data) {
		// transactions
		if (isset($data['transactions']) && isset($data['transactions']['data'])) {
			$data['transactions'] = array_map(function($transaction) {
				return $this->transactionTransformer->transform($transaction);
			}, $data['transactions']['data']);
		}

		// payment_method
		if (isset($data['payment_method']) && isset($data['payment_method']['data'])) {
			$data['payment_method'] = $this->paymentMethodTransformer->transform($data['payment_method']['data']);
		}

		return new Bill($this->currencyTransformer->transform($this->dateTransformer->transform($data)));
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